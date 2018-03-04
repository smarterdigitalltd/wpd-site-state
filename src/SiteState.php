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
		$this->runHooks();
	}

	/**
	 * Run hooks
	 *
	 * @since   1.0.0
	 *
	 * @return  void
	 */
	public function runHooks()
	{
		add_filter('body_class', [__CLASS__, 'setBodyClasses'], 10, 1);
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
	 * @return bool
	 */
	public static function isDevelopment()
	{
		return 'production' !== self::$site_state;
	}

	/**
	 * Set body classes
	 *
	 * @since   1.0.0
	 *
	 * @param   array $classes Array of current body classes
	 *
	 * @return  array                       New array of body classes
	 */
	public static function setBodyClasses($classes)
	{
		$classes[] = self::isProduction() ? 'siteState--production' : 'siteState--development';

		return $classes;
	}

	/**
	 * @return bool
	 */
	public static function isProduction()
	{
		return 'production' === self::$site_state;
	}

	/**
	 * @return string
	 */
	public static function is()
	{
		return self::$site_state;
	}
}
