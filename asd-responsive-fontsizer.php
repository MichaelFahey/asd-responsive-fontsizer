<?php
/**
 *
 * This is the root file of the ASD Responsive FontSizer WordPress plugin
 *
 * @package ASD_Responsive FontSizer
 * Plugin Name:    ASD Responsive FontSizer
 * Plugin URI:     https://artisansitedesigns.com/
 * Description:    A grid-matrix for setting font-sizes, responsive breakpoints,
 *                 and applied classes.
 * Author:         Michael H Fahey
 * Author URI:     https://artisansitedesigns.com/staff/michael-h-fahey/
 * Text Domain:    asd_responsive_fontsizer
 * License:        GPL3
 * Version:        1.201812011
 *
 * ASD Responsive FontSizer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * ASD Responsive FontSizer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ASD Responsive FontSizer. If not, see
 * https://www.gnu.org/licenses/gpl.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

if ( ! defined( 'ASD_RESPONSIVE_FONTSIZER_DIR' ) ) {
	define( 'ASD_RESPONSIVE_FONTSIZER_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'ASD_RESPONSIVE_FONTSIZER_URL' ) ) {
	define( 'ASD_RESPONSIVE_FONTSIZER_URL', plugin_dir_url( __FILE__ ) );
}

require_once 'includes/asd-admin-menu/asd-admin-menu.php';
require_once 'includes/asd-function-lib/asd-function-lib.php';

/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_plugin_action_links()
 *   Adds links to the Dashboard Plugin page for this plugin.
 *   Hooks to admin_menu action.
 *  ----------------------------------------------------------------------------
 *
 *   @param Array $actions -  Returned as an array of html links.
 */
function asd_responsive_fontsizer_plugin_action_links( $actions ) {
	if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
		$actions[0] = '<a target="_blank" href="https://artisansitedesigns.com/">Help</a>';
		/* $actions[1] = '<a href="' . admin_url()   . '">' .  'Settings'  . '</a>';  */
	}
		return apply_filters( 'responsive_fontsizers_actions', $actions );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'asd_responsive_fontsizer_plugin_action_links' );

/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_admin_submenu()
 *   Adds two submenu pages to the admn menu with the asd_settings slug.
 *   This admin top menu is loaded in includes/asd-admin-menu.php .
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_admin_submenu() {
      /* add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' )  */
		add_submenu_page(
			'asd_settings',
			'Responsive FontSizer',
			'Responsive FontSizer',
			'manage_options',
         'asd_responsive_fontsizer',
         'asd_responsive_fontsizer_screen'
		);
}
if ( is_admin() ) {
		add_action( 'admin_menu', 'asd_responsive_fontsizer_admin_submenu', 15 );
}

