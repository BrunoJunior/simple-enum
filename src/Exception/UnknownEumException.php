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
     * @param string $classe
     * @param int $valeur
     * @param Throwable|null $previous
     */
    public function __construct(string $classe, int $valeur, Throwable $previous = null)
    {
        parent::__construct("Valeur \"$valeur\" inconnue pour l'énumération $classe !", 1, $previous);
    }
}