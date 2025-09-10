<?php
/**
 * Defines callbacks for admin menu.
 * 
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Api\Callbacks;

use ResilientBits\Inc\Base\BaseController;

class AdminCallbacks extends BaseController {
    /**
     * Callback to load Admin dashboard template.
     * @return bool
     */
    public function adminDashboard(): bool {
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

    public function resilientbitsOptionsGroup($input) {
        return $input;
    }

    public function resilientbitsAdminSection() {
        echo 'Custom Settings Section...';
    }

    public function resilientbitsLastName() {
        $value = esc_attr( get_option('last_name') );
        echo '<input type="text" class="regular-text" name="last_name" value="' . $value .
            '" placeholder="Your last name here...">';
    }

    public function resilientbitsFirstName() {
        $value = esc_attr( get_option('first_name') );
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value .
            '" placeholder="Your first name here...">';
    }
}