/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_screen()
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_screen() {
   if ( ! current_user_can( 'manage_options' ) ) {
      wp_die( 'Insufficient Permissions' );
   }
   ?>
   <div class="wrap">
      <h1>Responsive Fontsizer Settings</h1>

      <script type="text/javascript">
         jQuery(function() {
            jQuery("#asd_responsive_fontsizer_fields").tabs();
         });
      </script>

      <div id="asd_responsive_fontsizer_fields">

         <ul>
            <li><a href="#asd_responsive_fontsizer_xs">XS</a></li>
            <li><a href="#asd_responsive_fontsizer_sm">SM</a></li>
            <li><a href="#asd_responsive_fontsizer_md">MD</a></li>
            <li><a href="#asd_responsive_fontsizer_lg">LG</a></li>
            <li><a href="#asd_responsive_fontsizer_xl">XL</a></li>
            <li><a href="#asd_responsive_fontsizer_xxl">XXL</a></li>
            <li><a href="#asd_responsive_fontsizer_breakpoints">Customize Breakpoints</a></li>
         </ul>

         <div id="asd_responsive_fontsizer_xs">
            <h3>XS is the Bootstrap 3 definition for phones</h3>
            <i>default breakpoint for xs is max-width 767px</i>
            <form method="post" action="options.php">
               <?php settings_fields( 'asd_responsive_fontsizer_xs_group' ); ?>
               <?php do_settings_sections( 'asd_responsive_fontsizer_xs_group' ); ?>
               <?php submit_button( 'Save XS Sizes' ); ?>
            </form>
         </div>

         <div id="asd_responsive_fontsizer_sm">
            <h3>SM is the Bootstrap 3 definition for tablets</h3>
            <i>default breakpoint for sm is min-width 768px</i>
            <form method="post" action="options.php">
               <?php settings_fields( 'asd_responsive_fontsizer_sm_group' ); ?>
               <?php do_settings_sections( 'asd_responsive_fontsizer_sm_group' ); ?>
               <?php submit_button( 'Save SM Sizes' ); ?>
            </form>
         </div>

         <div id="asd_responsive_fontsizer_md">
            <h3>MD is the Bootstrap 3 definition for small desktops</h3>
            <i>default breakpoint for md is min-width 992px</i>
            <form method="post" action="options.php">
               <?php settings_fields( 'asd_responsive_fontsizer_md_group' ); ?>
               <?php do_settings_sections( 'asd_responsive_fontsizer_md_group' ); ?>
               <?php submit_button( 'Save MD Sizes' ); ?>
            </form>
         </div>

         <div id="asd_responsive_fontsizer_lg">
            <h3>LG is the Bootstrap 3 definition for standard desktops</h3>
            <i>default breakpoint for lg is min-width 1200px</i>
            <form method="post" action="options.php">
               <?php settings_fields( 'asd_responsive_fontsizer_lg_group' ); ?>
               <?php do_settings_sections( 'asd_responsive_fontsizer_lg_group' ); ?>
               <?php submit_button( 'Save LG Sizes' ); ?>
            </form>
         </div>

         <div id="asd_responsive_fontsizer_xl">
            <h3>XL is a supplemental definition for large desktops</h3>
            <i>default breakpoint for xl is min-width 1600px</i>
            <form method="post" action="options.php">
               <?php settings_fields( 'asd_responsive_fontsizer_xl_group' ); ?>
               <?php do_settings_sections( 'asd_responsive_fontsizer_xl_group' ); ?>
               <?php submit_button( 'Save XL Sizes' ); ?>
            </form>
         </div>

         <div id="asd_responsive_fontsizer_xxl">
            <h3>XXL is a supplemental definition for very large desktops</h3>
            <i>default breakpoint for xxl is min-width 1900px</i>
            <form method="post" action="options.php">
               <?php settings_fields( 'asd_responsive_fontsizer_xxl_group' ); ?>
               <?php do_settings_sections( 'asd_responsive_fontsizer_xxl_group' ); ?>
               <?php submit_button( 'Save XXL Sizes' ); ?>
            </form>
         </div>

         <div id="asd_responsive_fontsizer_breakpoints">
            <form method="post" action="options.php">
               <?php settings_fields( 'asd_responsive_fontsizer_breakpoints_group' ); ?>
               <?php do_settings_sections( 'asd_responsive_fontsizer_breakpoints_group' ); ?>
               <?php submit_button( 'Save Breakpoints' ); ?>
            </form>
         </div>

      </div>

   </div> 

   <?php
}

