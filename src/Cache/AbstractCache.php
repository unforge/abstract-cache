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

namespace Unforge\Abstraction\Cache;

/**
 * Class AbstractCache
 *
 * @package Unforge\Abstraction\Cache
 */
abstract class AbstractCache implements CacheInterface
{
    /**
     * @var AbstractCache
     */
    private static $instance;

    /**
     * @return AbstractCache
     */
    public static function getInstance(): AbstractCache
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
