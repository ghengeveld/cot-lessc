LESS CSS for Cotonti
====================

This plugin is based on lessphp, a compiler for LESS written in PHP. LESS extends CSS with variables, mixins, operations and nesting.

More information about LESS syntax:
-----------------------------------

- [lesscss.org](http://lesscss.org) (original Ruby implementation)
- [lessphp docs](http://leafo.net/lessphp/docs/) (PHP implementation)

What it does:
-------------

The plugin will look for .less files in your theme (skin) folder, as well as its /css subdirectory. It will compile any .less files it finds to the .css counterpart (using the same filename), but only if the file doesn't exist yet or the .css file is older than the .less file. Filenames (*.less) are cached in order to prevent PHP from searching for .less files in the theme directory on every page load.

What does this mean for theme development:
------------------------------------------

Instead of writing regular .css files, you can write .less files using the LESS syntax. You still include the .css file in your header.tpl, not the .less file. The .css file is created automatically. To get started, you can simply rename your existing .css files to .less, because the LESS syntax is based on regular CSS (it's just an extension). Using LESS doesn't change the way you develop themes, other than using the .less file extension (and allowing you to use the LESS features of course).

Note for Genoa users:
---------------------

This plugin is written for Siena. In order for it to work in Genoa (0.6) and before, you have to modify lessc.php to change /themes to /skins. Also, right below 'Hooks=header.first' (line 4), add this line:

    Tags=

Installation
============

1. Upload the plugin files as normal.
2. Install the plugin through the admin panel.
3. Set CHMOD 777 on /themes/yourtheme and /themes/yourtheme/css. This can be done with most FTP clients. For Genoa and before its in /skins.