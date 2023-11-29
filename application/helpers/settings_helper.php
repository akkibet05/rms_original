<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Singleton class for settings helper to avoid db connection multiple times
 *
 */
final class SettingsHelper
{
    /**
     * Call this method to get singleton
     *
     * @return UserFactory
     */
    public static function Instance($index = '')
    {
        static $values = null;
        if ($values === null) {
            $CI = get_instance();
            if (file_exists(MAIN_ROOT.'env.php') && !defined('CODEIGNITER_EXTERNAL_ACCESS')) {
                $values = $CI->SettingModel->getForAdmin();
            }
        }
        if ($index == '') {
            return $values;
        } else {
            return isset($values[$index]) ? $values[$index] : '';
        }
    }

    /**
     * Private ctor so nobody else can instantiate it
     *
     */
    private function __construct()
    {
    }
}