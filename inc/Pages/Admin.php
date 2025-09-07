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
			],
			[
				'page_title' => 'Test Plugin',
				'menu_title' => 'Test',
				'capability' => 'manage_options',
				'menu_slug' => 'test_plugin',
				'callback' => function () {
					echo '<h1>External Test</h1>';
				},
				'icon_url' => 'dashicons-external',
				'position' => 9
			]
		];
	}

	public function register(): void
	{
		// add_action('admin_menu', [$this, 'add_admin_pages']);
		$this->settings->addPages($this->pages)->register();
	}

	// public function admin_index(): void
	// {
	// 	require_once "{$this->plugin_path}templates/admin.php";
	// 	$this->index();
	// }
	// public function index(): void
	// {
	// }
}