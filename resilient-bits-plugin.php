<?php
/**
 * @package  ResilientBitsPlugin
 */
/*
Plugin Name: Resilient Bits Plugin
Plugin URI: https://github.com/adeelahmadk/wp-plugin-boilerplate
Description: This is a template for writing a custom Plugin in object oriented PHP.
Version: 1.0.0
Author: Adeel Ahmad <6880680+adeelahmadk@users.noreply.github.com>
Author URI: http://adeelahmadk.github.io
License: GPLv2 or later
Text Domain: resbit-plugin
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
along with this program; if not, see
<https://www.gnu.org/licenses/>.

Copyright (C) 2025  Adeel Ahmad
*/

defined('ABSPATH') or die('Hey, you are not supposed to be here!');

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// activation
register_activation_hook(__FILE__, [ResilientBits\Inc\Base\StateManager::class, 'activate']);

// deactivation
/* use fully qualified class name:
    - 'ResilientBits\Inc\Base\StateManager', or
    - StateManager::class
*/
register_deactivation_hook(__FILE__, [ResilientBits\Inc\Base\StateManager::class, 'deactivate']);

if (class_exists(ResilientBits\Inc\Init::class)) {
    ResilientBits\Inc\Init::register_services();
}