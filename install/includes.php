<?php

if (!isset($_SESSION)) {
    $session_path = str_replace('\\', '/', substr(__DIR__, 0, -8)).'/application/sessions';
    ini_set('session.save_path', $session_path);
    session_start();
}

if (!isset($_SESSION)) {
    session_start();
}

if (!function_exists('dd')) {
function dd($var = '') {
    echo "<pre>";
    print_r($var);
    exit;
}
}

if (!function_exists('ifAlreadyInstalled')) {
function ifAlreadyInstalled() {
    $env = rootDirectory().'/env.php';
    if (file_exists($env)) {
        header('Location: '.base_url(true));
        exit();
    }
}
}

if (!function_exists('pageCountForSubstr')) {
function pageCountForSubstr()
{
    $scriptName = $_SERVER['SCRIPT_NAME'];
    if (strpos($scriptName, 'requirements') !== false) {
        return -24;
    } elseif (strpos($scriptName, 'database-connection') !== false) {
        return -32;
    } elseif (strpos($scriptName, 'database') !== false) {
        return -21;
    } elseif (strpos($scriptName, 'credentials') !== false) {
        return -24;
    } elseif (strpos($scriptName, 'create-user') !== false) {
        return -24;
    }
}
}

if (!function_exists('rootDirectory')) {
function rootDirectory() {
    return str_replace('\\', '/', substr(__DIR__, 0, -8));
}
}

if (!function_exists('serverFolder')) {
function serverFolder($instal)
{
    $count = $instal ? pageCountForSubstr() : -17;
    $folder = substr($_SERVER['SCRIPT_NAME'], 0, $count);
    return $folder;
}
}

if (!function_exists('base_url')) {
function base_url($instal = false, $page = '')
{
    $url = getRequestScheme().'://'.$_SERVER['HTTP_HOST'].serverFolder($instal);
    return $url;
}    
}

if (!function_exists('checkApacheModule')) {
function checkApacheModule($module)
{
    $modules = apache_get_modules();
    foreach ($modules as $m) {
        if ($m == $module) {
            return true;
        }
    }
    return false;
}
}

if (!function_exists('sessionVariables')) {
function sessionVariables($key = '', $value = '')
{
    if ($value == '') {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
    } else {
        $_SESSION[$key] = $value;
    }
}
}

if (!function_exists('allVariablesTrue')) {
function allVariablesTrue()
{
    $variables = array('php_version', 'pdo', 'gd', 'openssl', 'curl', 'uploads_writeable',);
    $result = true;
    $all = $_SESSION;
    foreach ($variables as $a) {
        if (isset($_SESSION[$a]) && $_SESSION[$a] == 'false') {
            $result = false;
        }
    }
    return $result;
}
}

if (!function_exists('redirectIfRequirementsNotFulfilled')) {
function redirectIfRequirementsNotFulfilled()
{
    if (!allVariablesTrue()) {
        header("Location: ".base_url()."/instal/requirements.php");
        exit();
    }
}
}

if (!function_exists('createEnvFile')) {
function createEnvFile($db_host, $db_name, $db_user, $db_password, $db_prefix, $db_type, $file)
{
    try {
        $db_type = $db_type == 'mysql' ? 'mysqli' : $db_type;
        $env = fopen($file, "w");
        if (!$env) {
            return 'error';
        } 
        $content = '<?php'.PHP_EOL.PHP_EOL;
        $content .= "define('CF_BASE_URL', '".base_url(true)."');".PHP_EOL;
        $content .= "define('CF_DB_HOST', '".$db_host."');".PHP_EOL;
        $content .= "define('CF_DB_NAME', '".$db_name."');".PHP_EOL;
        $content .= "define('CF_DB_USER', '".$db_user."');".PHP_EOL;
        $content .= "define('CF_DB_PASSWORD', '".$db_password."');".PHP_EOL;
        $content .= "define('CF_DB_PORT', '3306');".PHP_EOL;
        $content .= "define('CF_DB_PREFIX', '".$db_prefix."');".PHP_EOL;
        $content .= "define('CF_DB_TYPE', '".$db_type."');".PHP_EOL;
        $content .= "define('CF_VIEW', 'beta');";
        $content .= "define('CF_DEMO', false);";
        fwrite($env, $content);
        fclose($env);
        return 'success';
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
}

if (!function_exists('getRequestScheme')) {
function getRequestScheme()
{
    if ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)) {
        return 'https';
    } else {
        return 'http';
    }
}
}

$scriptName = $_SERVER['SCRIPT_NAME'];
if (strpos($scriptName, 'requirements') !== false) {
    ifAlreadyInstalled();
} elseif (strpos($scriptName, 'database-connection') !== false) {
    ifAlreadyInstalled();
} elseif (strpos($scriptName, 'database') !== false) {
    ifAlreadyInstalled();
}
