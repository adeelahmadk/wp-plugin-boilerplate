<?php
/**
 * Enqueues styles and scripts
 * 
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Base;

class Enqueue extends \ResilientBits\Inc\Base\BaseController
{
    public function register(): void
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        // enqueue all our scripts
        wp_enqueue_style('resbit_plugin_style', "{$this->plugin_url}assets/style.css");
        wp_enqueue_script('resbit_plugin_script', "{$this->plugin_url}assets/script.js");
    }
}