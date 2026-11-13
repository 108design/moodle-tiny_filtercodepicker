<?php
// This file is part of Moodle - https://moodle.org/
// SPDX-License-Identifier: GPL-3.0-or-later

/** Version information for the FilterCode picker.
 *
 * @package tiny_filtercodepicker
 * @copyright 2026 108design
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

$plugin->component = 'tiny_filtercodepicker';
$plugin->version = 2026111303;
$plugin->requires = 2024100700;
$plugin->supported = [405, 503];
$plugin->maturity = MATURITY_STABLE;
$plugin->release = '1.0.1';
$plugin->dependencies = ['filter_filtercodes' => 2026101200];
