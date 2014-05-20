<?php

// change the following paths if necessary
/*echo dirname(__FILE__).'/framework/yii.php';
exit;*/
ob_start("ob_gzhandler");
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
ini_set('zlib.output_compression','Off');

defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);

Yii::createWebApplication($config)->run();
ob_end_flush();
