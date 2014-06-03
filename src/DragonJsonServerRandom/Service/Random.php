<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerRandom
 */

namespace DragonJsonServerRandom\Service;

/**
 * Serviceklasse zur Verwaltung von Zufallszahlen
 */
class Random
{
    /**
     * @var array
     */
    protected $values = [];

    /**
     * Fügt einen definierten Zufallswert hinzu
     * @param mixed $value
     * @return Random
     */
    public function addValue($value)
    {
        $this->values[] = $value;
        return $this;
    }

    /**
     * Fügt mehrere definierte Zufallswerte hinzu
     * @param array $values
     * @return Random
     */
    public function addValues(array $values)
    {
        foreach ($values as $value) {
            $this->addValue(value);
        }
        return $this;
    }

    /**
     * Gibt die definierten Zufallswerte zurück
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Entfernt die definierten Zufallswerte
     * @return Random
     */
    public function removeValues()
    {
        $this->values = [];
        return $this;
    }

    /**
     * Gibt eine zufällige Zahl innerhalb des übergebenen Bereichs zurück
     * @param integer|array $min
     * @param integer $max
     * @return integer
     * @example
        $number = $serviceRandom->getRandomNumber(1, 100);
        $number = $serviceRandom->getRandomNumber([1, 100]);
        $number = $serviceRandom->getRandomNumber(['min' => 1, 'max' => 100]);
     */
    public function getNumber($min, $max)
    {
        if (count($this->values) > 0) {
            return array_shift($this->values);
        }
        if (is_array($min)) {
            if (isset($min['min']) && isset($min['max'])) {
                $max = $min['max'];
                $min = $min['min'];
            } else {
                list ($min, $max) = $min;
            }
        }
        return mt_rand($min, $max);
    }

    /**
     * Gibt ein zufälliges Element des übergebenen Arrays zurück
     * @param array $elements
     * @return mixed
     */
    public function getElement(array $elements)
    {
        if (count($this->values) > 0) {
            return array_shift($this->values);
        }
        $key = array_rand($elements);
        return $elements[$key];
    }

    /**
     * Gibt mehrere zufällige Elemente des übergebenen Arrays zurück
     * @param array $elements
     * @param integer $amount
     * @return array
     */
    public function getElements(array $elements, $amount)
    {
        $randoms = [];
        for ($i = 0; $i < $amount; ++$i) {
            $randoms[] = $this->getRandomElement($elements);
        }
        return $randoms;
    }

    /**
     * Gibt einen zufälligen String mit Zeichen aus dem Charset zurück
     * @param integer $length
     * @param string $charset
     * @return string
     */
    public function getString($length, $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
    {
        if (count($this->values) > 0) {
            return array_shift($this->values);
        }
        $string = '';
        for ($i = 0; $i < $length; ++$i) {
            $string .= $charset[mt_rand(0, strlen($charset) - 1)];
        }
        return $string;
    }
}
