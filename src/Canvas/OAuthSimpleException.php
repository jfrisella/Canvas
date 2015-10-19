<?php namespace BaglerIT\OAuthSimple;
/**
 * Class OAuthSimpleException
 * @package BaglerIT\OAuthSimple
 */
class OAuthSimpleException extends \Exception
{
    /**
     * @param string $err
     * @param bool|FALSE $isDebug
     */
    public function __construct($err, $isDebug = false)
    {
        self::logError($err);
        if ($isDebug) {
            self::displayError($err, true);
        }
    }
    /**
     * @param $err
     */
    public static function logError($err)
    {
        error_log($err, 0);
    }
    /**
     * @param $err
     * @param bool|false $kill
     */
    public static function displayError($err, $kill = false)
    {
        print_r($err);
        if ($kill === false) {
            die();
        }
    }
}