<?php
/**
 * This file is part of the Cache library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ronam Unstirred (unforge.coder@gmail.com)
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace Unforge\Abstraction;

use Unforge\Abstraction\Cache\AbstractCache;
use Unforge\Toolkit\Configurator;

/**
 * Class AbstractClient
 *
 * @package Unforge\Abstraction
 */
abstract class AbstractClient
{
    /**
     * @var AbstractCache
     */
    private static $instance;

    /**
     * Cache constructor.
     *
     * @param Configurator|array $configurator
     *
     * @throws \Exception
     */
    public function __construct($configurator)
    {
        if ($configurator instanceof Configurator) {
            $settings = $configurator->getConfigByObject($this)->getArrayCopy();
        } else {
            $settings = $configurator;
        }
        if (empty($settings)) {
            throw new \Exception("Config is require");
        }

        $instance = static::getInstanceName();
        if (!class_exists($instance)) {
            throw new \Exception("Class $instance not exist");
        }

        /** @var $instance AbstractCache */
        static::$instance = $instance::getInstance()
            ->connect($settings);
    }

    /**
     * @param string|array $key
     * @param string $value
     * @param string $prefix
     *
     * @return bool
     */
    public static function set($key, string $value, string $prefix = 'cache'): bool
    {
        $key = static::prepareKeyToString($key);
        return static::$instance->set($key, $value, $prefix);
    }

    /**
     * @param string|array $key
     * @param string $prefix
     *
     * @return string
     */
    public static function get($key, string $prefix = 'cache'): string
    {
        $key = static::prepareKeyToString($key);
        return static::$instance->get($key, $prefix);
    }

    /**
     * @param $key
     * @param string $prefix
     *
     * @return bool
     */
    public static function del($key, string $prefix = 'cache'): bool
    {
        $key = static::prepareKeyToString($key);
        return static::$instance->del($key, $prefix);
    }

    /**
     * @param string $prefix
     *
     * @return bool
     */
    public static function flush(string $prefix = 'cache'): bool
    {
        return static::$instance->flush($prefix);
    }

    /**
     * @param string|array $key
     *
     * @return string
     */
    protected static function prepareKeyToString($key): string
    {
        if (is_array($key)) {
            $key = implode("//", $key);
        }

        return (string)$key;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    protected static function getInstanceName(): string
    {
        $client_name = (new \ReflectionClass(static::class))->getName();

        $instance_class_name = current(array_diff(preg_split('/(?=[A-Z])/', $client_name), ['']));

        return "\\Unforge\\Toolkit\\Cache\\$instance_class_name";
    }
}
