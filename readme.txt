=== Buffer Flush Fix ===

Contributors: openwrite
Stable tag: 1.0
Tested up to: 5.2
Requires at least: 2.2

== Description ==

If you've run into the error "failed to send buffer of zlib output compression" with WordPress, this simple plugin fixes the issue.

The plugin replaces the default "wp_ob_end_flush_all" implementation, by adding a check for whether zlib compression is on. If it is,
then buffer level one isn't flushed. This prevents WordPress from trying to flush the 'reserved' compression buffer, which causes an error.

A patch has also been submitted to the WordPress core, with this plugin as an interim solution.
