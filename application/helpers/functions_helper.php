<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('dd')) {
function applyLineBreakInLargeSentenceOfString($string, $line_break_after_words = 25) {
    $exploded = explode(PHP_EOL, $string);
    $return = '';
    foreach ($exploded as $line) {
        if (strlen($line) > 110 && !str_contains($line, '<br />')) {
            $line = removeUselessLineBreaks($line);
            $exploded2 = explode(" ", $line);
            array_splice($exploded2, $line_break_after_words, 0, array('<br />'));
            if (count($exploded2) > $line_break_after_words*2) {
                array_splice($exploded2, $line_break_after_words*2, 0, array('<br />'));
            }
            if (count($exploded2) > $line_break_after_words*3) {
                array_splice($exploded2, $line_break_after_words*3, 0, array('<br />'));
            }
            if (count($exploded2) > $line_break_after_words*4) {
                array_splice($exploded2, $line_break_after_words*4, 0, array('<br />'));
            }
            if (count($exploded2) > $line_break_after_words*5) {
                array_splice($exploded2, $line_break_after_words*5, 0, array('<br />'));
            }
            $return .= implode(' ', $exploded2);
        } else {
            $return .= $line;
        }
    }
    return $return;
}
}

if (!function_exists('dd')) {
function dd($var = '') {
    echo "<pre>";
    print_r($var);
    exit;
}
}

function objToArr($obj) {
    return json_decode(json_encode($obj), true);
}

function appId() {
    return 'f89c848fa';
}

function makePassword($password)
{
    return md5($password).appId();
}

function keyedArray($array) {
    $return = array();
    foreach ($array as $v) {
        $return[$v] = '';
    }
    return $return;
}

function sel($column, $value, $text = '') {
    if (is_array($value)) {
        $res = $text ? $text : "selected";
        echo in_array($column, $value) ? $res : '';
    } else {
        echo strtolower($column) == strtolower($value) ? ($text ? $text : "selected") : '';
    }
}

function sel2($job_filter_id, $job_filter_ids, $job_filter_value_id, $job_filter_value_ids) {
    if (in_array($job_filter_id, explode(',', $job_filter_ids))) {
        if (in_array($job_filter_value_id, explode(',', $job_filter_value_ids))) {
            return 'selected';
        }
    }
}

function sel3($job_filter_id, $job_filter_value_id, $filtersSel) {
    if (empty($filtersSel) && empty($job_filter_value_id)) {
        return 'checked="checked"';
    }
    $selected_filter_ids = array_keys($filtersSel);
    foreach ($filtersSel as $filter_id => $job_filter_value_ids) {
        if (in_array($job_filter_id, $selected_filter_ids)) {
            if (in_array($job_filter_value_id, $filtersSel[$job_filter_id])) {
                return 'checked="checked"';
            }
        }
    }
}

function selMenu($column, $value) {
    $column = strtolower($column);
    if (is_array($value)) {
        echo in_array($column, $value) ? 'active' : '';
    } else {
        echo $column == strtolower($value) ? 'class="active"' : '';
    }
}

function makeSlug($string)
{
    return preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($string)));
}

function trimString($str, $length = 20, $removeImage = true, $dots = '...') {
    if ($str != '') {
        if ($removeImage == true) {
            $str = preg_replace("/<img[^>]+\>/i", "", $str);
        }
        $str = preg_replace('/<h1[^>]*>([\s\S]*?)<\/h1[^>]*>/', '', $str);
        $str = preg_replace('/<h2[^>]*>([\s\S]*?)<\/h2[^>]*>/', '', $str);
        return (strlen($str) > $length) ? substr($str, 0, $length - strlen($dots)) . $dots : $str;
    } else {
        return '---';
    }
}

function sectionTitle($str)
{
    if ($str != '') {
        return ucwords($str);
    } else {
        return '---';
    }
}

function hyphenIfNull($str)
{
    if ($str == '') {
        return '---';
    }
}

function setting($index = '')
{
    return SettingsHelper::Instance($index);
}

