<?php
// This file is part of Moodle - https://moodle.org/
// SPDX-License-Identifier: GPL-3.0-or-later
// This file is licensed under the GNU General Public License v3 or later.

namespace tiny_filtercodepicker\privacy;

/** Privacy metadata for the picker, which stores no personal data of its own.
 *
 * @package tiny_filtercodepicker
 * @copyright 2026 108design
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class provider implements \core_privacy\local\metadata\null_provider {
    public static function get_reason(): string {
        return 'privacy:metadata';
    }
}
