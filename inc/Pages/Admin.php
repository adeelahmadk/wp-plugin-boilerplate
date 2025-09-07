<?php
/**
 * Adds admin menu and creates admin page content.
 * 
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Pages;

class Admin extends \ResilientBits\Inc\Base\BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function register(): void
	{
		add_action('admin_menu', [$this, 'add_admin_pages']);
	}

	public function add_admin_pages(): void
	{
		add_menu_page(
			'Resilient Bits Plugin', // page title
			'ResilientBits', // menu title
			'manage_options', // capability
			'resilientbits_plugin', // menu slug
			[$this, 'admin_index'], // callback
			'dashicons-store', // icon
			110 // position
		);
	}

	public function admin_index(): void
	{
		require_once "{$this->plugin_path}templates/admin.php";
		$this->index();
	}
	public function index(): void
	{
		?>
		<h2>Admin Page</h2>
		<div id="notice-message" class="notice notice-info is-dismissible">
			<p>Admin page registered in <?php echo "{$this->plugin}"; ?>.</p>
		</div>
		<p>Welcome to the admin page of our <?php echo $this->plugin_name; ?>!</p>
		<?php
	}
}