<?php
/*
   Plugin Name: Gravity Forms Placeholder
   Plugin URI: http://wordpress.org/extend/plugins/gravity-forms-placeholder/
   Version: 0.1
   Author: John Paul Mariano
   Description: This plugin will work with Gravity Forms Plugin. Install Gravity forms prior activation.
   Text Domain: gravity-forms-placeholder
   License: GPLv3
  */

/*
    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

$GravityFormsPlaceholder_minimalRequiredPhpVersion = '5.0';

/**
 * Check the PHP version and give a useful error message if the user's version is less than the required version
 * @return boolean true if version check passed. If false, triggers an error which WP will handle, by displaying
 * an error message on the Admin page
 */
function GravityFormsPlaceholder_noticePhpVersionWrong() {
    global $GravityFormsPlaceholder_minimalRequiredPhpVersion;
    echo '<div class="updated fade">' .
      __('Error: plugin "Gravity Forms Placeholder" requires a newer version of PHP to be running.',  'gravity-forms-placeholder').
            '<br/>' . __('Minimal version of PHP required: ', 'gravity-forms-placeholder') . '<strong>' . $GravityFormsPlaceholder_minimalRequiredPhpVersion . '</strong>' .
            '<br/>' . __('Your server\'s PHP version: ', 'gravity-forms-placeholder') . '<strong>' . phpversion() . '</strong>' .
         '</div>';
}


function GravityFormsPlaceholder_PhpVersionCheck() {
    global $GravityFormsPlaceholder_minimalRequiredPhpVersion;
    if (version_compare(phpversion(), $GravityFormsPlaceholder_minimalRequiredPhpVersion) < 0) {
        add_action('admin_notices', 'GravityFormsPlaceholder_noticePhpVersionWrong');
        return false;
    }
    return true;
}


/**
 * Initialize internationalization (i18n) for this plugin.
 * References:
 *      http://codex.wordpress.org/I18n_for_WordPress_Developers
 *      http://www.wdmac.com/how-to-create-a-po-language-translation#more-631
 * @return void
 */
function GravityFormsPlaceholder_i18n_init() {
    $pluginDir = dirname(plugin_basename(__FILE__));
    load_plugin_textdomain('gravity-forms-placeholder', false, $pluginDir . '/languages/');
}


//////////////////////////////////
// Run initialization
/////////////////////////////////

// First initialize i18n
GravityFormsPlaceholder_i18n_init();


// Next, run the version check.
// If it is successful, continue with initialization for this plugin
if (GravityFormsPlaceholder_PhpVersionCheck()) {
    // Only load and run the init function if we know PHP version can parse it
    include_once('gravity-forms-placeholder_init.php');
    GravityFormsPlaceholder_init(__FILE__);
}