/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_register_settings()
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_register_settings() {

   /** ------------------------------------------------------------------------
    *   add_breakpoints_section( $id, $title, $callback, $page );
    *  ----------------------------------------------------------------------*/
      add_settings_section(
         'asd_responsive_fontsizer_breakpoints_section',
         '',
         'asd_responsive_fontsizer_breakpoints_panel',
         'asd_responsive_fontsizer_breakpoints_group'
      );
   /** ------------------------------------------------------------------------
    *   register_setting( string $option_group,
    *                     string $option_name, array $args = array() )
    *  ----------------------------------------------------------------------*/
    register_setting(
        'asd_responsive_fontsizer_breakpoints_group',
        'asd_responsive_fontsizer_breakpoint_xs',
        array ( 'default' => '767px' )
    );
    register_setting(
        'asd_responsive_fontsizer_breakpoints_group',
        'asd_responsive_fontsizer_breakpoint_sm',
        array ( 'default' => '768px' )
    );
    register_setting(
        'asd_responsive_fontsizer_breakpoints_group',
        'asd_responsive_fontsizer_breakpoint_md',
        array ( 'default' => '992px' )
    );
    register_setting(
        'asd_responsive_fontsizer_breakpoints_group',
        'asd_responsive_fontsizer_breakpoint_lg',
        array ( 'default' => '1200px' )
    );
    register_setting(
        'asd_responsive_fontsizer_breakpoints_group',
        'asd_responsive_fontsizer_breakpoint_xl',
        array ( 'default' => '1600px' )
    );
    register_setting(
        'asd_responsive_fontsizer_breakpoints_group',
        'asd_responsive_fontsizer_breakpoint_xxl',
        array ( 'default' => '1900px' )
    );


   /** ------------------------------------------------------------------------
    *        XS Classes
    *  ----------------------------------------------------------------------*/
    add_settings_section(
       'asd_responsive_fontsizer_xs_section',
       '',
       'asd_responsive_fontsizer_xs_panel',
       'asd_responsive_fontsizer_xs_group'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_page'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_site_header'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_navbar_default'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_site_body'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_widget_area'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_site_footer'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_h1'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_h2'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_h3'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_h4'
    );
    register_setting(
        'asd_responsive_fontsizer_xs_group',
        'asd_responsive_fontsizer_xs_class_h5'
    );



   /** ------------------------------------------------------------------------
    *        SM Classes
    *  ----------------------------------------------------------------------*/
    add_settings_section(
       'asd_responsive_fontsizer_sm_section',
       '',
       'asd_responsive_fontsizer_sm_panel',
       'asd_responsive_fontsizer_sm_group'
    );
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_page'
    );
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_site_header'
    );
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_navbar_default'
    );
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_site_body'
    );
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_widget_area'
    );
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_site_footer'
    );
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_h1'
    );   
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_h2'
    );   
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_h3'
    );   
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_h4'
    );   
    register_setting(
        'asd_responsive_fontsizer_sm_group',
        'asd_responsive_fontsizer_sm_class_h5'
    ); 

   /** ------------------------------------------------------------------------
    *        MD Classes
    *  ----------------------------------------------------------------------*/
    add_settings_section(
       'asd_responsive_fontsizer_md_section',
       '',
       'asd_responsive_fontsizer_md_panel',
       'asd_responsive_fontsizer_md_group'
    );
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_page'
    );
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_site_header'
    );
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_navbar_default'
    );
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_site_body'
    );
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_widget_area'
    );
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_site_footer'
    );
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_h1'
    );   
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_h2'
    );   
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_h3'
    );   
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_h4'
    );   
    register_setting(
        'asd_responsive_fontsizer_md_group',
        'asd_responsive_fontsizer_md_class_h5'
    ); 

   /** ------------------------------------------------------------------------
    *        LG Classes
    *  ----------------------------------------------------------------------*/
    add_settings_section(
       'asd_responsive_fontsizer_lg_section',
       '',
       'asd_responsive_fontsizer_lg_panel',
       'asd_responsive_fontsizer_lg_group'
    );
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_page'
    );
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_site_header'
    );
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_navbar_default'
    );
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_site_body'
    );
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_widget_area'
    );
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_site_footer'
    );
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_h1'
    );   
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_h2'
    );   
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_h3'
    );   
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_h4'
    );   
    register_setting(
        'asd_responsive_fontsizer_lg_group',
        'asd_responsive_fontsizer_lg_class_h5'
    ); 


   /** ------------------------------------------------------------------------
    *        XL Classes
    *  ----------------------------------------------------------------------*/
    add_settings_section(
       'asd_responsive_fontsizer_xl_section',
       '',
       'asd_responsive_fontsizer_xl_panel',
       'asd_responsive_fontsizer_xl_group'
    );
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_page'
    );
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_site_header'
    );
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_navbar_default'
    );
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_site_body'
    );
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_widget_area'
    );
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_site_footer'
    );
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_h1'
    );   
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_h2'
    );   
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_h3'
    );   
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_h4'
    );   
    register_setting(
        'asd_responsive_fontsizer_xl_group',
        'asd_responsive_fontsizer_xl_class_h5'
    ); 

   /** ------------------------------------------------------------------------
    *        XXL Classes
    *  ----------------------------------------------------------------------*/
    add_settings_section(
       'asd_responsive_fontsizer_xxl_section',
       '',
       'asd_responsive_fontsizer_xxl_panel',
       'asd_responsive_fontsizer_xxl_group'
    );
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_page'
    );
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_site_header'
    );
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_navbar_default'
    );
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_site_body'
    );
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_widget_area'
    );
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_site_footer'
    );
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_h1'
    );   
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_h2'
    );   
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_h3'
    );   
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_h4'
    );   
    register_setting(
        'asd_responsive_fontsizer_xxl_group',
        'asd_responsive_fontsizer_xxl_class_h5'
    ); 


}
if ( is_admin() ) {
      add_action( 'admin_init', 'asd_responsive_fontsizer_register_settings' );
}

