<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('DB_NAME', 'store');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('PROJECT_NAME', 'store');
$config['ADMIN'] = "/store";

$config['dbss'] = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db' => DB_NAME,
    'host' => DB_HOST,
);
$config['email'] = "store@store.id";
$root = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
$roots = str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$roots = str_replace('/', '', $roots);
$root .= '/' . $roots;

$config['path_product'] = $_SERVER['DOCUMENT_ROOT'] . $config['ADMIN'] . "/assets/uploads/product/" . strtoupper(date('Y/m')) . "/";
$config['save_product'] = "assets/uploads/product/" . strtoupper(date('Y/m')) . "/";