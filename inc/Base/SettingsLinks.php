<?php
/**
 * Registers settings link in plugins list page.
 * 
 * @author Adeel Ahmad <6880680+adeelahmadk@users.noreply.github.com>
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Base;

class SettingsLinks
{
    public function register(): void
    {
        add_filter(
            'plugin_action_links_' . PLUGIN,
            [$this, 'add_settings_link']
        );
    }

    public function add_settings_link(array $links): array
    {
        // add action links for our plugin in the Plugins list table.
        $settings_link = '<a href="admin.php?page=resilientbits_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
}