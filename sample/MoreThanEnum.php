<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 22/08/2018
 * Time: 12:22
 */

/**
 * Class MoreThanEnum
 * This sample shows you the possibility to add private fields
 * and add some methods to your enum to do some extra stuff
 * because Enum is always an object …
 * So be creative
 */
class MoreThanEnum extends \SimpleEnum\Enum
{
    const ZERO = 0;
    const ONE = 1;
    const TWO = 2;

    /**
     * @var MoreThanEnum
     */
    private $previous;

    /**
     * Define the list
     */
    protected static function defineList(): void
    {
        static::addEnum(static::TWO, 'Two')
            ->setPrevious(static::addEnum(static::ONE, 'One')
                ->setPrevious(static::addEnum(static::ZERO, 'Zero')));
    }

    /**
     * @param MoreThanEnum $enum
     * @return MoreThanEnum
     */
    private function setPrevious(MoreThanEnum $enum):self
    {
        $this->previous = $enum;
        return $this;
    }

    /**
     * @return MoreThanEnum|null
     */
    public function getPrevious():?MoreThanEnum
    {
        return $this->previous;
    }

    /**
     * Call the callback from this to zero thanks to previous
     * @param callable $callback
     */
    public function doStuffUntilZero(callable $callback)
    {
        $callback($this);
        if ($this->previous) {
            $this->previous->doStuffUntilZero($callback);
        }
    }
}