function allowedTo($permission = '', $redirect = '')
{
    $CI = get_instance();
    $CI->load->library('session');
    $permissions = objToArr($CI->session->userdata('admin')['permissions']);
    if ($CI->session->userdata('admin')['user_type'] == 'admin') {
        return true;
    }
    if (is_array($permission)) {
        foreach ($permission as $value) {
            if (in_array($value, $permissions)) {
                return true;
            }
        }
    } else {
        return in_array($permission, $permissions);    
    }
}

function selectedColor() 
{
    $CI = get_instance();
    $CI->load->library('session');
    $selected = $CI->session->userdata('selected_color_theme');
    $default = setting('default-front-color-theme');
    return $selected ? $selected : $default;
}

function candidateLanguageFlag() 
{
    $CI = get_instance();
    $CI->load->library('session');
    $flag = $CI->session->userdata('candidate_language_flag');
    return $flag ? $flag : 'us';
}

function candidateLanguage($dir = false) 
{
    $CI = get_instance();
    $CI->load->library('session');
    return $dir ? $CI->session->userdata('candidate_language_dir') : $CI->session->userdata('candidate_language');
}

function adminLanguage($dir = false) 
{
    $CI = get_instance();
    $CI->load->library('session');
    return $dir ? $CI->session->userdata('admin_language_dir') : $CI->session->userdata('admin_language');
}

function candidateSession($field = '') 
{
    $CI = get_instance();
    $CI->load->library('session');
    if (isset($CI->session->userdata('candidate')['candidate_id']) && $field == '') {
        return $CI->session->userdata('candidate')['candidate_id'];
    } else if (isset($CI->session->userdata('candidate')[$field])) {
        return $CI->session->userdata('candidate')[$field];
    }
}

function adminSession($field = '') 
{
    $CI = get_instance();
    $CI->load->library('session');
    if (isset($CI->session->userdata('admin')['user_id']) && $field == '') {
        return $CI->session->userdata('admin')['user_id'];
    } else if (isset($CI->session->userdata('admin')[$field])) {
        return $CI->session->userdata('admin')[$field];
    }
}


function getTextFromFile($file)
{
    $file = ASSET_ROOT.'/data/'.$file;
    $fh = fopen($file, 'r');
    $pageText = fread($fh, 25000);
    return $pageText;
}

function imageDimensions() {
    return array(
        array('1620', '800'),
        array('1070', '604'),
        array('828', '468'),
        array('366', '219'),
        array('360', '220'),
        array('330', '180'),
        array('320', '200'),
        array('180', '160'),
    );
}

function userImageDimensions() {
    return array(
        array('60', '60'),
        array('12', '120'),
    );
}

function imageThumb($image, $width, $height, $title = '', $class = '', $param = '') {
    $image = explode('.', $image);
    $image = $image[0].'-'.$width.'-'.$height.'.'.$image[1];
    $image = base_url().'assets/images/stories/'.$image;
    $imageNotFound = 'image-not-found-'.$width.'-'.$height.'.png';
    $notFound = base_url().'assets/images/'.$imageNotFound;
    $onError = 'onerror="this.src=\''.$notFound.'\'"';
    return '<img class="'.$class.'" src="'.$image.'" alt="'.$title.'" title="'.$title.'" '.$onError.' '.$param.'/>';
}

function departmentThumb($image, $width = '', $height = '') {
    if ($image) {
        if (strpos($image, 'http') !== false) {
            return $image;
        }
    }
    if ($width == '' && $image) {
        $image = base_url().'assets/images/departments/'.$image;
        return $image;
    }
    $image = $image ? explode('.', $image) : array();
    if (isset($image[0]) && isset($image[1])) {
        $image = $image[0].'-'.$width.'-'.$height.'.'.$image[1];
        $image = base_url().'assets/images/departments/'.$image;
        return $image;
    }
}

function questionThumb($image, $width = '', $height = '') {
    if ($image) {
        if (strpos($image, 'http') !== false) {
            return $image;
        }
    }
    if ($width == '' && $image) {
        $image = base_url().'assets/images/questions/'.$image;
        return $image;
    }
    $image = $image ? explode('.', $image) : array();
    if (isset($image[0]) && isset($image[1])) {
        $image = $image[0].'-'.$width.'-'.$height.'.'.$image[1];
        $image = base_url().'assets/images/questions/'.$image;
        return $image;
    }
}

