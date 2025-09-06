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
