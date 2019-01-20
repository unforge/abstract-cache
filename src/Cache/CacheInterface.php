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
 * Interface CacheInterface
 *
 * @package Unforge\Abstraction\Cache
 */
interface CacheInterface
{
    /**
     * @param array $config
     */
    public function connect(array $config);

    /**
     * @param string $key
     * @param string $value
     * @param string $prefix
     *
     * @return bool
     */
    public function set(string $key, string $value, string $prefix = 'cache'): bool;

    /**
     * @param string $key
     * @param string $prefix
     *
     * @return string
     */
    public function get(string $key, string $prefix = 'cache'): string;

    /**
     * @param string $key
     * @param string $prefix
     *
     * @return bool
     */
    public function del(string $key, string $prefix = 'cache'): bool;

    /**
     * @param string $prefix
     *
     * @return bool
     */
    public function flush(string $prefix = 'cache'): bool;
}
