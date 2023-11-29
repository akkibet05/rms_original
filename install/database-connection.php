<?php

include('includes.php');
ini_set('max_execution_time', 1000);
error_reporting(E_ALL);
ini_set('display_errors', 1);

$data = $_POST;
$db_host = $data['host'];
$db_name = $data['db_name'];
$db_user = $data['db_user'];
$db_password = $data['db_password'];
$db_prefix = $data['db_prefix'];
$db_type = $data['db_type'];
$import = $data['import_data'];

//Basic form validation
if ($db_host == '' || $db_name == '' || $db_user == '') {
    echo json_encode(
        array(
            'status' => 'error',
            'message' => 'Please enter host name, database name and database user',
        )
    );
    exit;
}

//Checking if mysqli extension is enabled when selected option is mysql
if (!function_exists('mysqli_connect') && $db_type == 'mysql') {
    echo json_encode(
        array(
            'status' => 'error',
            'message' => 'mysqli driver is not enabled.<br />Please enable it from php settings in your hosting/cpanel',
        )
    );
    exit;
}

try {
    //Setting up db connection
    $conn = new PDO($db_type.":host=".$db_host.";dbname=".$db_name, $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Writing env file from the form variables
    $fileMessage = createEnvFile($db_host, $db_name, $db_user, $db_password, $db_prefix, $db_type, rootDirectory().'/env.php');

    if ($fileMessage != 'success') {
        $final = array(
            'status' => 'error',
            'message' => 'Error creating env file.<br />Please make the root directory writeable',
        );
    } else {
        define("CODEIGNITER_EXTERNAL_ACCESS", true);
        $CI = require_once('../external.php');
        $import = $import == 'yes' ? true : false;
        $result = $CI->createSchemaAndImportData($import);

        if ($result != 'success') {
            if (!isset($_GET['env_force'])) {
                unlink(rootDirectory().'/env.php'); //Delete env file if import failed
            }
            $final = array(
                'status' => 'error',
                'message' => 'Error importing database.<br /><br />Result : '.$result,
            );
        } else {
            $final = array(
                'status' => 'success',
                'message' => 'Data Imported successfully',
            );
        }
    }
    echo json_encode($final);
} catch(PDOException $e) {
    echo json_encode(
        array(
            'status' => 'error',
            'message' => 'An error occured. <br /><br />(<i>'.$e->getMessage().'</i>).<br /><br /> Check database credentials and/or try selecting different db driver.',
        )
    );
}
die();

