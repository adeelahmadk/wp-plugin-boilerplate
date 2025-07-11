<?php
/**
* @package  ResilientBitsPlugin
*/
/*
Plugin Name: Resilient Bits Plugin
Plugin URI: http://resilientbits.com/plugin
Description: This is a template for writing a custom Plugin in object oriented PHP.
Version: 1.0.0
Author: Adeel Ahmad
Author URI: http://adeelahmadk.github.io
License: GPLv2 or later
Text Domain: resbit-plugin
*/

defined('ABSPATH') or die('Hey, you are not supposed to be here!');

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use ResilientBits\Inc\StateManager;
use ResilientBits\Inc\Admin\AdminPages;

if (!class_exists('ResilientBitsPlugin')) {

    class ResilientBitsPlugin {
        public string $plugin;

        public function __construct() {
            $this->plugin = plugin_basename (__FILE__);
        }

        public function register() {
            add_action('admin_enqueue_scripts', array($this, 'enqueue'));

            add_action('admin_menu', array($this, 'add_admin_pages'));

            add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
        }

        public function settings_link($links) {
            $settings_link = '<a href="admin.php?page=resilientbits_plugin">Settings</a>';
            array_push($links, $settings_link);
            return $links;
        }

        public function add_admin_pages() {
            add_menu_page(
                'Resilient Bits Plugin', // page title
                'ResilientBits', // menu title
                'manage_options', // capability
                'resilientbits_plugin', // menu slug
                array($this, 'admin_index'), // callback
                'dashicons-store', // icon
                110 // position
            );
        }

        public function admin_index() {
            require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
        }

        protected function create_post_type() {
            add_action('init', array($this, 'custom_post_type'));
        }

        public function custom_post_type() {
            register_post_type('book', ['public' => true, 'label' => 'Books']);
        }

        public function enqueue() {
            // enqueue all our scripts
            wp_enqueue_style('resbitpluginstyle', plugins_url('/assets/style.css', __FILE__));
            wp_enqueue_script('resbitpluginscript', plugins_url('/assets/script.js', __FILE__));
        }

        public function activate() {
            // register CPT
            // activate
            StateManager::activate();
        }
    }

    $resbitPlugin = new ResilientBitsPlugin();
    $resbitPlugin->register();

    // activation
    register_activation_hook(__FILE__, array($resbitPlugin, 'activate'));

    // deactivation
    /* use fully qualified class name:
       - 'ResilientBits\Inc\StateManager', or
       - StateManager::class
    */
    register_deactivation_hook(__FILE__, array(StateManager::class, 'deactivate'));
}