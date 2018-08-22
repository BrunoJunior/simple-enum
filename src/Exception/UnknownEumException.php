<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 22/08/2018
 * Time: 10:59
 */

namespace SimpleEnum\Exception;


use Throwable;

class UnknownEumException extends \Exception
{
    /**
     * UnknownEumException constructor.
     * @param string $classname
     * @param int $value
     * @param Throwable|null $previous
     */
    public function __construct(string $classname, int $value, Throwable $previous = null)
    {
        parent::__construct("Unknown value \"$value\" for enum $classname !", 1, $previous);
    }
}