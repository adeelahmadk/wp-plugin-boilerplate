<?php
/**
 * Defines project-level constants
 * 
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Base;

class BaseController
{
    protected $plugin;

    protected $plugin_name;

    protected $plugin_url;

    protected $plugin_path;

    public function __construct()
    {
        $base_dir = plugin_basename(dirname(__FILE__, 3));
        $this->plugin = "$base_dir/$base_dir.php";
        $this->plugin_name = ucwords(
            str_replace(
                "-",
                " ",
                $base_dir
            )
        );
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
    }
}