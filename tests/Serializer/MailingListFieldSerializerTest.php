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

use Ideneal\EmailOctopus\Entity\MailingListField;
use Ideneal\EmailOctopus\Serializer\MailingListFieldSerializer;

/**
 * Class MailingListFieldSerializerTest
 *
 * @package Ideneal\EmailOctopus\Tests\Serializer
 */
class MailingListFieldSerializerTest extends ApiSerializerTestCase
{
    protected function setUp(): void
    {
        $this->json = [
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
        ];
    }

    public function testSerialization(): void
    {
        $field = new MailingListField();
        $field
            ->setLabel('Email')
            ->setTag('EmailAddress')
            ->setType(MailingListField::TEXT)
        ;

        $json = MailingListFieldSerializer::serialize($field);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('label', $json);
        $this->assertArrayHasKey('tag', $json);
        $this->assertArrayHasKey('type', $json);
        $this->assertArrayHasKey('fallback', $json);
        $this->assertSame('Email', $json['label']);
        $this->assertSame('EmailAddress', $json['tag']);
        $this->assertSame('TEXT', $json['type']);
    }

    public function testJsonObjectDeserialization(): void
    {
        $field = MailingListFieldSerializer::deserializeSingle($this->json[0]);

        $this->assertInstanceOf(MailingListField::class, $field);
        $this->assertSame('EmailAddress', $field->getTag());
        $this->assertSame(MailingListField::TEXT, $field->getType());
    }

    public function testJsonArrayDeserialization(): void
    {
        $fields = MailingListFieldSerializer::deserializeMultiple($this->json);

        $this->assertIsArray($fields);
        $this->assertContainsOnlyInstancesOf(MailingListField::class, $fields);
        $this->assertCount(3, $fields);
    }
}
