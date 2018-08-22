<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 22/08/2018
 * Time: 11:43
 */

/**
 * Class SampleEnum
 * This really simple sample will create an enum with 3 values
 * NO, YES and MAYBE
 * Labels will be automatically generated with No, Yes and Maybe
 */
class TrooleanEnum extends \SimpleEnum\Enum
{
    const NO = 0;
    const YES = 1;
    const MAYBE = 2;
}