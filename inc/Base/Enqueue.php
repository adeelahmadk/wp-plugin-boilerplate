<?php
/**
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Base;

class Enqueue
{
    public function register(): void
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        // enqueue all our scripts
        wp_enqueue_style('resbit_plugin_style', PLUGIN_URL . 'assets/style.css');
        wp_enqueue_script('resbit_plugin_script', PLUGIN_URL . 'assets/script.js');
    }

}