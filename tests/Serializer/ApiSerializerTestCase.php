<?php
declare(strict_types=1);

/*
 * This file is part of the ideneal/emailoctopus library
 *
 * (c) Daniele Pedone <ideneal.ztl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ideneal\EmailOctopus\Tests\Serializer;


use PHPUnit\Framework\TestCase;

/**
 * Class ApiSerializerTestCase
 *
 * @package Ideneal\EmailOctopus\Tests\Serializer
 */
abstract class ApiSerializerTestCase extends TestCase
{
    /**
     * @var array
     */
    protected $json = [];
}