function questionThumb2($image) {
    return ASSET_ROOT.'/images/questions/'.$image;
}

function userThumb($image, $width = '', $height = '') {
    if ($image) {
        if (strpos($image, 'http') !== false) {
            return $image;
        }
    }
    if ($width == '' && $image) {
        $image = base_url().'assets/images/users/'.$image;
        return $image;
    }
    $image = $image ? explode('.', $image) : array();
    if (isset($image[0]) && isset($image[1])) {
        $image = $image[0].'-'.$width.'-'.$height.'.'.$image[1];
        $image = base_url().'assets/images/users/'.$image;
        return $image;
    }
}

function candidateThumb($image, $width = '', $height = '') {
    if ($image) {
        if (strpos($image, 'http') !== false) {
            return $image;
        }
    }
    if ($width == '' && $image) {
        $image = base_url().'assets/images/candidates/'.$image;
        return $image;
    }
    $image = $image ? explode('.', $image) : array();
    if (isset($image[0]) && isset($image[1])) {
        $image = $image[0].'-'.$width.'-'.$height.'.'.$image[1];
        $image = base_url().'assets/images/candidates/'.$image;
        return $image;
    }
}

function candidateThumb2($image, $width = '', $height = '') {
    if ($image) {
        $image = ASSET_ROOT.'/images/candidates/'.$image;
    } else {
        $image = ASSET_ROOT.'/images/candidates/not-found.png';
    }
    return $image;
}

function candidateThumb3($image) {
    if ($image) {
        $image = base_url().'/assets/images/candidates/'.$image;
    } else {
        $image = base_url().'/assets/images/candidates/not-found.png';
    }
    return $image;
}

function blogThumb($image) {
    $data['error'] = base_url().'assets/images/news-not-found.png';
    $data['image'] = $image ? base_url().'assets/images/blogs/'.$image : '';
    return $data;    
}

function resumeThumb($file) {
    if ($file) {
        $file = base_url().'assets/images/candidates/'.$file;
    } else {
        $file = base_url().'assets/images/candidates/not-found.png';
    }
    return $file;
}

function notFoundAvatar() {
    $image = base_url().'assets/images/not-found.png';
    return $image;
}

function encode($id) {
    return encodeDecodeFunction($id, 'e');
}

function decode($id) {
    return encodeDecodeFunction($id, 'd');
}

function decodeArray($array) {
    $array = objToArr($array);
    $decoded = array();
    foreach ($array as $key => $value) {
        $key = decode($key);
        if (is_array($value)) {
            $decoded[$key] = decodeArray($value);
        } else {
            $decoded[] = decode($value);
        }
    }
    return $decoded;
}

function encodeDecodeFunction( $string, $action = 'e' ) {
    $secret_key = appId();
    $secret_iv = 'my_simple_secret_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}

function timeFormat($time = '') {
    $format = 'd M, Y h:i A';
    $time = $time != '' ? $time : date('Y-m-d G:i:s');
    return dateLang($time, $format);
}

function dateFormat($time = '') {
    $format = setting('date-format');
    $time = $time != '' ? $time : date('Y-m-d G:i:s');
    if ($format == 'time ago') {
        return timeAgoByTimeStamp($time);
    }
    return date($format, strtotime($time));
}

function timeAgoByTimeStamp($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function dateOnly($date) {
    return $date ? date('Y-m-d', strtotime($date)) : '';
}

function dateLang($date, $format = 'd M, Y') {
    $months = array(
        "Jan" => lang("Jan"),
        "Feb" => lang("Feb"),
        "Mar" => lang("Mar"),
        "Apr" => lang("Apr"),
        "May" => lang("May"),
        "Jun" => lang("Jun"),
        "Jul" => lang("Jul"),
        "Aug" => lang("Aug"),
        "Sep" => lang("Sep"),
        "Oct" => lang("Oct"),
        "Nov" => lang("Nov"),
        "Dec" => lang("Dec"),
        "January" => lang("January"),
        "February" => lang("February"),
        "March" => lang("March"),
        "April" => lang("April"),
        "May" => lang("May"),
        "June" => lang("June"),
        "July" => lang("July"),
        "August" => lang("August"),
        "September" => lang("September"),
        "October" => lang("October"),
        "November" => lang("November"),
        "December" => lang("December"),
    );
    $date = $date ? date($format, strtotime($date)) : '---';
    foreach ($months as $key => $value) {
        if (strpos($date, $key) !== false) {
            return str_replace($key, $value, $date);
        }
    }
    return $date;

}

function getMonthsBetweenDates($date1, $date2) {
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);
    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);
    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);
    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);    
    return $diff;
}

