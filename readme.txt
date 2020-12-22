=== Remove Special Characters From Permalinks ===
Contributors: karzin
Tags: remove,special,problematic,characters,permalink,permalinks
Requires at least: 4.4
Tested up to: 5.6
Stable tag: 1.0.4
Requires PHP: 5.6.0
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=pablo.sg.pacheco@gmail.com&lc=US&item_name=Remove+Special+Characters+From+Permalinks&no_note=0&no_shipping=2&curency_code=USD&bn=PP-DonationsBF:btn_donateCC_LG.gif:NonHosted
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Removes special characters from permalinks

== Description ==

If you are using pretty permalinks, you may have noticed WordPress sanitizes it removing accents and some special characters.

However some of these characters are not sanitized by default, meaning they can be added to some of your post URLs, like a trademark symbol(®), a copyright symbol(©) or even a [UTF-8 symbol](https://www.utf8icons.com/) like ⛓.

Although it may not hurt you at first, it may let users confused and it can cause some problems when interacting with some third party API that is not prepared to read such characters.

This plugin Removes special characters from permalinks when the post is created or updated.

== How to use it? ==

All you have to do is saving/updating your post and you will notice special characters will be swiped out from the permalink.

== Pro Version ==

Enjoying the free version of this plugin?

We have a Pro version that allows removing characters from all permalinks of your site with just one click, including posts, pages and custom post types.
We also offer support if you have some sort of problem.

[Update to PRO](https://wpfactory.com/item/remove-special-characters-from-permalinks-wordpress-plugin/) for a better plugin and helping maintaining the development of this plugin

== Frequently Asked Questions ==

= How can I contribute? Is there a github repository? =
If you are interested in contributing - head over to the [Remove Special Characters From Permalinks](https://github.com/thanks-to-it/remove-special-characters-from-permalinks) plugin GitHub Repository to find out how you can pitch in.

== Installation ==

1. Upload the entire 'remove-special-characters-from-permalinks' folder to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Screenshots ==

== Changelog ==

= 1.0.5 - 22/12/2020 =
* Fix markdown getting lost on post update.
* Tested up to: 5.6

= 1.0.4 - 10/10/2020 =
* Replace `sanitize_title` by 'save_post' hook.
* Improve special characters replacing function.
* Tested up to: 5.5

= 1.0.3 - 19/10/2018 =
* Check if permalink seems utf8 before removing characters
* Inform about pro version

= 1.0.2 - 22/09/2018 =
* Handle localization
* Fix domain path

= 1.0.1 - 22/09/2018 =
* Handle localization

= 1.0.0 - 12/09/2018 =
* Initial Release.

== Upgrade Notice ==

= 1.0.0 =
* Initial Release.