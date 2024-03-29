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

use Ideneal\EmailOctopus\Entity\MailingList;
use Ideneal\EmailOctopus\Entity\MailingListField;
use Ideneal\EmailOctopus\Serializer\MailingListSerializer;

/**
 * Class MailingListSerializerTest
 *
 * @package Ideneal\EmailOctopus\Tests\Serializer
 */
class MailingListSerializerTest extends ApiSerializerTestCase
{
    protected function setUp(): void
    {
        $this->json = [
            [
                'id'            => '68f1cfb8-be06-11ea-a3d0-06b4694bee2a',
                'name'          => 'Api Test',
                'double_opt_in' => false,
                'created_at'    => '2020-07-04T14:55:32+00:00',
                'fields'        => [
                    [
                        'tag'      => 'EmailAddress',
                        'type'     => 'TEXT',
                        'label'    => 'Email address',
                        'fallback' => null,
                    ],
                    [
                        'tag'      => 'FirstName',
                        'type'     => 'TEXT',
                        'label'    => 'First Name',
                        'fallback' => null,
                    ],
                    [
                        'tag'      => 'LastName',
                        'type'     => 'TEXT',
                        'label'    => 'Last name',
                        'fallback' => null,
                    ],
                ],
            ],
        ];
    }

    public function testSerialization(): void
    {
        $list = new MailingList();
        $list->setName('Test');

        $json = MailingListSerializer::serialize($list);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('name', $json);
        $this->assertSame('Test', $json['name']);
    }

    public function testJsonObjectDeserialization(): void
    {
        $jsonList = $this->json[0];

        $list = MailingListSerializer::deserializeSingle($jsonList);

        $this->assertInstanceOf(MailingList::class, $list);
        $this->assertInstanceOf(\DateTimeInterface::class, $list->getCreatedAt());
        $this->assertIsArray($list->getFields());
        $this->assertCount(3, $list->getFields());
        $this->assertContainsOnlyInstancesOf(MailingListField::class, $list->getFields());
    }

    public function testJsonArrayDeserialization(): void
    {
        $lists = MailingListSerializer::deserializeMultiple($this->json);

        $this->assertIsArray($lists);
        $this->assertCount(1, $lists);
        $this->assertContainsOnlyInstancesOf(MailingList::class, $lists);
    }
}