function divisibleArray($number) {
    if ($number == '3') {
        return array(3,6,9,12,15,18,21,24,27,30);
    } else {
        return array(4,8,12,16,20,24,28,32,36,40);
    }
}

function token()
{
    return base64_encode(date('Y-m-d G:i:s')) . appId();
}

function activeItem($type, $slug)
{
    $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $exploded = explode('/', $path);
    $match = '';
    if (isset($exploded[1]) && isset($exploded[2])) {
        if ($exploded[1] == $type && $exploded[2] == $slug) {
            $match = 'active';
        }
    } elseif (isset($exploded[1]) && !isset($exploded[2]) && $exploded[1] == $slug) {
        $match = 'active';
    }
    echo $match;
}

function getIds($array, $key, $string = false)
{
    $ids = array();
    foreach ($array as $a) {
        $ids[] = $a[$key];
    }
    return $string ? implode(',', $ids) : $ids;
}

function adminUnreadMessagesCount()
{
    $CI = get_instance();
    return $CI->MessageModel->adminUnreadMessagesCount();
}

function defaultLanguage()
{
    $CI = get_instance();
    $default = objToArr($CI->AdminLanguageModel->getDefault());
    return issetVal($default, 'slug');
}

function adminActiveLanguages()
{
    $controllerInstance = & get_instance();
    return $controllerInstance->languageSelect('admin');
}

function frontActiveLanguages()
{
    $controllerInstance = & get_instance();
    return $controllerInstance->languageSelect('front');
}

function footer($column = 'First Column')
{
    $controllerInstance = & get_instance();
    return $controllerInstance->footer($column);
}

