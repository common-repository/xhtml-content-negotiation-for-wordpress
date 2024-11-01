=== XHTML Content Negotiation for WordPress ===
Contributors: solarissmoke
Tags: xhtml, MIME, content-type, application/xhtml+xml
Requires at least: 2.0.2
Tested up to: 3.4
Stable tag: trunk

A plugin to serve WordPress content using the application/xhtml+xml MIME type

== Description ==

A plugin to allow WordPress to serve content using the application/xhtml+xml MIME type, based on the client's HTTP ACCEPT request. It also takes into account the q-values of the request, in compliance with [RFC2616 HTTP/1.1](http://tools.ietf.org/html/rfc2616#page-100). The plugin also handles clients that don't supply an ACCEPT header (e.g., the W3C Validator).

The plugin detects IE8 and lower and serves content as text/html, because it doesn't follow the HTTP 1.1 requirement and can't parse application/xhtml+xml anyway.

**Note: if you use this plugin, you MUST ensure that you have and appropriate DTD and XHTML namespace in your document. If you don't, some browsers may render your document as an XML tree. You must also ensure that your theme produces well-formed and valid XHTML, otherwise you will get XML parsing errors in your browser.**

This plugin requires PHP version 5 or greater.

If you come across any bugs or have suggestions, please use the plugin support forum or contact me at [rayofsolaris.net](http://rayofsolaris.net). Please check the [FAQ](http://wordpress.org/extend/plugins/xhtml-content-negotiation-for-wordpress/) for common issues.

== Frequently Asked Questions ==

= Google Adsense does not work with this plugin. Why? =

That is a problem with Google Adsense which assumes that you will be sending content as `text/html`, and it breaks if you send it as `application/xhtml+xml`. [This web page](http://www.cssplay.co.uk/menu/adsense.html) offers a Javascript-based solution that seems to work, and doesn't upset Google.

= My browser is giving me an XML parsing error. =

This means that your theme is producing invalid XHTML, and you probably need to contact the theme authors. I find that this is most often caused by using invalid HTML entities in the document.

= My browser is rendering the document as an XML tree. =

This means that your DTD and/or XHTML namespace are incorrect. Check to make sure that the DTD is a valid XHTML doctype and that your `html` tag contains the XHTML namespace (`xmlns="http://www.w3.org/1999/xhtml"`).

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.5 =
* Added detection for IE9 which supports application/xhtml+xml

= 1.4 =
* Fixed a bug where some q-values were parsed incorrectly.
* Inserted class wrapper

= 1.3 =
* Fixed a bug from version 1.2 that caused a PHP "unknown modifier" warning (thanks to [Matt](http://www.balancedlifeministry.org/)).

= 1.2 =
* Added a check for MS Pocket IE, which would otherwise have been served XHTML
* Restructured some code for readability and extensibility (thanks to [Craig Loftus](http://craigloftus.net/))

= 1.1 =
* There was no catch-all return if the q-value evaluation was inconclusive - fixed
* Tidied up some code for readability
