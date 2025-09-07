<?php
/**
 * Settings API.
 * 
 * @author Adeel Ahmad <6880680+adeelahmadk@users.noreply.github.com>
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Api;

class SettingsApi
{
    public $admin_pages = [];

    public function register()
    {
        if (!empty($this->admin_pages)) {
            add_action("admin_menu", [$this, "addAdminMenu"]);
        }
    }

    public function addPages(array $pages)
    {
        $this->admin_pages = $pages;
        return $this;
    }

    public function addAdminMenu()
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
    }
}