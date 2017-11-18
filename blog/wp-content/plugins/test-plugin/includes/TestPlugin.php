<?php 
namespace inludes;

class TestPlugin {
	private static $instance = null;
	protected function __conctruct() {}
	public static function getInstance() {
		if (null == self::$instance) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	static public function activation() {
		error_log('plugin '.STEPBYSTEP_PlUGIN_NAME.' activation');
	}
	static public function deactivation() {
		error_log('plugin '.STEPBYSTEP_PlUGIN_NAME.' deactivation');
	}
}

TestPlugin::getInstance();