/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_xs_panel()
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_xs_panel() {
   
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_page_fld',
     '.page',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_page'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_site_header_fld',
     '.site-header',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_site_header'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_navbar_default_fld',
     '.navbar-default',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_navbar_default'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_site_body_fld',
     '.site-body',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_site_body'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_widget_area_fld',
     '.widget-area',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_widget_area'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_site_footer_fld',
     '.site-footer',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_site_footer'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_h1_fld',
     'h1',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_h1'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_h2_fld',
     'h2',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_h2'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_h3_fld',
     'h3',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_h3'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_h4_fld',
     'h4',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_h4'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xs_class_h5_fld',
     'h5',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xs_group',
     'asd_responsive_fontsizer_xs_section',
     'asd_responsive_fontsizer_xs_class_h5'
  );

}


/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_sm_panel()
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_sm_panel() {
   
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_page_fld',
     '.page',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_page'
  );
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_site_header_fld',
     '.site-header',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_site_header'
  );
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_navbar_default_fld',
     '.navbar-default',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_navbar_default'
  );
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_site_body_fld',
     '.site-body',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_site_body'
  );
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_widget_area_fld',
     '.widget-area',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_widget_area'
  );
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_site_footer_fld',
     '.site-footer',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_site_footer'
  );
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_h1_fld',
     'h1',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_h1'
  );
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_h2_fld',
     'h2',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_h2'
  );
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_h3_fld',
     'h3',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_h3'
  );
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_h4_fld',
     'h4',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_h4'
  );
  add_settings_field(
     'asd_responsive_fontsizer_sm_class_h5_fld',
     'h5',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_sm_group',
     'asd_responsive_fontsizer_sm_section',
     'asd_responsive_fontsizer_sm_class_h5'
  );


}

/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_md_panel()
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_md_panel() {

  add_settings_field(
     'asd_responsive_fontsizer_md_class_page_fld',
     '.page',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_page'
  );
  add_settings_field(
     'asd_responsive_fontsizer_md_class_site_header_fld',
     '.site-header',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_site_header'
  );
  add_settings_field(
     'asd_responsive_fontsizer_md_class_navbar_default_fld',
     '.navbar-default',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_navbar_default'
  );
  add_settings_field(
     'asd_responsive_fontsizer_md_class_site_body_fld',
     '.site-body',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_site_body'
  );
  add_settings_field(
     'asd_responsive_fontsizer_md_class_widget_area_fld',
     '.widget-area',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_widget_area'
  );
  add_settings_field(
     'asd_responsive_fontsizer_md_class_site_footer_fld',
     '.site-footer',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_site_footer'
  );
  add_settings_field(
     'asd_responsive_fontsizer_md_class_h1_fld',
     'h1',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_h1'
  );
  add_settings_field(
     'asd_responsive_fontsizer_md_class_h2_fld',
     'h2',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_h2'
  );
  add_settings_field(
     'asd_responsive_fontsizer_md_class_h3_fld',
     'h3',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_h3'
  );
  add_settings_field(
     'asd_responsive_fontsizer_md_class_h4_fld',
     'h4',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_h4'
  );
  add_settings_field(
     'asd_responsive_fontsizer_md_class_h5_fld',
     'h5',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_md_group',
     'asd_responsive_fontsizer_md_section',
     'asd_responsive_fontsizer_md_class_h5'
  );


}


