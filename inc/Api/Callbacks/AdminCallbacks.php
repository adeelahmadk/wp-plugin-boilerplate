<?php
/**
 * Defines callbacks for admin menu.
 * 
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Api\Callbacks;

use ResilientBits\Inc\Base\BaseController;

class AdminCallbacks extends BaseController {
    public function adminDashboard() {
        return require_once "$this->plugin_path/templates/admin.php";
    }

    public function adminCPTManager() {
        echo '<h1>CPT Manager</h1>';
    }

    public function adminTaxonomiesManager() {
        echo '<h1>Taxonomies Manager</h1>';
    }

    public function adminWidgetsManager() {
        echo '<h1>Widgets Manager</h1>';
    }
}