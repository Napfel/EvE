<?php

class Core {

	private static $eve = null;
	public $eve_main;
	public $account;
	public $com_lang;
	public $eve_logs;
	public $micro;
	public $template;

	function preEvE() {

		$this->eve_main = array('init_sql' => true, 'init_tpl' => true, 'tpl_file' =>'index.html');
		if($this->micro == null) {
		$this->micro = explode(' ', microtime());	
		}
		 
		$this->loadEvE();		
	}

	function loadEvE() {
			$this->eve_main['cellspacing'] = 1;
			$this->eve_main['def_lang'] = empty($this->eve_main['def_lang']) ? 'German' : $this->eve_main['def_lang'];
			$this->eve_main['def_theme'] = 'eve';
			$this->account = array('user_id' => 0, 'access_eve' => 0);
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
				self::$eve->preEvE();
			}
			catch(EvEException $ex) {
				self::$eve = $ex->getErrorPage();
			} 
		}
		return self::$eve;
	}
}