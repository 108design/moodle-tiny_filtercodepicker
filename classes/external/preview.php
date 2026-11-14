<?php
/**
 * This file is part of Moodle - https://moodle.org/
 *
 * Moodle is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Moodle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Moodle. If not, see <https://www.gnu.org/licenses/>.
 *
 */
// SPDX-License-Identifier: GPL-3.0-or-later
// This file is licensed under the GNU General Public License v3 or later.

namespace tiny_filtercodepicker\external;

use core\context;
use core\exception\invalid_parameter_exception;
use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;
use tiny_filtercodepicker\local\catalogue;
use tiny_filtercodepicker\local\preview_markup;
use tiny_filtercodepicker\plugininfo;

/** Evaluate only a server-owned example in the authorised editor context.
 *
 * @package tiny_filtercodepicker
 * @copyright 2026 108design
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class preview extends external_api {
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'contextid' => new external_value(PARAM_INT, 'Editor context ID'),
            'token' => new external_value(PARAM_ALPHANUM, 'Session-bound editor context token'),
            'tag' => new external_value(PARAM_ALPHANUMEXT, 'Catalogue entry ID'),
        ]);
    }

    /** Preview the value or the result of a conditional in the calling user's session. */
    public static function execute(int $contextid, string $token, string $tag): array {
        global $PAGE, $SESSION;
        ['contextid' => $contextid, 'token' => $token, 'tag' => $tag] = self::validate_parameters(
            self::execute_parameters(), compact('contextid', 'token', 'tag'),
        );
        require_sesskey();
        $entry = catalogue::entries()[$tag] ?? null;
        if (!$entry) {
            throw new invalid_parameter_exception('Unknown FilterCode');
        }
        $context = context::instance_by_id($contextid);
        if (empty($SESSION->tiny_filtercodepicker_secret) || !hash_equals(plugininfo::context_token($context), $token)) {
            throw new invalid_parameter_exception('Invalid editor context');
        }
        self::validate_context($context);
        require_capability(plugininfo::CAPABILITY, $context);
        if (!plugininfo::can_use($context)) {
            throw new invalid_parameter_exception('Unsupported editor context');
        }
        if (!plugininfo::filter_is_active($context)) {
            return ['state' => 'inactive', 'value' => ''];
        }
        if ($entry['codeonly']) {
            return ['state' => 'codeonly', 'value' => ''];
        }
        if ($entry['requirescourse'] && (int) $PAGE->course->id === (int) SITEID) {
            return ['state' => 'needscourse', 'value' => ''];
        }
        if ($entry['requiresactivity'] && $context->contextlevel !== CONTEXT_MODULE) {
            return ['state' => 'needsactivity', 'value' => ''];
        }
        if ($entry['displaypage']) {
            return ['state' => 'displaypage', 'value' => ''];
        }

        $sample = $entry['close'] === '' ? '' : s(get_string('sample', catalogue::COMPONENT));
        $input = $entry['open'] . $sample . $entry['close'];
        $output = format_text($input, FORMAT_HTML, ['context' => $context, 'para' => false]);
        $value = trim(html_entity_decode(strip_tags($output), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        if (str_contains($value, $entry['open']) || ($entry['close'] !== '' && str_contains($value, $entry['close']))) {
            return ['state' => 'unresolved', 'value' => ''];
        }
        if ($tag === 'nbsp' && $value === "\u{00a0}") {
            return ['state' => 'space', 'value' => ''];
        }
        if ($tag === 'softhyphen' && $value === "\u{00ad}") {
            return ['state' => 'softhyphen', 'value' => ''];
        }
        if ($entry['markup']) {
            $markup = preview_markup::render($output);
            if ($markup !== '' && ($value !== '' || $tag === 'hr')) {
                return ['state' => 'markup', 'value' => $value, 'markup' => $markup];
            }
        }
        if ($value === '') {
            return ['state' => $entry['close'] === '' ? 'empty' : 'hidden', 'value' => ''];
        }
        return ['state' => 'resolved', 'value' => $value];
    }

    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'state' => new external_value(PARAM_ALPHA, 'Preview status'),
            'value' => new external_value(PARAM_RAW, 'Plain-text filter result'),
            'markup' => new external_value(PARAM_RAW, 'Passive preview markup', VALUE_OPTIONAL),
        ]);
    }
}
