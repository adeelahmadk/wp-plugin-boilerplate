<?php
/**
 * @author Adeel Ahmad <6880680+adeelahmadk@users.noreply.github.com>
 * @package  ResilientBitsPlugin
 */
namespace ResilientBits\Inc\Base;

/**
 * Manages activate/deactivate states of a plugin
 */
class StateManager
{
  public static function activate()
  {
    flush_rewrite_rules();
  }

  public static function deactivate()
  {
    flush_rewrite_rules();
  }
}