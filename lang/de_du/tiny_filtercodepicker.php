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

/** FilterCode Picker strings.
 *
 * @package tiny_filtercodepicker
 * @copyright 2026 108design
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['noresults'] = 'Keine Treffer. Probiere einen anderen Begriff oder eine andere Kategorie.';
$string['previewcontext'] = 'Dein Kontext';
$string['selection'] = 'Beim Einfügen umschließen die Tags deinen markierten Inhalt samt Formatierung.';
$string['samplehint'] = 'Markiere vor dem Öffnen des Dialogs den Inhalt, den die Tags umschließen sollen. Ohne Auswahl wird der Beispieltext eingefügt. Du kannst ihn im Editor ersetzen.';
$string['tag_label_desc'] = 'Erzeugt ein kurzes Label in der Variante info. Du kannst die Variante im eingefügten Code ändern.';
$string['tag_alert_desc'] = 'Erzeugt einen Hinweiskasten in der Variante info. Du kannst die Variante im Code ändern.';
$string['tag_button_desc'] = 'Erzeugt einen Link als Button. Ersetze /my/ im Code durch das gewünschte Ziel.';
$string['tag_langx_desc'] = 'Kennzeichnet die Textsprache im HTML, etwa für Screenreader. Ersetze en durch das passende Sprachkürzel. Verwende multilang, wenn Moodle zwischen Sprachfassungen wählen soll.';
$string['tag_ifloggedinas_desc'] = 'Zeigt den Inhalt, wenn du Moodles Funktion „Anmelden als“ verwendest.';
$string['tag_details_desc'] = 'Erzeugt einen aufklappbaren Abschnitt. Ersetze Details im Code durch die passende Überschrift.';
$string['tag_getstring_desc'] = 'Setzt den Moodle-Sprachtext für die Kennung continue ein. Du kannst die Kennung im Code austauschen.';
$string['tag_ifingroup_desc'] = 'Zeigt den Inhalt für Mitglieder dieser Kursgruppe. Ersetze GROUP_ID durch die Gruppen-ID oder die ID-Nummer der Gruppe.';
$string['tag_ifnotingroup_desc'] = 'Zeigt den Inhalt für Personen außerhalb dieser Kursgruppe. Ersetze GROUP_ID durch die Gruppen-ID oder die ID-Nummer der Gruppe.';
$string['tag_ifingrouping_desc'] = 'Zeigt den Inhalt für Mitglieder einer Gruppe in dieser Gruppierung. Ersetze GROUPING_ID durch die ID oder die ID-Nummer der Gruppierung.';
$string['tag_ifnotingrouping_desc'] = 'Zeigt den Inhalt für Personen außerhalb dieser Gruppierung. Ersetze GROUPING_ID durch die ID oder die ID-Nummer der Gruppierung.';
$string['tag_ifincohort_desc'] = 'Zeigt den Inhalt für Mitglieder dieser globalen Gruppe. Ersetze COHORT_ID durch ihre ID oder ID-Nummer.';
$string['tag_ifnotincohort_desc'] = 'Zeigt den Inhalt für Personen außerhalb dieser globalen Gruppe. Ersetze COHORT_ID durch ihre ID oder ID-Nummer.';
$string['tag_ifcustomrole_desc'] = 'Zeigt den Inhalt, wenn die Person im aktuellen Kontext die angegebene Rolle hat. Ersetze editingteacher durch den Kurznamen der gewünschten Rolle.';
$string['tag_ifhasarolename_desc'] = 'Zeigt den Inhalt, wenn die Person irgendwo auf der Website die angegebene Rolle hat. Ersetze editingteacher durch den Kurznamen der gewünschten Rolle.';
$string['tag_iftheme_desc'] = 'Zeigt den Inhalt, wenn die Anzeigeseite dieses Theme verwendet. Ersetze boost durch den Verzeichnisnamen des Themes.';
$string['tag_ifnottheme_desc'] = 'Zeigt den Inhalt, wenn die Anzeigeseite ein anderes Theme verwendet. Ersetze boost durch den Verzeichnisnamen des Themes.';
$string['tag_multilang_desc'] = 'Setze die Sprachfassungen direkt hintereinander, jede in einem eigenen multilang-Block. Ersetze en durch das passende Sprachkürzel. Moodles Filter „Mehrsprachiger Inhalt“ muss aktiv sein und nach FilterCodes laufen.';
$string['tag_userpictureimg_desc'] = 'Fügt das Profilbild der betrachtenden Person ein. Die Größe wählst du mit sm, md oder lg.';
$string['tag_profile_field_shortname_desc'] = 'Ersetze shortname durch den Kurznamen des Feldes. FilterCodes berücksichtigt dessen Sichtbarkeit.';
$string['tag_coursecard_desc'] = 'Ersetze COURSE_ID durch eine oder mehrere numerische Kurs-IDs, getrennt durch Leerzeichen.';
$string['tag_course_field_shortname_desc'] = 'Ersetze shortname durch den Kurznamen des Kursfeldes. FilterCodes berücksichtigt dessen Sichtbarkeit.';
$string['tag_global_shortname_desc'] = 'Ersetze shortname durch den Namen eines globalen Tags aus den FilterCodes-Einstellungen.';
$string['tag_scrape_desc'] = 'Trage die Adresse der Seite in url ein. FilterCodes kann den Ausschnitt zum Beispiel nach HTML-Element, Klasse oder ID auswählen. Scrape muss in FilterCodes aktiviert sein.';
$string['tag_fa_desc'] = 'Ersetze fa-star durch den Namen des gewünschten Font-Awesome-Icons. Das Theme muss den Iconfont bereitstellen.';
$string['tag_glyphicon_desc'] = 'Ersetze glyphicon-star durch den gewünschten Icon-Namen. Das Theme muss Glyphicons bereitstellen.';
$string['tag_readonly_desc'] = 'Setze diesen Tag in die öffnende HTML-Markierung eines Formularfelds. Bei angemeldeten Personen erzeugt er das readonly-Attribut.';
$string['tag_ifactivitycompleted_desc'] = 'Ersetze ACTIVITY_ID durch die numerische ID des Kursmoduls. Der Tag zeigt den Text bei erfülltem Aktivitätsabschluss.';
$string['tag_ifnotactivitycompleted_desc'] = 'Ersetze ACTIVITY_ID durch die numerische ID des Kursmoduls. Der Tag zeigt den Text, solange der Aktivitätsabschluss aussteht.';
$string['tag_ifnotcustomrole_desc'] = 'Ersetze editingteacher durch den Kurznamen der Rolle. Der Text erscheint, wenn die betrachtende Person diese Rolle im aktuellen Kontext nicht hat.';
$string['tag_ifprofile_field_shortname_desc'] = 'Ersetze shortname im öffnenden und im schließenden Tag durch den Feldkurznamen.';
$string['tag_ifprofile_desc'] = 'Ersetze shortname und value durch den Feldkurznamen und den Vergleichswert. FilterCodes unterstützt die Operatoren is, not, contains und in.';
$string['tag_iftenant_desc'] = 'Ersetze 1 durch die ID oder ID-Nummer des Moodle-Workplace-Mandanten. In Moodle LMS verwendet FilterCodes die 1 als Standard.';
