<?php

/**
 * Site state setup
 *
 * @package     WPD\Toolset
 * @since       1.0.0
 * @author      smarterdigitalltd
 * @link        https://wpdevelopers.co.uk
 * @license     GNU-2.0+
 */

namespace WPD\Toolset;

class SiteState
{
	/**
	 * @var
	 */
	protected static $siteState = 'development';

	/**
	 * @var
	 */
	protected static $instance = null;

	/**
	 * Plugin init
	 *
	 * @since   1.0.0
	 *
	 * @return  void
	 */
	protected function __construct()
	{
		$this->registerHooks();
	}

	/**
	 * Get singleton instance
	 *
	 * @since   1.0.0.
	 *
	 * @return  mixed Plugin Instance of the plugin
	 */
	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Run hooks
	 *
	 * @since   1.0.0
	 *
	 * @return  void
	 */
	private function registerHooks()
	{
	}
}
