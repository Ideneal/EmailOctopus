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

use Ideneal\EmailOctopus\Entity\Contact;
use Ideneal\EmailOctopus\Serializer\ContactSerializer;

/**
 * Class ContactSerializerTest
 *
 * @package Ideneal\EmailOctopus\Tests\Serializer
 */
class ContactSerializerTest extends ApiSerializerTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->json = [
            [
                'id'            => '68f1cfb8-be06-11ea-a3d0-06b4694bee2a',
                'email_address' => 'john.doe@mail.com',
                'fields'        => [
                    'FirstName' => 'John',
                    'LastName'  => 'Doe',
                ],
                'status'        => 'SUBSCRIBED',
                'created_at'    => '2020-07-04T14:55:32+00:00',
            ],
        ];
    }

    /**
     * Tests contact serialization.
     */
    public function testSerialization()
    {
        $contact = new Contact();
        $contact
            ->setEmail('john.doe@mail.com')
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setStatus(Contact::STATUS_SUBSCRIBED)
        ;

        $json = ContactSerializer::serialize($contact);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('email_address', $json);
        $this->assertArrayHasKey('fields', $json);
        $this->assertIsArray($json['fields']);
        $this->assertCount(2, $json['fields']);
        $this->assertArrayHasKey('FirstName', $json['fields']);
        $this->assertArrayHasKey('LastName', $json['fields']);
        $this->assertEquals('john.doe@mail.com', $json['email_address']);
    }

    /**
     * Tests a contact json object deserialization.
     *
     * @throws \Exception
     */
    public function testJsonObjectDeserialization()
    {
        $jsonObject = $this->json[0];
        $contact    = ContactSerializer::deserializeSingle($jsonObject);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertInstanceOf(\DateTimeInterface::class, $contact->getCreatedAt());
        $this->assertIsArray($contact->getFields());
        $this->assertCount(2, $contact->getFields());
    }

    /**
     * Tests a contact list json array deserialization.
     */
    public function testJsonArrayDeserialization()
    {
        $contacts = ContactSerializer::deserializeMultiple($this->json);

        $this->assertIsArray($contacts);
        $this->assertCount(1, $contacts);
        $this->assertContainsOnlyInstancesOf(Contact::class, $contacts);
    }
}
