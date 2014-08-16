<?php

include('/eve/core/autoload.php');

  @error_reporting(E_ALL |E_STRICT);
  @set_error_handler("php_error");

  @ini_set('short_open_tag','off');
  @ini_set('arg_separator.output','&amp;');
  @ini_set('session.use_trans_sid','0');
  @ini_set('session.use_cookies','1');
  @ini_set('session.use_only_cookies','1');
  @ini_set('display_errors','on');

if(Core::checkPHPversion() == true) {
 @date_default_timezone_set('Europe/Berlin');

 Core::initEvE();
 Debug::this(Core::initEvE());
}
