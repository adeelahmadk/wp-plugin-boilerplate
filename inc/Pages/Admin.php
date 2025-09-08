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

	public function register(): void
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->settings
			->addPages($this->pages)
			->withSubPage('Dashboard')
			->addSubPages($this->subpages)
			->register();
	}

	protected function setPages(): void {
		$this->pages = [
			[
				'page_title' => 'Resilient Bits Plugin',
				'menu_title' => 'ResilientBits',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_plugin',
				'callback' => [ $this->callbacks, 'adminDashboard' ],
				'icon_url' => 'dashicons-store',
				'position' => 110
			]
		];		
	}

	protected function setSubpages() {
		$this->subpages = [
			[
				'parent_slug' => 'resilientbits_plugin',
				'page_title' => 'Custom Post Types',
				'menu_title' => 'CPT',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_cpt',
				'callback' => [ $this->callbacks,'adminCPTManager'],
			],
			[
				'parent_slug' => 'resilientbits_plugin',
				'page_title' => 'Custom Taxonomies',
				'menu_title' => 'Taxonomies',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_taxonomies',
				'callback' => [ $this->callbacks,'adminTaxonomiesManager']
			],
			[
				'parent_slug' => 'resilientbits_plugin',
				'page_title' => 'Custom Widgets',
				'menu_title' => 'Widgets',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_widgets',
				'callback' => [ $this->callbacks,'adminWidgetsManager']
			],
		];
	}
}