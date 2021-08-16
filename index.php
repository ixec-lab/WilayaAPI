<?php
namespace WILAYAPI;
use WILAYAPI\LIBS\UrlHandler;

include_once 'app/config.php';
include_once APP_PATH . '/libs/autoload.php';

$urlHandler = new UrlHandler();
$urlHandler->dispatch();
?>