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

use Ideneal\EmailOctopus\Entity\Contact;
use Ideneal\EmailOctopus\Serializer\ContactSerializer;

/**
 * Class ContactSerializerTest
 *
 * @package Ideneal\EmailOctopus\Tests\Serializer
 */
class ContactSerializerTest extends ApiSerializerTestCase
{
    protected function setUp(): void
    {
        $this->json = [
            [
                'id'            => '68f1cfb8-be06-11ea-a3d0-06b4694bee2a',
                'email_address' => 'john.doe@mail.com',
                'fields'        => [
                    'FirstName' => 'John',
                    'LastName'  => 'Doe',
                ],
                'tags'        => [
                    'FreeTrialUser'  => true,
                    'AccountConnected'  => false,
                ],
                'status'        => 'SUBSCRIBED',
                'created_at'    => '2020-07-04T14:55:32+00:00',
            ],
        ];
    }

    public function testSerialization(): void
    {
        $contact = new Contact();
        $contact
            ->setEmail('john.doe@mail.com')
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setStatus(Contact::STATUS_SUBSCRIBED)
            ->addTag('FreeTrialUser')
            ->addTag('AccountConnected')
            ->removeTag('AccountConnected')
        ;

        $json = ContactSerializer::serialize($contact);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('email_address', $json);
        $this->assertArrayHasKey('fields', $json);
        $this->assertIsArray($json['fields']);
        $this->assertCount(2, $json['fields']);
        $this->assertArrayHasKey('FirstName', $json['fields']);
        $this->assertArrayHasKey('LastName', $json['fields']);
        $this->assertSame('john.doe@mail.com', $json['email_address']);
        $this->assertIsArray($json['tags']);
        $this->assertCount(1, $json['tags']);
        $this->assertContains('FreeTrialUser', $json['tags']);
        $this->assertNotContains('AccountConnected', $json['tags']);

    }

    /**
     * Tests a contact json object deserialization.
     */
    public function testJsonObjectDeserialization(): void
    {
        $jsonObject = $this->json[0];
        $contact    = ContactSerializer::deserializeSingle($jsonObject);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertInstanceOf(\DateTimeInterface::class, $contact->getCreatedAt());
        $this->assertIsArray($contact->getFields());
        $this->assertCount(2, $contact->getFields());
        $this->assertIsArray($contact->getTags());
        $this->assertCount(1, $contact->getTags());
    }

    public function testJsonArrayDeserialization(): void
    {
        $contacts = ContactSerializer::deserializeMultiple($this->json);

        $this->assertIsArray($contacts);
        $this->assertCount(1, $contacts);
        $this->assertContainsOnlyInstancesOf(Contact::class, $contacts);
    }
}