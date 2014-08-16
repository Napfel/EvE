<?php

class Core {

	private static $eve = null;
	public static $eve_main = array('init_sql' => true, 'init_tpl' => true, 'tpl_file' =>'index.html');

	public static function runEvE($pre) {

		Debug::this($pre);
	}

	public static function checkPHPversion() {

		$version = phpversion();
		if(version_compare($version, '5.1', '>=')) {
			return true;
		}
		else if (version_compare($version, '5.0', '<')) {
			return 'Fallback laden';
		}
		else {
			return false;
		}
	}
	
	public static function initEvE() {
		if(self::$eve == null) {
			try {
				self::$eve = new Core();
				self::$eve->runEvE(self::$eve_main);
			}
			catch(EvEException $ex) {
				self::$eve = $ex->getErrorPage();
			} 
		}
		return self::$eve;
	}
}