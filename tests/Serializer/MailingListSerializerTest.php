<?php
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
    /**
     * {@inheritDoc}
     */
    protected function setUp()
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

    /**
     * Tests mailing list serialization.
     */
    public function testSerialization()
    {
        $list = new MailingList();
        $list->setName('Test');

        $json = MailingListSerializer::serialize($list);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('name', $json);
        $this->assertEquals('Test', $json['name']);
    }

    /**
     * Tests a json list object deserialization.
     *
     * @throws \Exception
     */
    public function testSingleJsonObjectDeserialization()
    {
        $jsonList = $this->json[0];

        $list = MailingListSerializer::deserializeSingle($jsonList);

        $this->assertInstanceOf(MailingList::class, $list);
        $this->assertInstanceOf(\DateTimeInterface::class, $list->getCreatedAt());
        $this->assertIsArray($list->getFields());
        $this->assertCount(3, $list->getFields());
        $this->assertContainsOnlyInstancesOf(MailingListField::class, $list->getFields());
    }
}
