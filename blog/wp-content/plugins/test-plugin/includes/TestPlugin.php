<?php 
namespace inludes;

use includes\common\TestPluginLoader;

class TestPlugin {
	private static $instance = null;
	protected function __conctruct() {
		TestPuginLoader::getInstance();
	}
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
