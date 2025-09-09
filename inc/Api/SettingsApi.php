<?php
/**
 * Provides API to Admin Menu Settings.
 * 
 * @author Adeel Ahmad <6880680+adeelahmadk@users.noreply.github.com>
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Api;

class SettingsApi
{
    public $admin_pages = [];

    public $admin_subpages = [];

    /**
     * Registers callback for admin_menu hook.
     * @return void
     */
    public function register(): void
    {
        if (!empty($this->admin_pages)) {
            add_action("admin_menu", [$this, "addAdminMenu"]);
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
}