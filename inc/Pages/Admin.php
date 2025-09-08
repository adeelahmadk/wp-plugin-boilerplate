<?php
/**
 * Adds admin menu and creates admin page content.
 * 
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Pages;

use ResilientBits\Inc\Api\SettingsApi;

class Admin extends \ResilientBits\Inc\Base\BaseController
{
	public $settings;

	public $pages = [];

	public $subpages = [];

	public function __construct()
	{
		parent::__construct();
		$this->settings = new SettingsApi();
		$this->pages = [
			[
				'page_title' => 'Resilient Bits Plugin',
				'menu_title' => 'ResilientBits',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_plugin',
				'callback' => function () {
					echo '<h1>Resilient Bits</h1>';
				},
				'icon_url' => 'dashicons-store',
				'position' => 110
			]
		];

		$this->subpages = [
			[
				'parent_slug' => 'resilientbits_plugin',
				'page_title' => 'Custom Post Types',
				'menu_title' => 'CPT',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_cpt',
				'callback' => function () {
					echo '<h1>CPT Manager</h1>';
				}
			],
			[
				'parent_slug' => 'resilientbits_plugin',
				'page_title' => 'Custom Taxonomies',
				'menu_title' => 'Taxonomies',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_taxonomies',
				'callback' => function () {
					echo '<h1>Taxonomies Manager</h1>';
				}
			],
			[
				'parent_slug' => 'resilientbits_plugin',
				'page_title' => 'Custom Widgets',
				'menu_title' => 'Widgets',
				'capability' => 'manage_options',
				'menu_slug' => 'resilientbits_widgets',
				'callback' => function () {
					echo '<h1>Widgets Manager</h1>';
				}
			],
		];
	}

	public function register(): void
	{
		$this->settings
			->addPages($this->pages)
			->withSubPage('Dashboard')
			->addSubPages($this->subpages)
			->register();
	}
}