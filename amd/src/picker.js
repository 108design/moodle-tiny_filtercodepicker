// This file is part of Moodle - https://moodle.org/
// SPDX-License-Identifier: GPL-3.0-or-later

/**
 * Search, preview and insert FilterCodes from the catalogue.
 *
 * @module tiny_filtercodepicker/picker
 * @copyright 2026 108design
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
import {call} from 'core/ajax';
import Modal from 'core/modal';
import ModalEvents from 'core/modal_events';
import {renderForPromise} from 'core/templates';

const normalise = value => value.toLocaleLowerCase().normalize('NFKD').replace(/\p{Diacritic}/gu, '').replace(/ß/g, 'ss');

export const openPicker = async(editor, config, strings) => {
    const bookmark = editor.selection.getBookmark(2, true);
    const hasSelection = !editor.selection.isCollapsed();
    const selection = hasSelection ? editor.selection.getContent({format: 'html'}) : '';
    const {html} = await renderForPromise('tiny_filtercodepicker/picker', {...config, hasSelection});
    const modal = await Modal.create({title: strings.action, body: html, large: true, removeOnClose: true});
    modal.getRoot().addClass('tiny-filtercodepicker-modal');
    const close = modal.getRoot().get(0).querySelector('[data-region="header"] [data-action="hide"]');
    if (close && config.brandurl) {
        const brand = document.createElement('img');
        brand.className = 'tiny-filtercodepicker-brand';
        brand.src = config.brandurl;
        brand.alt = '';
        close.before(brand);
    }
    const root = modal.getBody().get(0);
    const search = root.querySelector('[data-search]');
    const empty = root.querySelector('[data-empty]');
    const details = root.querySelector('[data-details]');
    const title = root.querySelector('[data-preview-title]');
    const description = root.querySelector('[data-description]');
    const status = root.querySelector('[data-preview]');
    const snippet = root.querySelector('[data-snippet]');
    const conditionalHint = root.querySelector('[data-conditional]');
    const insert = root.querySelector('[data-insert]');
    const rows = [...root.querySelectorAll('[data-entry]')].map((button, index) => {
        const entry = config.entries[index];
        const searchable = normalise([entry.label, entry.description, entry.keywords, `{${entry.id}}`,
            entry.open, entry.close].join(' '));
        return {button, entry, searchable};
    });
    let category = '';
    let selected;
    let request = 0;
    let active = true;
    let chosen;

    const choose = entry => {
        selected = entry;
        const revision = ++request;
        for (const row of rows) {
            row.button.setAttribute('aria-pressed', String(row.entry === entry));
        }
        details.hidden = !entry;
        insert.disabled = !entry;
        title.textContent = entry?.label ?? strings.preview;
        if (!entry) {
            return;
        }
        description.textContent = entry.description;
        snippet.textContent = entry.open + (entry.close ? (hasSelection ? '…' : config.sample) : '') + entry.close;
        conditionalHint.hidden = !entry.close;
        status.textContent = strings.loading;
        status.dataset.state = 'loading';
        call([{
            methodname: 'tiny_filtercodepicker_preview',
            args: {contextid: config.contextid, token: config.token, tag: entry.id},
        }])[0].then(result => {
            if (active && revision === request) {
                status.dataset.state = result.state;
                if (result.state === 'markup') {
                    status.innerHTML = result.markup;
                } else {
                    status.textContent = result.state === 'resolved' ? result.value : strings[result.state] ?? strings.failed;
                }
            }
        }).catch(() => {
            if (active && revision === request) {
                status.dataset.state = 'failed';
                status.textContent = strings.failed;
            }
        });
    };

    const filter = () => {
        const terms = normalise(search.value).trim().split(/\s+/);
        const visible = rows.filter(({button, entry, searchable}) => {
            const match = (!category || category === entry.category) && terms.every(term => searchable.includes(term));
            button.closest('li').hidden = !match;
            return match;
        });
        empty.hidden = Boolean(visible.length);
        if (!visible.some(({entry}) => entry === selected)) {
            choose(visible[0]?.entry);
        }
    };

    search.addEventListener('input', filter);
    const categories = [...root.querySelectorAll('[data-category]')];
    for (const button of categories) {
        button.addEventListener('click', () => {
            category = button.dataset.category;
            for (const tab of categories) {
                tab.setAttribute('aria-pressed', String(tab === button));
            }
            filter();
        });
    }
    for (const {button, entry} of rows) {
        button.addEventListener('click', () => {
            if (selected !== entry) {
                choose(entry);
            }
        });
    }
    insert.addEventListener('click', () => {
        chosen = selected;
        modal.hide();
    });

    return new Promise((resolve, reject) => {
        modal.getRoot().one(ModalEvents.hidden, () => {
            active = false;
            try {
                if (!editor.removed && !editor.mode.isReadOnly()) {
                    editor.focus();
                    editor.selection.moveToBookmark(bookmark);
                    if (chosen) {
                        const inner = chosen.close ? selection || editor.dom.encode(config.sample) : '';
                        editor.undoManager.transact(() => editor.insertContent(chosen.open + inner + chosen.close));
                    }
                }
                resolve();
            } catch (error) {
                reject(error);
            }
        });
        modal.getRoot().one(ModalEvents.shown, () => search.focus());
        filter();
        modal.show();
    });
};
