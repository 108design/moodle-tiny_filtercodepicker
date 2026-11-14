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

namespace tiny_filtercodepicker;

use core\context;
use editor_tiny\editor;
use editor_tiny\plugin;
use editor_tiny\plugin_with_buttons;
use editor_tiny\plugin_with_configuration;
use editor_tiny\plugin_with_menuitems;
use tiny_filtercodepicker\local\catalogue;

/** Registers the same action in the TinyMCE toolbar and Insert menu.
 *
 * @package tiny_filtercodepicker
 * @copyright 2026 108design
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class plugininfo extends plugin implements plugin_with_buttons, plugin_with_menuitems, plugin_with_configuration {
    public const CAPABILITY = 'tiny/filtercodepicker:use';
    private const CONTROL = 'tiny_filtercodepicker/tiny_filtercodepicker_picker';

    /** Whether the editor context supports an authenticated picker. */
    public static function can_use(context $context): bool {
        return isloggedin() && !isguestuser()
            && in_array($context->contextlevel, [CONTEXT_SYSTEM, CONTEXT_COURSECAT, CONTEXT_COURSE, CONTEXT_MODULE], true)
            && has_capability(self::CAPABILITY, $context);
    }

    /** Whether FilterCodes is enabled for the actual content context. */
    public static function filter_is_active(context $context): bool {
        return array_key_exists('filtercodes', filter_get_active_in_context($context));
    }

    public static function is_enabled(context $context, array $options, array $fpoptions, ?editor $editor = null): bool {
        return self::can_use($context) && self::filter_is_active($context);
    }

    public static function get_available_buttons(): array {
        return [self::CONTROL];
    }

    public static function get_available_menuitems(): array {
        return [self::CONTROL];
    }

    /** Proves the context was emitted by an editor in the current user session. */
    public static function context_token(context $context): string {
        global $SESSION, $USER;
        $SESSION->tiny_filtercodepicker_secret ??= bin2hex(random_bytes(32));
        return hash_hmac('sha256', $USER->id . ':' . $context->id, $SESSION->tiny_filtercodepicker_secret);
    }

    public static function get_plugin_configuration_for_context(
        context $context,
        array $options,
        array $fpoptions,
        ?editor $editor = null,
    ): array {
        global $OUTPUT;
        if (!self::is_enabled($context, $options, $fpoptions, $editor)) {
            return [];
        }
        return ['picker' => catalogue::picker_data() + [
            'brandurl' => $OUTPUT->image_url('helpbrand', catalogue::COMPONENT)->out(false),
            'contextid' => $context->id,
            'contextname' => $context->get_context_name(false, false, false),
            'token' => self::context_token($context),
            'sample' => get_string('sample', catalogue::COMPONENT),
        ]];
    }
}