/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_lg_panel()
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_lg_panel() {

  add_settings_field(
     'asd_responsive_fontsizer_lg_class_page_fld',
     '.page',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_page'
  );
  add_settings_field(
     'asd_responsive_fontsizer_lg_class_site_header_fld',
     '.site-header',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_site_header'
  );
  add_settings_field(
     'asd_responsive_fontsizer_lg_class_navbar_default_fld',
     '.navbar-default',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_navbar_default'
  );
  add_settings_field(
     'asd_responsive_fontsizer_lg_class_site_body_fld',
     '.site-body',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_site_body'
  );
  add_settings_field(
     'asd_responsive_fontsizer_lg_class_widget_area_fld',
     '.widget-area',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_widget_area'
  );
  add_settings_field(
     'asd_responsive_fontsizer_lg_class_site_footer_fld',
     '.site-footer',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_site_footer'
  );

  add_settings_field(
     'asd_responsive_fontsizer_lg_class_h1_fld',
     'h1',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_h1'
  );
  add_settings_field(
     'asd_responsive_fontsizer_lg_class_h2_fld',
     'h2',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_h2'
  );
  add_settings_field(
     'asd_responsive_fontsizer_lg_class_h3_fld',
     'h3',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_h3'
  );
  add_settings_field(
     'asd_responsive_fontsizer_lg_class_h4_fld',
     'h4',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_h4'
  );
  add_settings_field(
     'asd_responsive_fontsizer_lg_class_h5_fld',
     'h5',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_lg_group',
     'asd_responsive_fontsizer_lg_section',
     'asd_responsive_fontsizer_lg_class_h5'
  );


}


/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_xl_panel()
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_xl_panel() {

  add_settings_field(
     'asd_responsive_fontsizer_xl_class_page_fld',
     '.page',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_page'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xl_class_site_header_fld',
     '.site-header',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_site_header'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xl_class_navbar_default_fld',
     '.navbar-default',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_navbar_default'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xl_class_site_body_fld',
     '.site-body',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_site_body'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xl_class_widget_area_fld',
     '.widget-area',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_widget_area'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xl_class_site_footer_fld',
     '.site-footer',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_site_footer'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xl_class_h1_fld',
     'h1',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_h1'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xl_class_h2_fld',
     'h2',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_h2'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xl_class_h3_fld',
     'h3',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_h3'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xl_class_h4_fld',
     'h4',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_h4'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xl_class_h5_fld',
     'h5',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xl_group',
     'asd_responsive_fontsizer_xl_section',
     'asd_responsive_fontsizer_xl_class_h5'
  );


}


/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_xxl_panel()
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_xxl_panel() {

  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_page_fld',
     '.page',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_page'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_site_header_fld',
     '.site-header',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_site_header'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_navbar_default_fld',
     '.navbar-default',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_navbar_default'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_site_body_fld',
     '.site-body',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_site_body'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_widget_area_fld',
     '.widget-area',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_widget_area'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_site_footer_fld',
     '.site-footer',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_site_footer'
  );

  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_h1_fld',
     'h1',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_h1'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_h2_fld',
     'h2',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_h2'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_h3_fld',
     'h3',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_h3'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_h4_fld',
     'h4',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_h4'
  );
  add_settings_field(
     'asd_responsive_fontsizer_xxl_class_h5_fld',
     'h5',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_xxl_group',
     'asd_responsive_fontsizer_xxl_section',
     'asd_responsive_fontsizer_xxl_class_h5'
  );


}








/** ----------------------------------------------------------------------------
 *   Function asd_responsive_fontsizer_breakpoints_panel()
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_breakpoints_panel() {

   /** ------------------------------------------------------------------------
    *   add_settings_field( $id, $title, $callback, $page, $section, $args );
    *  ----------------------------------------------------------------------*/
  add_settings_field(
     'asd_responsive_fontsizer_breakpoint_xs_fld',
     'XS',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_breakpoints_group',
     'asd_responsive_fontsizer_breakpoints_section',
     'asd_responsive_fontsizer_breakpoint_xs'
  );
  add_settings_field(
     'asd_responsive_fontsizer_breakpoint_sm_fld',
     'SM',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_breakpoints_group',
     'asd_responsive_fontsizer_breakpoints_section',
     'asd_responsive_fontsizer_breakpoint_sm'
  );
  add_settings_field(
     'asd_responsive_fontsizer_breakpoint_md_fld',
     'MD',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_breakpoints_group',
     'asd_responsive_fontsizer_breakpoints_section',
     'asd_responsive_fontsizer_breakpoint_md'
  );
  add_settings_field(
     'asd_responsive_fontsizer_breakpoint_lg_fld',
     'LG',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_breakpoints_group',
     'asd_responsive_fontsizer_breakpoints_section',
     'asd_responsive_fontsizer_breakpoint_lg'
  );
  add_settings_field(
     'asd_responsive_fontsizer_breakpoint_xl_fld',
     'XL',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_breakpoints_group',
     'asd_responsive_fontsizer_breakpoints_section',
     'asd_responsive_fontsizer_breakpoint_xl'
  );
  add_settings_field(
     'asd_responsive_fontsizer_breakpoint_xxl_fld',
     'XXL',
     'asd_fld_insert_narrow6',
     'asd_responsive_fontsizer_breakpoints_group',
     'asd_responsive_fontsizer_breakpoints_section',
     'asd_responsive_fontsizer_breakpoint_xxl'
  );


}

