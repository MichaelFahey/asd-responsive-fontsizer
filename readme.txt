=== ASD Responsive Font Sizer ===
Contributors: michaelfahey
Tags: responsive, font-size, underscores
Requires PHP: 5.6
Requires at least: 3.6
Tested up to: 4.9.8
Stable tag: 1.201811241
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Plugin URI:  https://artisansitedesigns.com/plugins/asd-responsive-font-sizer/
Author URI:  https://artisansitedesigns.com/staff/michael-h-fahey/
Donate link: https://paypal.me/artisanmichaelfahey

=== Description ===
An easy grid in Dashboard allows you to assign font sizes to common page elements across various screen sizes. The breakpoints which define these sizes can also be adjusted. Included as page elements are header tag sizes, and classes found in the Underscores parent theme which means that it is likely to work properly on any Underscores-derived theme (which is a lot of themes , http://underscores.me)

== Installation ==

= Manual installation =
At a command prompt or using a file manager, unzip the .ZIP file in the WordPress plugins directory, usually ~/public_html/wp-content/plugins . In the In the WordPress admin Dashboard (usually http://yoursite.foo/wp-admin ) click Plugins, scroll to ASD Fullwidth Element Sizer, and click "activate".

= Upload in Dashboard =
Download the ZIP file to your workstation.  In the WordPress admin Dashboard (usually http://yoursite.foo/wp-admin ) Select Plugins, Add New, click Upload Plugin, Choose File and navigate to the downloaded ZIP file. After that, click Install Now, and when the installer finishes, click Activate Plugin.

= Clone From Github = 
The repository for this plugin can be downloaded directly from GitHub with the command:
git clone https://github.com/MichaelFahey/asd-responsive-fontsizer.git

== Frequently Asked Questions ==

Q: Do I have to populate all the sizes?
A: No and usually it's not even a good idea. The way that it works is that the XS (phone) sizes are separate, and all the other sizes inherit sfont sizes from the smaller ones, for example the MD definitions propagate up to the LG and XL sizes. You will likely end up defining a lot of sizes in XS for mobile, MD for tablets, and just a few more in LG and XS etc.

Q: Do I have to use the save buttons for each separate size?
A: Indeed, it's a known inconvenience, until I work up a mechanism to simplify each screen size must be saved individually with its own save button.

== Changelog ==
= 1.201811241 2018-11-24 =
First release candidate.

== Upgrade Notice ==
= 1.201811241 2018-11-24 =
N/A
