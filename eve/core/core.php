<?php

class Core {

	private static $eve = null;
	public static $eve_main = array('init_sql' => true, 'init_tpl' => true, 'tpl_file' =>'index.html');
	public $account;
	public $com_lang;
	public $eve_logs;
	public $micro;
	public $template;

	public static function runEvE($pre) {

		$micro = explode(' ', microtime()); 
		Debug::this($micro);
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