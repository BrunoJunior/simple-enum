# simple-enum
Abstract class to simulate enum with label in PHP
## How to install
```shell
composer require brunojunior/simple-enum
```
## How to use
You have to create a class which extends `SimpleEnum\Enum`.
### The simpliest enum
This enum will automatically generate labels thanks to the constants name.
Here, you'll have those labels «First value», «Second value» and «Third value».
```php
<?php
class SimpleEnum extends \SimpleEnum\Enum
{
    const FIRST_VALUE = 0;
    const SECOND_VALUE = 1;
    const THIRD_VALUE = 2;
}
```
### A simple enum with defined labels
In this enum, the user want to change default labels.
```php
<?php
class LabeledEnum extends \SimpleEnum\Enum
{
    const FIRST_VALUE = 0;
    const SECOND_VALUE = 1;
    const THIRD_VALUE = 2;

    /**
     * Specify the labels
     */
    protected static function defineList(): void
    {
        static::addEnum(static::FIRST_VALUE, 'My first value');
        static::addEnum(static::SECOND_VALUE, 'This is the second value');
        static::addEnum(static::THIRD_VALUE, 'Hey! 3rd value!');
    }
}
```
### A more complex enum with extra fonctionnality
In this enum, the user want to change default label and add some extra features.
```php
<?php
class ComplexEnum extends \SimpleEnum\Enum
{
    const FIRST_VALUE = 0;
    const SECOND_VALUE = 1;
    const THIRD_VALUE = 2;
    
    /**
     * A property
     */
    private $prop;

    /**
     * Specify the labels
     */
    protected static function defineList(): void
    {
        static::addEnum(static::FIRST_VALUE, 'My first value')->setProp(42);
        static::addEnum(static::SECOND_VALUE, 'This is the second value')->setProp(0);
        static::addEnum(static::THIRD_VALUE, 'Hey! 3rd value!')->setProp(-1);
    }

    /**
     * @param int $value
     * @return ComplexEnum
     */
    private function setProp(int $value):self
    {
        $this->prop = $value;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getProp():?int
    {
        return $this->prop;
    }
    
    /**
     * @return string
     */
    public function doStuffWithProp():string
    {
        if ($this->prop === 42) {
          return "This is the answer to life the universe and everything";
        }
        return "I don't know";
    }
}
```
## Available methods
### `Enum::getList()`
This method will return an array with constants value as keys and the associated Enum instance as values.
### `Enum::getLabels()`
This method will return an array with constants value as keys and the label as values.
It can be useful for HTML select options.
### `Enum::getLabelById()`
This method will return the label for a specific key.
If the key is unknown it will raise `SimpleEnum\UnknownEumException`.
### `Enum::getInstance()`
This method will return an Enum instance for a specific key.
If the key is unknown it will raise `SimpleEnum\UnknownEumException`.
### `enumInstance->getLabel()`
This method will return the label of a specific instance.
### `enumInstance->setLabel($label)`
This method allows you to override the default label.
### `enumInstance->resetLabel()`
This method will reset the default label of the instance.
### `enumInstance->getKey()`
This method will return the key of the instance.
### `enumInstance->is(int $key)`
This method will check if the instance has the same key.
### `enumInstance->equals(Enum $anotherInstance)`
This method will check if the two instances have the same key.
### How to compare
#### Using the `==`
This way to compare is really simple. You can do something like this :
```php
$receivedValue = 2;
SimpleEnum::getInstance(SimpleEnum::THIRD_VALUE) == $receivedValue;
```
#### Using the `is` method
```php
$receivedValue = 2;
SimpleEnum::getInstance(SimpleEnum::THIRD_VALUE)->is($receivedValue);
```
