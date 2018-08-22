<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 22/08/2018
 * Time: 11:38
 */

namespace SimpleEnum;

use SimpleEnum\Exception\UnknownEumException;
use Stringy\Stringy;

abstract class Enum
{

    /**
     * @var array
     */
    protected static $list = null;

    /**
     * @var int
     */
    private $key;

    /**
     * Label
     * @var string
     */
    private $label = '';

    /**
     * Overriding label
     * @var string
     */
    private $overridinglabel = '';

    /**
     * Constructor
     * @param int $key
     * @param string $label
     */
    protected function __construct(int $key, string $label = '')
    {
        $this->key = $key;
        $this->label = $label;
        $this->overridinglabel = $label;
    }

    /**
     * Create an new instance of Enum and add it to the list
     * @param int $key
     * @param string $label
     * @param array $args
     * @return static
     */
    protected static function addEnum(int $key, string $label = ''):self
    {
        $enum = new static($key, $label);
        return static::addEnumInstance($enum);
    }

    /**
     * Adding an Enum instance to the list
     * @param Enum $enum
     * @return Enum
     */
    protected static function addEnumInstance(Enum $enum):self
    {
        static::$list[static::class][$enum->key] = $enum;
        return $enum;
    }

    /**
     * List initialization
     * @return void
     */
    final protected static function listInit():void
    {
        // list is already initialized
        if (static::$list && array_key_exists(static::class, static::$list)) {
            return;
        }
        static::defineList();
    }

    /**
     * By default, add the constants list, the labels will be the humanized value of the constants name
     * Must use the addEnum method
     * To override if the labels aren't correct
     */
    protected static function defineList():void
    {
        $reflect = new ReflectionClass(static::class);
        $constants = $reflect->getConstants();
        foreach ($constants as $key => $value) {
            $label = (string) Stringy::create($key)->humanize();
            static::addEnum($value, $label);
        }
    }

    /**
     * Getting the enum list of the called class
     * @return array|Enum[] key => Enum
     */
    final public static function getList():array
    {
        static::listInit();
        $liste = [];
        if (array_key_exists(static::class, static::$list)) {
            $liste = static::$list[static::class] ?? [];
        }
        return $liste;
    }

    /**
     * Getting the labels
     * Useful for HTML select options for example
     * @return array id => label
     */
    final public static function getLabels():array
    {
        $listeLabels = [];
        $liste = static::getList();
        foreach ($liste as $key => $value) {
            $listeLabels[$key] = $value->getLabel();
        }
        return $listeLabels;
    }

    /**
     * Getting the enum label by its key
     * @param int $value
     * @return string
     * @throws UnknownEumException
     */
    final public static function getLabelById(int $key):string
    {
        $enum = static::getInstance($key);
        return $enum->getLabel();
    }

    /**
     * Getting the instance of an enum by its key
     * @param int $key
     * @return static
     * @throws UnknownEumException
     */
    final public static function getInstance(int $key):self
    {
        $liste = static::getList();
        if (!array_key_exists($key, $liste)) {
            throw new UnknownEumException(static::class, $key);
        }
        return $liste[$key];
    }

    /**
     * Getting the label of the enum instance
     * @return string
     */
    final public function getLabel():string
    {
        return $this->overridinglabel;
    }

    /**
     * Override the label of the enum instance
     * @param string $label
     * @return $this
     */
    final public function setLabel(string $label):self
    {
        $this->overridinglabel = $label;
        return $this;
    }

    /**
     * Use the default enum instance label
     * @return $this
     */
    final public function resetLabel():self
    {
        $this->overridinglabel = $this->label;
        return $this;
    }

    /**
     * The enum key
     * @return int
     */
    final public function getKey():int
    {
        return $this->key;
    }

    /**
     * Énum est-elle celle dont le n° est passé en paramètre
     * Has the enum get the same key?
     * @param integer $key
     * @return boolean
     */
    final public function is(int $key):bool
    {
        return $this->getKey() === $key;
    }

    /**
     * Are this and $enum equal?
     * @param Enum $enum
     * @return boolean
     */
    final public function equals(Enum $enum):bool
    {
        if (get_class($this) !== get_class($enum)) {
            return FALSE;
        }
        return $this->is($enum->getKey());
    }

    /**
     * Is the label overridden
     * @return boolean
     */
    final public function isOverriddenLabel():bool
    {
        return $this->overridinglabel !== $this->label;
    }

    /**
     * Return the enum class and key
     * Useful to compare two enums with ==
     * @return string
     */
    final public function __toString():string
    {
        return static::class . '\\' . $this->key;
    }
}