<?php
// This file is part of Moodle - https://moodle.org/
// SPDX-License-Identifier: GPL-3.0-or-later
// This file is licensed under the GNU General Public License v3 or later.

namespace tiny_filtercodepicker\local;

/** The allowlisted catalogue shared by editor setup and preview.
 *
 * @package tiny_filtercodepicker
 * @copyright 2026 108design
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class catalogue {
    public const COMPONENT = 'tiny_filtercodepicker';

    private const CATEGORIES = [
        'person' => ['firstname', 'lastname', 'fullname', 'userid', 'middlename', 'firstnamephonetic',
            'lastnamephonetic', 'alternatename', 'username', 'idnumber', 'email', 'city', 'country', 'timezone',
            'preferredlanguage', 'institution', 'department', 'userdescription', 'webpage', 'firstaccessdate',
            'lastlogin', 'userpictureurl', 'userpictureimg', 'profilefullname', 'profile_field_shortname'],
        'course' => ['coursename', 'courseid', 'courseshortname', 'courseidnumber', 'categoryname', 'coursestartdate',
            'courseenddate', 'courseparticipantcount', 'coursecontextid', 'coursemoduleid', 'sectionid',
            'sectionname', 'categoryid', 'categorynumber', 'categorydescription', 'coursesummary', 'courseimage-url',
            'courseimage', 'course_field_shortname',
            'courseenrolmentdate', 'coursecompletiondate', 'coursegradepercent', 'coursegrade',
            'courseprogresspercent', 'courseprogress', 'courseprogressbar', 'courseunenrolurl', 'coursecontacts',
            'mygroups', 'mygroupings'],
        'site' => ['sitename', 'wwwroot', 'siteyear', 'lang', 'now', 'sitesummary', 'sitelogourl', 'supportname',
            'supportemail', 'supportpage', 'supportservicespage', 'usercount', 'usersactive', 'usersonline',
            'userscountrycount', 'coursecount', 'coursesactive', 'protocol', 'filtercodes', 'diskfreespace',
            'diskfreespacedata', 'dashboard_siteinfo', 'ipaddress', 'sesskey'],
        'navigation' => ['mycourses', 'myccourses', 'categories', 'categories0', 'categoriesx', 'courserequest',
            'pagepath', 'thisurl', 'thisurl_enc', 'referer', 'editingtoggle', 'categoriesmenu', 'categories0menu',
            'categoriesxmenu', 'toggleeditingmenu', 'mycoursesmenu', 'courserequestmenu0', 'courserequestmenu',
            'menuadmin', 'menudev', 'menuthemes', 'menulanguages', 'menucoursemore', 'menuwishlist'],
        'visibility' => ['ifloggedin', 'ifloggedout', 'ifincourse', 'ifguest', 'ifteacher',
            'ifadmin', 'ifenrolled',
            'ifvisible', 'ifnotvisible', 'ifnotenrolled', 'ifstudent', 'ifassistant', 'ifminassistant',
            'ifminteacher', 'ifcreator', 'ifmincreator', 'ifmanager', 'ifminmanager', 'ifminsitemanager',
            'ifcourserequests', 'ifhome', 'ifnothome', 'ifdashboard', 'ifenrolpage', 'ifnotenrolpage',
            'ifinactivity', 'ifnotinactivity', 'ifeditmode', 'ifnoteditmode', 'ifmobile', 'ifnotmobile',
            'ifloggedinas', 'ifnotloggedinas', 'ifinsection', 'ifnotinsection', 'ifingroup', 'ifnotingroup',
            'ifingrouping', 'ifnotingrouping', 'ifincohort', 'ifnotincohort', 'ifminstudent', 'ifcustomrole',
            'ifnotcustomrole', 'ifhasarolename', 'iftheme', 'ifnottheme', 'ifdev', 'ifactivitycompleted',
            'ifnotactivitycompleted', 'ifprofile_field_shortname', 'ifprofile', 'iftenant', 'ifworkplace'],
        'formatting' => ['nbsp', 'hr', 'note', 'highlight', 'marktext', 'markborder', 'keyboard', 'label', 'alert',
            'button', 'showmore', 'details', 'getstring', 'langx', 'multilang', 'urlencode', 'rawurlencode',
            'teamcards', 'coursecards', 'coursecard', 'coursecardsbyenrol', 'categorycards', 'mycoursescards',
            'chart', 'qrcode', 'global_shortname', 'help', 'info', 'scrape', 'fa', 'glyphicon', 'softhyphen'],
        'forms' => ['formquickquestion', 'formcontactus', 'formcourserequest', 'formsupport', 'formcheckin',
            'recaptcha', 'readonly', 'formsesskey', 'wwwcontactform'],
    ];

    private const COURSE_FALLBACK = ['coursename', 'courseid', 'courseshortname', 'coursesummary'];
    private const COURSE_CONDITIONS = ['ifteacher', 'ifenrolled', 'ifvisible', 'ifnotvisible', 'ifnotenrolled',
        'ifstudent', 'ifminstudent', 'ifassistant', 'ifminassistant', 'ifminteacher', 'ifingroup', 'ifnotingroup',
        'ifingrouping', 'ifnotingrouping'];
    private const ACTIVITY_ONLY = ['coursemoduleid', 'sectionid', 'sectionname'];
    private const DISPLAY_PAGE = ['pagepath', 'thisurl', 'thisurl_enc', 'ifhome', 'ifnothome', 'ifdashboard',
        'ifenrolpage', 'ifnotenrolpage', 'ifinactivity', 'ifnotinactivity', 'ifeditmode', 'ifnoteditmode',
        'ifmobile', 'ifnotmobile', 'profilefullname', 'editingtoggle', 'ifinsection', 'ifnotinsection',
        'iftheme', 'ifnottheme'];
    private const FORMATTING_BLOCKS = ['note', 'highlight', 'marktext', 'markborder', 'keyboard', 'label',
        'alert', 'button', 'showmore', 'details', 'langx', 'multilang', 'urlencode', 'rawurlencode',
        'qrcode', 'help', 'info'];
    private const ARGUMENTS = ['userpictureurl' => 'sm', 'label' => 'info', 'alert' => 'info',
        'button' => '/my/', 'langx' => 'en', 'multilang' => 'en', 'ifingroup' => 'GROUP_ID', 'ifnotingroup' => 'GROUP_ID',
        'ifingrouping' => 'GROUPING_ID', 'ifnotingrouping' => 'GROUPING_ID', 'ifincohort' => 'COHORT_ID',
        'ifnotincohort' => 'COHORT_ID', 'ifcustomrole' => 'editingteacher', 'ifhasarolename' => 'editingteacher',
        'iftheme' => 'boost', 'ifnottheme' => 'boost', 'userpictureimg' => 'sm', 'coursecard' => 'COURSE_ID',
        'chart' => 'radial 50', 'ifnotcustomrole' => 'editingteacher', 'ifactivitycompleted' => 'ACTIVITY_ID',
        'ifnotactivitycompleted' => 'ACTIVITY_ID', 'ifprofile' => 'shortname is "value"', 'iftenant' => '1',
        'fa' => 'fa-star', 'glyphicon' => 'glyphicon-star', 'scrape' => 'url=""'];
    private const MARKUP_PREVIEW = ['coursesummary', 'categorydescription', 'userdescription',
        'sitesummary', 'mycourses', 'myccourses', 'coursecontacts', 'mygroups', 'mygroupings', 'categories', 'categories0',
        'categoriesx', 'courserequest', 'teamcards', 'coursecards', 'coursecardsbyenrol', 'categorycards',
        'mycoursescards', 'hr', 'highlight', 'marktext', 'markborder', 'keyboard', 'label',
        'alert', 'button', 'showmore', 'details', 'langx'];

    // These examples need user-supplied arguments, page features or an execution context outside the passive preview.
    // Keep session values, arbitrary configured content and external requests out of the AJAX response.
    private const CODE_ONLY = ['profile_field_shortname', 'ifprofile_field_shortname', 'course_field_shortname',
        'ifprofile', 'ifactivitycompleted', 'ifnotactivitycompleted', 'userpictureimg', 'courseimage',
        'courseprogressbar', 'coursecard', 'chart', 'qrcode', 'help', 'info', 'fa', 'glyphicon',
        'global_shortname', 'scrape', 'sesskey', 'referer', 'ipaddress', 'diskfreespace', 'diskfreespacedata',
        'dashboard_siteinfo', 'categoriesmenu', 'categories0menu', 'categoriesxmenu', 'toggleeditingmenu',
        'mycoursesmenu', 'courserequestmenu0', 'courserequestmenu', 'menuadmin', 'menudev', 'menuthemes',
        'menulanguages', 'menucoursemore', 'menuwishlist'];

    /** @return array<string, array> Entries keyed by the exact opening tag name. */
    public static function entries(): array {
        $entries = [];
        foreach (self::CATEGORIES as $category => $tags) {
            foreach ($tags as $tag) {
                $block = $category === 'visibility' || in_array($tag, self::FORMATTING_BLOCKS, true);
                $argument = isset(self::ARGUMENTS[$tag]) ? ' ' . self::ARGUMENTS[$tag] : '';
                $open = match ($tag) {
                    'details' => '{details}{summary}' . get_string('detailssummary', self::COMPONENT) . '{/summary}',
                    'getstring' => '{getstring}continue{/getstring}',
                    'softhyphen' => '{-}',
                    default => '{' . $tag . $argument . '}',
                };
                $entries[$tag] = [
                    'id' => $tag,
                    'category' => $category,
                    'open' => $open,
                    'close' => $block ? '{/' . $tag . '}' : '',
                    'requirescourse' => ($category === 'course' && !in_array($tag, self::COURSE_FALLBACK, true))
                        || in_array($tag, self::COURSE_CONDITIONS, true),
                    'requiresactivity' => in_array($tag, self::ACTIVITY_ONLY, true),
                    'displaypage' => in_array($tag, self::DISPLAY_PAGE, true),
                    'codeonly' => $category === 'forms' || in_array($tag, self::CODE_ONLY, true),
                    'markup' => in_array($tag, self::MARKUP_PREVIEW, true),
                ];
            }
        }
        return $entries;
    }

    /** @return array Localised data for the TinyMCE dialog. */
    public static function picker_data(): array {
        $entries = [];
        $counts = [];
        foreach (self::entries() as $tag => $entry) {
            $category = $entry['category'];
            $counts[$category] = ($counts[$category] ?? 0) + 1;
            $entries[] = $entry + [
                'label' => get_string('tag_' . $tag, self::COMPONENT),
                'description' => get_string('tag_' . $tag . '_desc', self::COMPONENT),
                'keywords' => get_string_manager()->string_exists('tag_' . $tag . '_keywords', self::COMPONENT)
                    ? get_string('tag_' . $tag . '_keywords', self::COMPONENT) : '',
            ];
        }
        $categories = [
            ['id' => '', 'label' => get_string('categoryall', self::COMPONENT), 'count' => count($entries), 'selected' => true],
        ];
        foreach (array_keys(self::CATEGORIES) as $category) {
            $categories[] = [
                'id' => $category,
                'label' => get_string('category' . $category, self::COMPONENT),
                'count' => $counts[$category] ?? 0,
            ];
        }
        return ['categories' => $categories, 'entries' => $entries];
    }
}