function checkFooterColumns($data)
{
    $count = 0;
    foreach ($data as $k => $d) {
        if (!empty($d)) {
            $count = $count + 1;
        }
    }
    if ($count == 1 || $count == 2) {
        $count = 6;
    } elseif ($count == 3) {
        $count = 4;
    } elseif ($count == 4) {
        $count = 3;
    }
    return $count;
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getClientIpAddress() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function hideApiFields($type) {
    if (SS_DEMO) {
        $array = array(
            'paypal-email',
            'stripe-key',
            'stripe-secret',
            'google-client-id',
            'google-client-secret',
            'facebook-app-id',
            'facebook-app-secret',
            'sendgrid-username',
            'sendgrid-password',
            'share-script',
            'share-tag'
        );
        if (in_array($type, $array)) {
            return 'password';
        }
    }
    return 'text';
}

function acActive($val1, $val2)
{
    return $val1 == $val2 ? 'class="active"' : '';  
}

function arrangeSections($data)
{
    $return = array();
    $keys = array();
    foreach ($data as $key => $value) {
        $keys[] = $key;
    }
    for ($i=0; $i < count(array_values($data)[0]) ; $i++) { 
        foreach ($keys as $key) {
            $return[$i][$key] = $data[$key][$i]; 
        }
    }
    return $return;
}

function sortForCSV($data)
{
    $return = array();
    $keys = array_keys($data[0]);
    for ($i=0; $i < count($data) ; $i++) { 
        foreach ($keys as $key) {
            $return[$i][] = $data[$i][$key];
        }
    }
    $return = array_merge(array($keys), $return);
    return $return;
}

function jobsCheckboxSel($data, $val)
{
    echo in_array($val, explode(',', $data)) ? 'checked ' : '';
}

function departmentCheckboxSel($col, $val)
{
    echo strtolower($val) == strtolower($col) ? 'checked="checked"' : '';
}

function jobStatus($status, $level)
{
    $res = '';
    if ($status == 'hired') {
        $res = 'complete';
    } elseif ($status == 'interviewed' && ($level == 1 || $level == 2 || $level == 3)) {
        $res = 'complete';
    } elseif ($status == 'shortlisted' && ($level == 1 || $level == 2)) {
        $res = 'complete';
    } elseif ($status == 'applied' && $level == 1) {
        $res = 'complete';
    } else {
        $res = 'disabled';
    }
    echo $res;
}

function jobStatusForDisplay($status)
{
    if ($status == "applied" || $status == "request_to_shortlist") {
        return lang('applied');
    } elseif ($status == "approved_for_shortlist" || $status == "shortlisted") {
        return lang('shortlisted');
    } elseif ($status == "interview_approved" || $status == "interviewed" || $status == "request_to_appoint") {
        return lang('interviewed');
    } elseif ($status == "appointment_approved") {
        return lang('appointed');
    } elseif ($status == "rejected") {
        return lang('rejected');
    } elseif ($status == "hired") {
        return lang('hired');
    }
}

function quizTime($from, $to) {
    //Current Time
    $now = date('Y-m-d G:i:s');

    //Max time
    $minutes_to_add = $to;
    $time = new DateTime($from);
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
    $max = $time->format('Y-m-d G:i:s');

    //Difference
    $diff = strtotime($max) - strtotime($now);

    return array(
        'now' => $now,
        'max' => $max,
        'diff' => $diff,
        'clock' => gmdate("H:i:s", $diff)
    );

}

function textToImage($txt, $user) {
    $images = '';
    $txt = wordwrap($txt,40,"--(|)--");
    $txts = explode('--(|)--', $txt);
    $rand = strtotime(date('Y-m-d G:i:s'));
    foreach ($txts as $k => $txt) {
        $img = imagecreate(400, 35);
        $textbgcolor = imagecolorallocate($img, 255, 255, 255);
        $textcolor = imagecolorallocate($img, 0, 0, 0);
        $txt = $txt;
        imagestring($img, 10, 10, 10, $txt, $textcolor);
        ob_start();
        imagepng($img);
        $base64 = base64_encode(ob_get_clean());
        $name = ($k+1).'-'.$user.'-question.jpeg';
        $file = ASSET_ROOT.'/images/questions/'.$name;
        $image = base64_to_jpeg($base64, $file);
        $images .= '<img src="'.base_url().'assets/images/questions/'.$name.'?token='.$rand.'" width="100%"/><br />';
    }
    return $images;
}

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen( $output_file, 'wb' ); 
    fwrite($ifp, base64_decode($base64_string));
    fclose($ifp);
    return $output_file; 
}

function getExprienceInMonths($data)
{
    $experience = 0;
    foreach ($data as $key => $value) {
        $experience = $experience + getMonthsBetweenDates($value['from'], $value['to']) + 1;
    }
    return $experience;
}

function checkQuizCorrect($answer, $original, $type)
{
    if ($type == 'radio') {
      return $answer == $original ? 'answer' : '';
    } else {
      if (is_array($answer)) {
        foreach ($answer as $value) {
          if ($value == $original) {
            return 'answer';
          }
        }
      }
    }
}

function columnCount($columns)
{
    $count = count($columns);
    if ($count == 4) {
        return 3;
    } else if ($count == 3) {
        return 4;
    } else if ($count == 2) {
        return 6;
    } else if ($count == 1) {
        return 12;
    }
}

function footerColumns()
{
    $CI = get_instance();
    $footer['columns'] = $CI->AdminFooterSectionModel->getAll('columns');
    $footer['column_count'] = columnCount($footer['columns']);
    return $footer;
}

function arrayToString($array)
{
    $lang = '<?php '.PHP_EOL.PHP_EOL;
    foreach ($array as $key => $value) {
        $lang .= '$lang["'.$key.'"] = "'.htmlspecialchars($value).'";'.PHP_EOL;
    }
    return $lang;
}

