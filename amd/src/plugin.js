// This file is part of Moodle - https://moodle.org/
// SPDX-License-Identifier: GPL-3.0-or-later

/**
 * TinyMCE entry point for the FilterCode picker.
 *
 * @module tiny_filtercodepicker/plugin
 * @copyright 2026 108design
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
import {exception} from 'core/notification';
import {getStrings} from 'core/str';
import {getTinyMCE} from 'editor_tiny/loader';
import {getPluginOptionName} from 'editor_tiny/options';
import {addMenubarItem, addToolbarButtons, getPluginMetadata} from 'editor_tiny/utils';
import {openPicker} from 'tiny_filtercodepicker/picker';

const component = 'tiny_filtercodepicker';
const plugin = `${component}/plugin`;
const control = `${component}_picker`;
const option = getPluginOptionName(plugin, 'picker');
const labels = ['action', 'preview', 'loading', 'empty', 'hidden', 'inactive', 'needscourse', 'needsactivity',
    'displaypage', 'codeonly', 'space', 'softhyphen', 'unresolved', 'failed'];

export default Promise.all([
    getTinyMCE(),
    getPluginMetadata(component, plugin),
    getStrings(labels.map(key => ({key, component}))),
]).then(([tinyMCE, metadata, translations]) => {
    const strings = Object.fromEntries(labels.map((key, index) => [key, translations[index]]));
    tinyMCE.PluginManager.add(plugin, editor => {
        editor.options.register(option, {processor: 'object'});
        editor.ui.registry.addIcon(component, '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">'
            + '<path d="M3 8V7c0-3 2-3 4.5-2.7C10 4.6 10.8 4 11 2h2c.2 2 1 2.6 3.5 2.3C19 4 21 4 21 7v1h-2V7'
            + 'c0-1.2-.7-1-2.5-.8C14 6.5 12.8 6 12 4.7 11.2 6 10 6.5 7.5 6.2 5.7 6 5 5.8 5 7v1Z"/>'
            + '<path d="M3 8V7c0-3 2-3 4.5-2.7C10 4.6 10.8 4 11 2h2c.2 2 1 2.6 3.5 2.3C19 4 21 4 21 7v1h-2V7'
            + 'c0-1.2-.7-1-2.5-.8C14 6.5 12.8 6 12 4.7 11.2 6 10 6.5 7.5 6.2 5.7 6 5 5.8 5 7v1Z"'
            + ' transform="translate(0 24) scale(1 -1)"/>'
            + '<circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/>'
            + '</svg>');
        let opening = false;
        const onAction = async() => {
            if (opening || editor.mode.isReadOnly()) {
                return;
            }
            opening = true;
            try {
                await openPicker(editor, editor.options.get(option), strings);
            } catch (error) {
                exception(error);
            } finally {
                opening = false;
            }
        };
        editor.ui.registry.addButton(control, {icon: component, tooltip: strings.action, onAction});
        editor.ui.registry.addMenuItem(control, {icon: component, text: strings.action, onAction});
        return metadata;
    });
    return [plugin, {
        configure: instance => ({
            toolbar: addToolbarButtons(instance.toolbar, 'content', [control]),
            menu: addMenubarItem(instance.menu, 'insert', control),
        }),
    }];
});
