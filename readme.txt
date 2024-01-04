=== Plugin Name ===
Contributors: CoenJacobs
Donate link: http://coenjacobs.me/about#donate
Tags: wysiwyg, widgets
Requires at least: 3.0
Tested up to: 4.2.2
Stable tag: 0.6.1

Adds a custom post type that can be easily inserted at multiple spots, including widgets. Easy way to create WYSIWYG widgets.

== Description ==

Adds a custom post type that can be easily inserted at multiple spots, including widgets. Easy way to create WYSIWYG widgets.

This plugin is still alive. It has been tested to run on the most recent WordPress version and it still works fine. Future versions will bring more features and an updated code base.

Please use the [support forums](https://wordpress.org/support/plugin/smart-wysiwyg-blocks-of-content) to request support in case you have some kind of trouble. You can contribute to the plugin via the [GitHub repository](https://github.com/coenjacobs/smart-wysiwyg-blocks-of-content). Pull requests or bug reports are very welcome there.

== Installation ==

This WordPress Codex has really good documentation on [Installing plugins](https://codex.wordpress.org/Managing_Plugins#Installing_Plugins). In short:

1. Upload `smart-wysiwyg-blocks-of-content` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add a Smart Block, using the added menu item `Smart Blocks`
1. Add a widget to a sidebar and select the options and a specific Smart Block to show
1. Add the shortcode `[smartblock id=<SWBOC_ID>]` in a post or page to show the Smart Block there

== Frequently Asked Questions ==

== Screenshots ==

1. Example of a filled widget form
1. Adding Smart Blocks via the menu item

== Changelog ==

= 0.6.1 - 17/05/2015 =
* This plugin is still alive. Verified it still works on WordPress 4.2.2.
* Fix: Isset check to check values in widget form to prevent notices

= 0.6 =
* Do not show widget title if title is empty.
* Temporarely disable prepend_attachment filter to prevent strange output.

= 0.5.2 =
* Get and restore $post global var to make sure the_content filters use the correct post (Thanks Danny de Haan!).

= 0.5.1 =
* Split classes to external files and updated to WordPress coding standards.

= 0.5 =
* Switched to get_posts instead of query_posts. Should help some users problems with breaking loops.

= 0.4.3 =
* Fixed a bug that caused users not longer being able to select a Smart Block in a widget.

= 0.4.2 =
* Fixed the shortcode bug, in which the Smart Block Content was posted at the top of the post/page content.

= 0.4.1 =
* Fixed the bug that was introduced while using it since WordPress 3.1 (Thanks Nacin for the help!)

= 0.4 =
* Several little bug fixes

= 0.3 =
* Added shortcode for easy insertion in posts and pages

= 0.2.1 =
* Few minor bug fixes

= 0.2 =
* Added combobox to the widget for easy selection of the wanted Smart Block

= 0.1 =
* Initial release