<?php 
/**
 * Provides API to Admin Menu Settings.
 * 
 * @author Adeel Ahmad <6880680+adeelahmadk@users.noreply.github.com>
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Api;

use ResilientBits\Inc\Api\Callbacks\AdminCallbacks;

class SettingsApi
{
    public $admin_pages = [];

    public $admin_subpages = [];

    public $settings = [];

    public $sections = [];
    
    public $fields = [];

    public $callbacks;

    public function __construct() {
        $this->callbacks = new AdminCallbacks();
    }

    /**
     * Registers callbacks for admin menu & custom fields.
     * @return void
     */
    public function register(): void
    {
        if (!empty($this->admin_pages)) {
            add_action("admin_menu", [$this, "addAdminMenu"]);
        }

        if (!empty($this->settings)) {
            add_action("admin_init", [$this,"registerCustomFields"]);
        }
    }

    /**
     * Callback for admin_menu hook.
     * 
     * Adds menu pages and subpages iteratively.
     * @return void
     */
    public function addAdminMenu(): void
    {
        foreach ($this->admin_pages as $page) {
            add_menu_page(
                $page["page_title"],
                $page["menu_title"],
                $page["capability"],
                $page["menu_slug"],
                $page["callback"],
                $page["icon_url"],
                $page["position"]
            );
        }

        foreach ($this->admin_subpages as $page) {
            add_submenu_page(
                $page["parent_slug"],
                $page["page_title"],
                $page["menu_title"],
                $page["capability"],
                $page["menu_slug"],
                $page["callback"],
            );
        }
    }

    /**
     * Stores page args.
     * @param array $pages Array of page arg arrays
     * @return SettingsApi Current instance of the class
     */
    public function addPages(array $pages): self
    {
        $this->admin_pages = $pages;

        return $this;
    }

    /**
     * Stores args for the first subpage
     * @param string $title Title of first subpage
     * @return SettingsApi Current instance of the class
     */
    public function withSubPage(string $title = null): self
    {
        if (empty($this->admin_pages)) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $subpage = [
            [
                'parent_slug' => $admin_page['menu_slug'],
                'page_title' => $admin_page['page_title'],
                'menu_title' => $title ?? $admin_page['menu_title'],
                'capability' => $admin_page['capability'],
                'menu_slug' => $admin_page['menu_slug'],
                'callback' => $admin_page['callback']
            ]
        ];

        $this->admin_subpages = $subpage;
        return $this;
    }

    /**
     * Stores args for the subpages
     * @param array $pages Array of subpage arg arrays
     * @return SettingsApi Current instance of the class
     */
    public function addSubPages(array $pages): self
    {
        $this->admin_subpages = array_merge($this->admin_subpages, $pages);

        return $this;
    }

    /**
     * Stores a custom setting and its data.
     * @param array $settings Data used to describe the custom setting at registration
     * @return SettingsApi Current instance of the class
     */
    public function setCustomSettings(array $settings): self
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Stores a section of a setting
     * @param array $sections
     * @return SettingsApi Current instance of the class
     */
    public function setCustomSettingSections(array $sections): self
    {
        $this->sections = $sections;

        return $this;
    }

    /**
     * Stores a 
     * @param array $fields
     * @return SettingsApi
     */
    public function setCustomSettingFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function registerCustomFields()
    {
        // register setting
        foreach ($this->settings as $setting) {
            register_setting(
                $setting['option_group'],
                $setting['option_name'],
                $setting['callback'] ?? ''
            );
        }

        // add settings section
        foreach ($this->sections as $section) {
            add_settings_section(
                $section['id'],
                $section['title'],
                $section['callback'] ?? '',
                $section['page']
            );
        }

        // add setting fields
        foreach ($this->fields as $field) {
            add_settings_field(
                $field['id'],
                $field['title'],
                $field['callback'] ?? '',
                $field['page'],
                $field['section'],
                $field['args'] ?? []
            );
        }
    }
}