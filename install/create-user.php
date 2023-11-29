<?php

include('includes.php');
ini_set('display_errors', 0);
error_reporting(0);

$data = $_POST;

$fields = '';
$url = base_url(true).'/admin-user';

$data = array(
    'first_name' => urlencode($_POST['first_name']),
    'last_name' => urlencode($_POST['last_name']),
    'email' => urlencode($_POST['email']),
    'password' => urlencode($_POST['password']),
    'retype_password' => urlencode($_POST['retype_password']),
);
foreach($data as $key=>$value) { $fields .= $key.'='.$value.'&'; }
rtrim($fields, '&');

define("CODEIGNITER_EXTERNAL_ACCESS", true);
$CI = require_once('../external.php');
$result = $CI->createAdminUser($data);
die($result);