function arrayToStringJs($array)
{
    $jsVars = array(
        "candidates",
        "click_to_activate",
        "click_to_deactivate",
        "are_u_sure",
        "please_select_some_records_first",
        "edit_blog_category",
        "create_blog_category",
        "candidate_interview",
        "edit_company",
        "create_company",
        "edit_to_do_item",
        "create_to_do_item",
        "edit_department",
        "create_department",
        "edit_interview",
        "create_interview",
        "clone_interview",
        "edit_interview_category",
        "create_interview_category",
        "edit_interview_question",
        "create_interview_question",
        "create_language",
        "edit_question",
        "create_question",
        "change_to_multi_correct",
        "change_to_single_correct",
        "edit_question_category",
        "create_question_category",
        "assign_quiz",
        "assign_interview",
        "create_appointment_letter",
        "edit_quiz",
        "create_quiz",
        "clone_quiz",
        "edit_quiz_category",
        "create_quiz_category",
        "edit_quiz_question",
        "create_quiz_question",
        "edit_trait",
        "create_trait",
        "edit_user",
        "create_user",
        "edit_candidate",
        "create_candidate",
        "edit_employee",
        "create_employee",
        "edit",
        "create",
        "edit_language",
        "mark_favorite",
        "unmark_favorite",
        "refer_this_job",
        "inactive",
        "active",
        "update",
        "flag",
        "direction",
        "ltr",
        "rtl",
        "display",
        "both",
        "only_title",
        "only_flag",
        "default",
        "make_default",
        "click_to_select",
        "edit_language",
        "only_1_candidate_allowed",
        "only_3_candidates_allowed",
        "only_5_candidates_allowed",
        "only_10_candidates_allowed",
        "apply_for_candidate",
        "apply_for_candidate_single_select_msg",
        "import_jobs",
        "to",
        "search",
        "processing",
        "loading",
        "show",
        "entries",
        "filtered_from",
        "total_entries",
        "showing",
        "of",
        "no_matching_records_found",
        "no_data_available_in_table",
        "first",
        "last",
        "next",
        "previous",
    );
    $lang = 'var lang = []; '.PHP_EOL.PHP_EOL;
    foreach ($array as $key => $value) {
        if (in_array($key, $jsVars)) {
            $lang .= 'lang["'.$key.'"] = "'.htmlspecialchars($value).'";'.PHP_EOL;
        }
    }
    return $lang;
}

function esc_output($string, $type = 'attr')
{
    if ($type == 'raw') {
        return $string;
    }
    return html_escape($string);
}

function remoteRequest($url = '')
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

