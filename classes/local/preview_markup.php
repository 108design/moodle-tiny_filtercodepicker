<?php
// This file is part of Moodle - https://moodle.org/
// SPDX-License-Identifier: GPL-3.0-or-later
// This file is licensed under the GNU General Public License v3 or later.

namespace tiny_filtercodepicker\local;

/** Builds a passive preview from the filter output.
 *
 * @package tiny_filtercodepicker
 * @copyright 2026 108design
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class preview_markup {
    private const ELEMENTS = ['p', 'div', 'span', 'br', 'hr', 'strong', 'b', 'em', 'i', 'u', 's', 'sub', 'sup',
        'mark', 'kbd', 'code', 'pre', 'ul', 'ol', 'li', 'dl', 'dt', 'dd', 'blockquote', 'table', 'thead', 'tbody',
        'tr', 'th', 'td', 'details', 'summary'];
    private const CLASSES = ['alert', 'alert-info', 'label', 'label-info', 'btn', 'btn-primary', 'fc-keyboard',
        'fc-marktext', 'fc-markborder', 'fc-highlight', 'hidden'];
    private const OMIT = ['script', 'style', 'template', 'svg', 'iframe', 'object', 'embed', 'form'];

    /** Retain presentation without links, external resources, event handlers or arbitrary attributes. */
    public static function render(string $html): string {
        $document = new \DOMDocument();
        $document->loadHTML('<!doctype html><html><head><meta charset="utf-8"></head><body>' . $html . '</body></html>',
            LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING);
        $body = $document->getElementsByTagName('body')->item(0);
        return $body ? trim(self::children($body)) : '';
    }

    private static function children(\DOMNode $parent): string {
        $html = '';
        foreach ($parent->childNodes as $node) {
            if ($node instanceof \DOMText) {
                $html .= s($node->data);
            } else if ($node instanceof \DOMElement && !in_array($node->tagName, self::OMIT, true)) {
                $tag = $node->tagName === 'a' ? 'span' : $node->tagName;
                $content = self::children($node);
                if (!in_array($tag, self::ELEMENTS, true)) {
                    $html .= $content;
                    continue;
                }
                $classes = array_intersect(self::CLASSES, preg_split('/\s+/', $node->getAttribute('class')));
                $attribute = $classes ? ' class="' . implode(' ', $classes) . '"' : '';
                $html .= '<' . $tag . $attribute . '>';
                if ($tag !== 'br' && $tag !== 'hr') {
                    $html .= $content . '</' . $tag . '>';
                }
            }
        }
        return $html;
    }
}
