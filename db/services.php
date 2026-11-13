<?php
// This file is part of Moodle - https://moodle.org/
// SPDX-License-Identifier: GPL-3.0-or-later

/** Session-bound preview AJAX endpoint.
 *
 * @package tiny_filtercodepicker
 * @copyright 2026 108design
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

$functions = [
    'tiny_filtercodepicker_preview' => [
        'classname' => \tiny_filtercodepicker\external\preview::class,
        'description' => 'Preview an allowed FilterCode in the current editor context.',
        'type' => 'read',
        'ajax' => true,
        'capabilities' => 'tiny/filtercodepicker:use',
    ],
];
