<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 22/08/2018
 * Time: 11:43
 */

/**
 * Class SampleEnum
 * This really simple sample will create an enum with 4 values
 * DEBUG, INFO, ALERT and ERROR
 * Labels will be defined thanks to the defineList method
 */
class LevelEnum extends \SimpleEnum\Enum
{
    const DEBUG = 0;
    const INFO = 1;
    const ALERT = 2;
    const ERROR = 3;

    /**
     * Specify the labels
     */
    protected static function defineList(): void
    {
        static::addEnum(static::DEBUG, 'Debug mode');
        static::addEnum(static::INFO, 'Information');
        static::addEnum(static::ALERT, 'Attention');
        static::addEnum(static::ERROR, 'ERROR');
    }
}