<?php
/**
 * Adds admin menu and creates admin page content.
 * 
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Pages;

use ResilientBits\Inc\Api\SettingsApi;
use ResilientBits\Inc\Base\BaseController;
use ResilientBits\Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = [];

	public $subpages = [];

	/**
	 * Register admin menu, pages, subpages, and callbacks.
	 * @return void
	 */
	public function register(): void
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->setupCustomSettings();
		$this->setupSettingsSection();
		$this->setupSettingsFields();

		$this->settings
			->addPages($this->pages)
			->withSubPage('Dashboard')
			->addSubPages($this->subpages)
			->register();
	}

	/**
	 * Populates args for admin pages
	 * @return void
	 */
	protected function setPages(): void
	{
		$this->pages = [
			[
				'page_title' => 'Resilient Bits Plugin',
				'menu_title' => 'ResilientBits',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_plugin',
				'callback' => [$this->callbacks, 'adminDashboard'],
				'icon_url' => 'dashicons-store',
				'position' => 110
			]
		];
	}

	/**
	 * Populates args for admin subpages
	 * @return void
	 */
	protected function setSubpages(): void
	{
		$this->subpages = [
			[
				'parent_slug' => 'resilientbits_plugin',
				'page_title' => 'Custom Post Types',
				'menu_title' => 'CPT',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_cpt',
				'callback' => [$this->callbacks, 'adminCPTManager'],
			],
			[
				'parent_slug' => 'resilientbits_plugin',
				'page_title' => 'Custom Taxonomies',
				'menu_title' => 'Taxonomies',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_taxonomies',
				'callback' => [$this->callbacks, 'adminTaxonomiesManager']
			],
			[
				'parent_slug' => 'resilientbits_plugin',
				'page_title' => 'Custom Widgets',
				'menu_title' => 'Widgets',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_widgets',
				'callback' => [$this->callbacks, 'adminWidgetsManager']
			],
		];
	}

	/**
	 * Initializes args for custom settings for the admin page.
	 * @return void
	 */
	public function setupCustomSettings()
	{
		$args = [
			[
				'option_group' => 'resilientbits_options_group',
				'option_name' => 'first_name',
				'callback' => [$this->callbacks, 'resilientbitsOptionsGroup']
			],
			[
				'option_group' => 'resilientbits_options_group',
				'option_name' => 'last_name'
			]
		];
		$this->settings->setCustomSettings($args);
	}

	/**
	 * Initializes args for sections in a custom setting.
	 * @return void
	 */
	public function setupSettingsSection()
	{
		$args = [
			[
				'id' => 'resilientbits_admin_index',
				'title' => 'Settings',
				'callback' => [$this->callbacks, 'resilientbitsAdminSection'],
				'page' => 'resilientbits_plugin'
			]
		];
		$this->settings->setCustomSettingSections($args);
	}

	/**
	 * Initializes args for fields in a custom setting
	 * @return void
	 */
	public function setupSettingsFields()
	{
		$args = [
			[
				'id' => 'first_name',
				'title' => 'First Name',
				'callback' => [$this->callbacks, 'resilientbitsFirstName'],
				'page' => 'resilientbits_plugin',
				'section' => 'resilientbits_admin_index',
				'args' => [
					'label_for' => 'first_name',
					'class' => 'example-class'
				]
			],
			[
				'id' => 'last_name',
				'title' => 'Last Name',
				'callback' => [$this->callbacks, 'resilientbitsLastName'],
				'page' => 'resilientbits_plugin',
				'section' => 'resilientbits_admin_index',
				'args' => [
					'label_for' => 'last_name',
					'class' => 'example-class'
				]
			],
		];
		$this->settings->setCustomSettingFields($args);
	}
}