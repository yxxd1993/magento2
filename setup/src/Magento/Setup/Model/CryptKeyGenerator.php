<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Setup\Model;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Config\ConfigOptionsListConstants;
use Magento\Framework\Math\Random;

/**
 * Generates a crypt
 * @api
 */
class CryptKeyGenerator implements CryptKeyGeneratorInterface
{
    /**
     * @var Random
     */
    private $random;

    public function __construct(Random $random = null)
    {
        $this->random = $random ?? ObjectManager::getInstance()->get(Random::class);
    }

    /**
     * Generates & returns a string to be used as crypt key.
     *
     * The key length is not a parameter, but an implementation detail.
     *
     * @return string
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function generate()
    {
        return md5($this->getRandomString());
    }

    /**
     * Returns a random string.
     *
     * @return string
     */
    private function getRandomString()
    {
        return $this->random->getRandomString(ConfigOptionsListConstants::STORE_KEY_RANDOM_STRING_SIZE);
    }
}
