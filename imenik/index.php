<?php
session_start();
define('__ROOT__', dirname(dirname(__FILE__)));
spl_autoload_register(function ($class_name) {
	include './controllers/' . $class_name . '.php';
});

$fullUrl = $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$app = new Address();
$path = parse_url($fullUrl);

switch ($path['path']) {

case '/imenik/index.php':
	$app->index();
	//return view
	break;

case '/imenik/index.php/create':
	$app->create();
	//return view
	break;

case '/imenik/index.php/find':
	$app->find();
	break;

case '/imenik/index.php/show':
	$app->show($path['query']);
	break;

case '/imenik/index.php/store':
	$app->store();
	break;

case '/imenik/index.php/update':
	$app->update();
	break;

case '/imenik/index.php/delete':
	$app->destroy($path['query']);
	break;

default:
	print_r($path);
	break;
}
