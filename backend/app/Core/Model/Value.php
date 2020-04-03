<?php
/** @noinspection PhpUnused */

namespace App\Core\Model;

use function App\Helper\is_binary;

/**
 * Trait Value
 * @package App\Core\Model
 */
trait Value
{
    /**
     * @var array
     */
    protected $getters = [];

    /**
     * @var array
     */
    protected $setters = [];

    /**
     * @param array [$names]
     * @return array
     */
    public function getValues(?array $names = []): array
    {
        if (!count($names)) {
            $attributes = $this->getAttributes();
            foreach ($attributes as $key => $attribute) {
                if (!is_binary($attribute)) {
                    continue;
                }
                unset($attributes[$key]);
            }
            return $attributes;
        }

        $values = [];
        foreach ($names as $name) {
            $value = $this->getValue($name);
            if (in_array($name, $this->encoded, true)) {
                $value = static::decodeUuid($value);
            }
            $values[$name] = $value;
        }
        return $values;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getValue(string $name)
    {
        $value = $this->getAttribute($name);
        if (isset($this->getters[$name]) && is_callable($this->getters[$name])) {
            return $this->getters[$name]($value);
        }
        return $value;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    public function setValue(string $name, $value)
    {
        if (isset($this->setters[$name]) && is_callable($this->setters[$name])) {
            $value = $this->setters[$name]($value);
        }
        $this->setAttribute($name, $value);
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();
        if (isset($array[$this->getKeyName()])) {
            unset($array[$this->getKeyName()]);
        }
        foreach (array_keys($this->manyToMany()) as $related) {
            if (!isset($array[$related])) {
                continue;
            }
            if (!is_array($array[$related])) {
                continue;
            }
            $array[$related] = array_map(static function ($row) {
                if (isset($row['pivot'])) {
                    unset($row['pivot']);
                }
                return $row;
            }, $array[$related]);
        }
        return $array;
    }

    /**
     * @param array $avoid
     * @return array
     */
    public function except(array $avoid): array
    {
        $values = $this->toArray();

        $callback = static function ($key) use ($avoid) {
            return !in_array($key, $avoid, true);
        };

        return array_filter($values, $callback, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Convert the model instance to an array.
     *
     * @return mixed
     */
    public function toArray()
    {
        if (!$this->exists) {
            return parent::toArray();
        }
        $data = parent::toArray();
        if (isset($data[$this->getKeyName()])) {
            unset($data[$this->getKeyName()]);
        }
        return $this->safeAttributes($data);
    }

    /**
     * @param array $attributes
     * @param array $except
     * @return array
     */
    private function safeAttributes(array $attributes, array $except = []): array
    {
        foreach ($attributes as $key => &$value) {
            if (in_array($key, $except, true)) {
                continue;
            }
            if (!is_binary($value)) {
                continue;
            }
            $value = static::decodeUuid($value);
        }
        return $attributes;
    }
}