function createFile($file, $data)
{
    try {
        $file = MAIN_ROOT.'/'.$file;
        $file = fopen($file, "w");
        fwrite($file, $data);
        fclose($file);
        return 'success';
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function encryptLargeString($plainText)
{
    $technique = "AES-128-CTR"; 
    $iv_length = openssl_cipher_iv_length($technique); 
    $options = 0; 
    $encryption_iv = 'U{W>f}86-]%q,kK:'; 
    $encryption_key = "LJnt&kpj=]~~~b8e"; 
    $encryption = openssl_encrypt($plainText, $technique, $encryption_key, $options, $encryption_iv); 
    return $encryption;
}

function decryptLargeString($encryptedText)
{
    $technique = "AES-128-CTR";
    $decryption_key = "LJnt&kpj=]~~~b8e";
    $options = 0;
    $decryption_iv = 'U{W>f}86-]%q,kK:';
    $decryption = openssl_decrypt ($encryptedText, $technique,  $decryption_key, $options, $decryption_iv); 
    return $decryption;
}

function cf_print($string) {
    //These are system generated safe strings.
    echo $string;
}

function combinationsOfArray($chars, $size, $combinations = array()) {
    if (empty($combinations)) {
        $combinations = $chars;
    }
    if ($size == 1) {
        return $combinations;
    }
    $new_combinations = array();
    foreach ($combinations as $combination) {
        foreach ($chars as $char) {
            $new_combinations[] = $combination .','. $char;
        }
    }
    return combinationsOfArray($chars, $size - 1, $new_combinations);
}

function permutationsOfArray($InArray, $InProcessedArray = array()) {
    $ReturnArray = array();
    foreach($InArray as $Key=>$value)
    {
        $CopyArray = $InProcessedArray;
        $CopyArray[$Key] = $value;
        $TempArray = array_diff_key($InArray, $CopyArray);
        if (count($TempArray) == 0) {
            $ReturnArray[] = implode(',',$CopyArray);
        } else {
            $ReturnArray = array_merge($ReturnArray, permutationsOfArray($TempArray, $CopyArray));
        }
    }
    return $ReturnArray;
}

function removeUselessLineBreaks($string)
{
    $string = htmlentities($string);
    $string = str_replace("&nbsp;", " ", $string);
    $string = html_entity_decode($string);
    $string = trim(preg_replace('/(&nbsp;)+|\s\K\s+/',' ',$string));
    return $string;
}

function flagCodes()
{
    return array('ad','ae','af','ag','ai','al','am','ao','aq','ar','as','at','au','aw','ax','az','ba','bb','bd','be','bf','bg','bh','bi','bj','bl','bm','bn','bo','bq','br','bs','bt','bv','bw','by','bz','ca','cc','cd','cf','cg','ch','ci','ck','cl','cm','cn','co','cr','cu','cv','cw','cx','cy','cz','de','dj','dk','dm','do','dz','ec','ee','eg','eh','er','es','et','fi','fj','fk','fm','fo','fr','ga','gb','gd','ge','gf','gg','gh','gi','gl','gm','gn','gp','gq','gr','gs','gt','gu','gw','gy','hk','hm','hn','hr','ht','hu','id','ie','il','im','in','io','iq','ir','is','it','je','jm','jo','jp','ke','kg','kh','ki','km','kn','kp','kr','kw','ky','kz','la','lb','lc','li','lk','lr','ls','lt','lu','lv','ly','ma','mc','md','me','mf','mg','mh','mk','ml','mm','mn','mo','mp','mq','mr','ms','mt','mu','mv','mw','mx','my','mz','na','nc','ne','nf','ng','ni','nl','no','np','nr','nu','nz','om','pa','pe','pf','pg','ph','pk','pl','pm','pn','pr','ps','pt','pw','py','qa','re','ro','rs','ru','rw','sa','sb','sc','sd','se','sg','sh','si','sj','sk','sl','sm','sn','so','sr','ss','st','sv','sx','sy','sz','tc','td','tf','tg','th','tj','tk','tl','tm','tn','to','tr','tt','tv','tw','tz','ua','ug','um','us','uy','uz','va','vc','ve','vg','vi','vn','vu','wf','ws','ye','yt','za','zm','zw');
}

function updateLangVariables($language_id, $for = 'admin')
{
    $CI = get_instance();

    //Deciding on column
    $column = is_numeric($language_id) ? 'language_id' : 'slug';

    //Loading the origin array
    $origin = objToArr($CI->AdminLanguageModel->getLanguage('is_main', 1));
    include(APPLICATION_ROOT . '/language/'.$origin['slug'].'/message_lang.php');

    //Loading the selected/default array
    $selected = objToArr($CI->AdminLanguageModel->getLanguage($column, $language_id));
    include(APPLICATION_ROOT . '/language/'.$selected['slug'].'/message_lang.php');

    $additionals = array_diff_key($langOrigin, $lang);

    //Combining both origin and selected in case any string in target is left
    //As origin will always be updated from code-wand.
    $combined = array_merge($lang, $additionals);
    $file = fopen(APPLICATION_ROOT . '/language/'.$selected['slug'].'/message_lang.php', "w");
    fwrite($file, arrayToString($combined));
    fclose($file);

    //Now taking from the updated and writing to lang.js
    $language = objToArr($CI->AdminLanguageModel->getLanguage($column, $language_id));
    $entries = include(APPLICATION_ROOT . '/language/'.$language['slug'].'/message_lang.php');
    if ($for == 'admin') {
        $file = fopen(ASSET_ROOT . '/admin/js/cf/lang.js', "w");
        fwrite($file, arrayToStringJs($lang));
        fclose($file);
    } else {
        $file = fopen(ASSET_ROOT . '/front/'.viewPrfx().'/js/lang.js', "w");
        fwrite($file, arrayToStringJs($lang));
        fclose($file);
    }
}

function issetVal($array, $index, $default = '')
{
    if ($default) {
        return isset($array[$index]) && $array[$index] != '' ? $array[$index] : $default;
    } else {
        return isset($array[$index]) ? $array[$index] : '';
    }
}

function mathDivide($nominator, $denominator, $percent = false) {
    if ($denominator == 0 || $denominator == '') {
        return 0;
    }
    return $percent ? round(($nominator / $denominator)*100) : round($nominator / $denominator);
}

function slugify($text = '') {
    if ($text == '') {
        return strtotime(date('Y-m-d G:i:s'));
    }

    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

function viewPrfx() {
    return CF_VIEW ? CF_VIEW : 'alpha';
}

function curRand() {
    return strtotime(date('Y-m-d G:i:s'));
}

function writeToFile($filePath, $content) {
    $myfile = fopen($filePath, "w") or die("Unable to open file!");
    fwrite($myfile, $content);
    fclose($myfile);
}

function isAdminRoute() {
    $route = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if (strpos($route, 'admin') !== false) {
        return true;
    }
    return false;
}

function explodeItemsForDisplay($items, $separator, $type = 'list') {
    $return = array();
    $returnString = ''; 
    $items = $items ? explode($separator, $items) : array();
    foreach ($items as $key => $item) {
        if ($type == 'list') {
            $returnString .= '<li>'.$item.'</li>';
        } else {
            $return[$key] = $item;
        }
    }
    if ($type == 'list') {
        return $returnString ? '<ul>'.$returnString.'</ul>' : '';
    } else {
        return $return;
    }
}

function dateDifference($date) {
    $now = time();
    $your_date = strtotime($date);
    $datediff = $now - $your_date;
    return round($datediff / (60 * 60 * 24));    
}

function dateDifferenceInYears($date) {
    if ($date) {
        return round((time()-strtotime($date))/(3600*24*365.25));
    }
}

function dateDifferenceInDays($date) {
    if ($date) {
        $now = time();
        $your_date = strtotime($date);
        $datediff = $now - $your_date;
        return round($datediff / (60 * 60 * 24));
    }
}

function replaceTagsInTemplate($template, $tagsWithValues) {
    $tags = array_keys($tagsWithValues);
    $values = array_values($tagsWithValues);
    return str_replace($tags, $values, $template);
}

function validDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

function uploadLimit($default) {
    $limit = setting('upload-limit') ? setting('upload-limit') : '';
    return $limit ? $limit * 1024 : $default;
}

function uploadImageError($size, $error) {
    $size = $size ? round(($size/1024), 2).'MB' : '';
    return str_replace('[size]', $size, $error);
}

function getSchemaValuesFromFilterValues($filters, $type = 'employmentType') {
    $return = '';
    if ($filters) {
        foreach ($filters as $key => $value) {
            $title = strtolower($value['title']);
            switch ($type) {
                case 'employmentType':
                    if (str_contains($title, 'job type') || str_contains($title, 'position type') || str_contains($title, 'employment type')) { 
                        $return = implode($value['values']);
                    }
                    break;
                case 'educationRequirements':
                    if (str_contains($title, 'education') || str_contains($title, 'study')) { 
                        $return = implode($value['values']);
                    }
                    break;
                case 'experienceRequirements':
                    if (str_contains($title, 'experience') || str_contains($title, 'work')) { 
                        $return = implode($value['values']);
                    }
                    break;
                default:
                    break;
            }
        }
    }
    return $return;
}

function dateAfterNumberOfDays($days = 30) {
    return date('Y-m-d', strtotime("+".$days." days"));
}

function createDirectoryIfNotExists($path) {
    if (!file_exists(dirname($path))) {
        mkdir(dirname($path), 0777, true);
    }
}

function validateDate($date, $format = 'Y-m-d') {
    if (!$data) {
        return false;
    }
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}