/** ----------------------------------------------------------------------------
 *   function asd_responsive_fontsizer_print_css()
 *   prints decorate navbar script to footer
 *  --------------------------------------------------------------------------*/
function asd_responsive_fontsizer_print_css() {

   echo "\r\n";
   echo '<style type="text/css">' . "\r\n";
  
   echo '  /* asd_responsive_fontsizer */ ' . "\r\n";

   echo '@media (max-width:' . get_option( 'asd_responsive_fontsizer_breakpoint_xs', '767px' )  . ') {' . "\r\n";
      if ( get_option ('asd_responsive_fontsizer_xs_class_page', false ) ) {
          echo '   .page, #page, .single, .archive {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_page') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xs_class_site_header', false ) ) {
          echo '   .site-header {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_site_header') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xs_class_navbar_default', false ) ) {
          echo '   .navbar-default {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_navbar_default') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xs_class_site_body', false ) ) {
          echo '   .site-body {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_site_body') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xs_class_widget_area', false ) ) {
          echo '   .widget-area {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_widget_area') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xs_class_site_footer', false ) ) {
          echo '   .site-footer {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_site_footer') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xs_class_h1', false ) ) {
          echo '   h1 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_h1') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xs_class_h2', false ) ) {
          echo '   h2 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_h2') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xs_class_h3', false ) ) {
          echo '   h3 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_h3') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xs_class_h4', false ) ) {
          echo '   h4 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_h4') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xs_class_h5', false ) ) {
          echo '   h5 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xs_class_h5') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
   echo '}' . "\r\n";

   echo '@media (min-width:' . get_option( 'asd_responsive_fontsizer_breakpoint_sm', '768px' )  . ') {' . "\r\n";
      if ( get_option ('asd_responsive_fontsizer_sm_class_page', false ) ) {
          echo '   .page, #page, .single, .archive {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_page') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_sm_class_site_header', false ) ) {
          echo '   .site-header {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_site_header') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_sm_class_navbar_default', false ) ) {
          echo '   .navbar-default {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_navbar_default') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_sm_class_site_body', false ) ) {
          echo '   .site-body {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_site_body') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_sm_class_widget_area', false ) ) {
          echo '   .widget-area {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_widget_area') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_sm_class_site_footer', false ) ) {
          echo '   .site-footer {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_site_footer') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_sm_class_h1', false ) ) {
          echo '   h1 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_h1') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_sm_class_h2', false ) ) {
          echo '   h2 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_h2') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_sm_class_h3', false ) ) {
          echo '   h3 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_h3') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_sm_class_h4', false ) ) {
          echo '   h4 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_h4') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_sm_class_h5', false ) ) {
          echo '   h5 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_sm_class_h5') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
   echo '}' . "\r\n";

   echo '@media (min-width:' . get_option( 'asd_responsive_fontsizer_breakpoint_md', '992px' )  . ') {' . "\r\n";
      if ( get_option ('asd_responsive_fontsizer_md_class_page', false ) ) {
          echo '   .page, #page, .single, .archive {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_page') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_md_class_site_header', false ) ) {
          echo '   .site-header {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_site_header') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_md_class_navbar_default', false ) ) {
          echo '   .navbar-default {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_navbar_default') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_md_class_site_body', false ) ) {
          echo '   .site-body {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_site_body') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_md_class_widget_area', false ) ) {
          echo '   .widget-area {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_widget_area') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_md_class_site_footer', false ) ) {
          echo '   .site-footer {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_site_footer') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_md_class_h1', false ) ) {
          echo '   h1 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_h1') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_md_class_h2', false ) ) {
          echo '   h2 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_h2') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_md_class_h3', false ) ) {
          echo '   h3 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_h3') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_md_class_h4', false ) ) {
          echo '   h4 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_h4') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_md_class_h5', false ) ) {
          echo '   h5 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_md_class_h5') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
   echo '}' . "\r\n";

   echo '@media (min-width:' . get_option( 'asd_responsive_fontsizer_breakpoint_lg', '1200px' )  . ') {' . "\r\n";
      if ( get_option ('asd_responsive_fontsizer_lg_class_page', false ) ) {
          echo '   .page, #page, .single, .archive {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_page') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_lg_class_site_header', false ) ) {
          echo '   .site-header {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_site_header') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_lg_class_navbar_default', false ) ) {
          echo '   .navbar-default {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_navbar_default') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_lg_class_site_body', false ) ) {
          echo '   .site-body {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_site_body') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_lg_class_widget_area', false ) ) {
          echo '   .widget-area {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_widget_area') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_lg_class_site_footer', false ) ) {
          echo '   .site-footer {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_site_footer') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_lg_class_h1', false ) ) {
          echo '   h1 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_h1') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_lg_class_h2', false ) ) {
          echo '   h2 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_h2') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_lg_class_h3', false ) ) {
          echo '   h3 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_h3') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_lg_class_h4', false ) ) {
          echo '   h4 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_h4') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_lg_class_h5', false ) ) {
          echo '   h5 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_lg_class_h5') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
   echo '}' . "\r\n";



   echo '@media (min-width:' . get_option( 'asd_responsive_fontsizer_breakpoint_xl', '1600px' )  . ') {' . "\r\n";
      if ( get_option ('asd_responsive_fontsizer_xl_class_page', false ) ) {
          echo '   .page, #page, .single, .archive {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_page') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xl_class_site_header', false ) ) {
          echo '   .site-header {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_site_header') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xl_class_navbar_default', false ) ) {
          echo '   .navbar-default {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_navbar_default') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xl_class_site_body', false ) ) {
          echo '   .site-body {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_site_body') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xl_class_widget_area', false ) ) {
          echo '   .widget-area {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_widget_area') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xl_class_site_footer', false ) ) {
          echo '   .site-footer {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_site_footer') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xl_class_h1', false ) ) {
          echo '   h1 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_h1') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xl_class_h2', false ) ) {
          echo '   h2 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_h2') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xl_class_h3', false ) ) {
          echo '   h3 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_h3') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xl_class_h4', false ) ) {
          echo '   h4 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_h4') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xl_class_h5', false ) ) {
          echo '   h5 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xl_class_h5') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
   echo '}' . "\r\n";


   echo '@media (min-width:' . get_option( 'asd_responsive_fontsizer_breakpoint_xxl', '1900px' )  . ') {' . "\r\n";
      if ( get_option ('asd_responsive_fontsizer_xxl_class_page', false ) ) {
          echo '   .page, #page, .single, .archive {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_page') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xxl_class_site_header', false ) ) {
          echo '   .site-header {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_site_header') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xxl_class_navbar_default', false ) ) {
          echo '   .navbar-default {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_navbar_default') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xxl_class_site_body', false ) ) {
          echo '   .site-body {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_site_body') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xxl_class_widget_area', false ) ) {
          echo '   .widget-area {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_widget_area') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xxl_class_site_footer', false ) ) {
          echo '   .site-footer {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_site_footer') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xxl_class_h1', false ) ) {
          echo '   h1 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_h1') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xxl_class_h2', false ) ) {
          echo '   h2 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_h2') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xxl_class_h3', false ) ) {
          echo '   h3 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_h3') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xxl_class_h4', false ) ) {
          echo '   h4 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_h4') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
      if ( get_option ('asd_responsive_fontsizer_xxl_class_h5', false ) ) {
          echo '   h5 {' . "\r\n";
          echo '       font-size:' . get_option ('asd_responsive_fontsizer_xxl_class_h5') . ';' . "\r\n";
          echo '   }' . "\r\n";
      }
   echo '}' . "\r\n";



   echo '</style>' . "\r\n";

}
add_action( 'wp_print_footer_scripts', 'asd_responsive_fontsizer_print_css' );

