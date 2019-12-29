=== Embed Post ===
Contributors: hxii
Donate link: https://paulglushak.com
Tags: embed, post
Requires at least: 4.6
Tested up to: 5.4
Stable tag: 1.0.1
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to embed posts into other posts.

== Description ==

![yo dawg](https://i.imgur.com/1Lo9m26.jpg)

A __VERY__ simple plugin born out of necessity (an my inability to find something similar) by a friend of mine that will allow you to embed a post in a different post using a shortcode.

= But why? =

This can be a good solution if you'd like, for example, to reference content in multiple pages and be able to modify it from a single source.

= Usage =
Just write `[embed_post post_id=XX]` in your post where `XX` is the ID of the post you'd like to embed.
There are two built-in styles: `default` and `seamless`, both of which you can specify (as well as your OWN class) using the `class` attribute, e.g `[embed_post post_id=20 class="seamless"]`.
You can also output the excerpt by using `excerpt=true`.

== Frequently Asked Questions ==

= Can you add {feature_name} or {style_name}? =

Maybe. Get in touch with me and I'll see what I can do.

= I used the same post ID and now my website is broken! =

Recursion is on you, buddy.
Use your favorite method to access your WP DB and modify the post manually.

== Screenshots ==

1. An example.

== Changelog ==

= 1.0.2 =
* Initial WP.org commit