<?php

namespace WPD\Toolset\Features;

class SiteState
{

	/**
	 * @var
	 */
	public static $site_state = 'development';

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
		$this->setSiteState();
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

	public static function isDevelopment()
	{
		return 'production' !== self::$site_state;
	}

	public static function isProduction()
	{
		return 'production' === self::$site_state;
	}

	public static function is()
	{
		return self::$site_state;
	}

	/**
	 * Set site state
	 *
	 * @since   1.0.0
	 *
	 * @return  void
	 */
	protected function setSiteState()
	{
		$tests = ['localhost', '.dev', '.test', 'kinsta'];

		foreach ($tests as $test) {
			if (false !== strpos(site_url(), $test)) {
				self::$site_state = 'development';

				return;
			}
		}

		self::$site_state = 'production';
	}
}
