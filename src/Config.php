<?php
namespace Kuink\Bridge;

/**
 * Class Config
 * @package Kuink\Bridge
 */
class Config
{
    private $kv = [];

    /**
     * Config constructor.
     * @param array $kv
     */
    public function __construct($kv = [])
    {
        $this->kv = $kv;
    }

    /**
     * Set a config kv
     * @param string $key
     * @param $value
     * @return Config
     */
    public function set(string $key, $value) : Config
    {
        $this->kv[$key] = $value;
        return $this;
    }

    /**
     * Return a config value
     * @param string $key
     * @param null $default
     * @return Config|mixed|null
     */
    public function get(string $key, $default = null)
    {
        if (!isset($this->kv[$key])) {
            return $default;
        }

        // If is an array, then return a kv
        if (is_array($this->kv[$key])) {
            return new Config($this->kv[$key]);
        }

        return $this->kv[$key];
    }

    /**
     * Checks if a key exists
     * @param string $key
     * @return bool
     */
    public function exists(string $key)
    {
        return isset($this->kv[$key]);
    }
}
