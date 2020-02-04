<?php
session_start();

spl_autoload_register(function ($class_name) {
	include './controllers/' . $class_name . '.php';
});

$fullUrl = $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$app = new Address();
$path = parse_url($fullUrl);

switch ($path['path']) {

case '/pera/mika/':
	$app->index();
	break;

case '/':
	// $app->index();
	break;

default:
	print_r($path);
	break;
}