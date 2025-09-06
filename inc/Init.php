<?php
/**
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc;

final class Init
{
    /**
     * Returns a list of classes
     * @return string[] list of classes
     */
    public static function get_services(): array
    {
        return [
            Pages\Admin::class,
            Base\Enqueue::class
        ];
    }

    /**
     * Iterate over all classes, initialize them, and
     * call register method if it exists.
     * @return void
     */
    public static function register_services(): void
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, "register")) {
                $service->register();
            }
        }
    }

    /**
     * Instantiate object of a class
     * @param string $class class form the services array
     * @return object new instance of the class
     */
    private static function instantiate(string $class): object {
        return new $class();
    }
}

// if (!class_exists('ResilientBitsPlugin')) {

//     class ResilientBitsPlugin {
//         public string $plugin;
//         protected Admin $adminPages;

//         public function __construct() {
//             $this->plugin = plugin_basename (__FILE__);
//             $this->adminPages = new Admin(
//                 str_replace("-", " ", explode("/", $this->plugin)[0])
//             );
//         }

//         public function register() {
//             add_action('admin_enqueue_scripts', [$this, 'enqueue']);

//             add_action('admin_menu', [$this, 'add_admin_pages']);

//             add_filter("plugin_action_links_$this->plugin", [$this, 'settings_link']);
//         }

//         public function settings_link($links) {
//             // add action links for our plugin in the Plugins list table.
//             $settings_link = '<a href="admin.php?page=resilientbits_plugin">Settings</a>';
//             array_push($links, $settings_link);
//             return $links;
//         }

//         public function add_admin_pages() {
//             add_menu_page(
//                 'Resilient Bits Plugin', // page title
//                 'ResilientBits', // menu title
//                 'manage_options', // capability
//                 'resilientbits_plugin', // menu slug
//                 [$this, 'admin_index'], // callback
//                 'dashicons-store', // icon
//                 110 // position
//             );
//         }

//         public function admin_index() {
//             require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
//             $this->adminPages->index();
//         }

//         protected function create_post_type() {
//             add_action('init', [$this, 'custom_post_type']);
//         }

//         public function custom_post_type() {
//             register_post_type('book', ['public' => true, 'label' => 'Books']);
//         }

//         public function enqueue() {
//             // enqueue all our scripts
//             wp_enqueue_style('resbit_plugin_style', plugins_url('/assets/style.css', __FILE__));
//             wp_enqueue_script('resbit_plugin_script', plugins_url('/assets/script.js', __FILE__));
//         }

//         public function activate() {
//             // call protected method to register CPT
//             // $this->create_post_type();
//             // flush rewrite rules
//             StateManager::activate();
//         }
//     }

//     $resbitPlugin = new ResilientBitsPlugin();
//     $resbitPlugin->register();  // register hooks

//     // activation
//     register_activation_hook(__FILE__, [$resbitPlugin, 'activate']);

//     // deactivation
//     /* use fully qualified class name:
//        - 'ResilientBits\Inc\Base\StateManager', or
//        - StateManager::class
//     */
//     register_deactivation_hook(__FILE__, [StateManager::class, 'deactivate']);

//     // uninstall via uninstall.php
// }