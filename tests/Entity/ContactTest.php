<?php
declare(strict_types=1);

namespace Ideneal\EmailOctopus\Tests\Entity;

use Ideneal\EmailOctopus\Entity\Contact;
use PHPUnit\Framework\TestCase;

final class ContactTest extends TestCase
{
    public function testGetId(): void
    {
        $contact = new Contact();
        $contact->setId('123');

        $this->assertSame('123', $contact->getId());
    }

    public function testSetId(): void
    {
        $contact = new Contact();
        $result = $contact->setId('123');

        $this->assertInstanceOf(Contact::class, $result);
        $this->assertSame('123', $contact->getId());
    }

    public function testGetEmail(): void
    {
        $contact = new Contact();
        $contact->setEmail('test@example.com');

        $this->assertSame('test@example.com', $contact->getEmail());
    }

    public function testSetEmail(): void
    {
        $contact = new Contact();
        $result = $contact->setEmail('test@example.com');

        $this->assertInstanceOf(Contact::class, $result);
        $this->assertSame('test@example.com', $contact->getEmail());
    }

    public function testGetFirstName(): void
    {
        $contact = new Contact();
        $contact->setFirstName('John');

        $this->assertSame('John', $contact->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $contact = new Contact();
        $result = $contact->setFirstName('John');

        $this->assertInstanceOf(Contact::class, $result);
        $this->assertSame('John', $contact->getFirstName());
    }

    public function testGetLastName(): void
    {
        $contact = new Contact();
        $contact->setLastName('Doe');

        $this->assertSame('Doe', $contact->getLastName());
    }

    public function testSetLastName(): void
    {
        $contact = new Contact();
        $result = $contact->setLastName('Doe');

        $this->assertInstanceOf(Contact::class, $result);
        $this->assertSame('Doe', $contact->getLastName());
    }

    public function testGetFields(): void
    {
        $contact = new Contact();
        $contact->setFields(['key' => 'value']);

        $this->assertSame(['key' => 'value'], $contact->getFields());
    }

    public function testSetFields(): void
    {
        $contact = new Contact();
        $result = $contact->setFields(['key' => 'value']);

        $this->assertInstanceOf(Contact::class, $result);
        $this->assertSame(['key' => 'value'], $contact->getFields());
    }

    public function testAddField(): void
    {
        $contact = new Contact();
        $result = $contact->addField('key', 'value');

        $this->assertInstanceOf(Contact::class, $result);
        $this->assertSame(['key' => 'value'], $contact->getFields());
    }

    public function testGetStatus(): void
    {
        $contact = new Contact();
        $contact->setStatus(Contact::STATUS_SUBSCRIBED);

        $this->assertSame(Contact::STATUS_SUBSCRIBED, $contact->getStatus());
    }

    public function testSetStatus(): void
    {
        $contact = new Contact();
        $result = $contact->setStatus(Contact::STATUS_SUBSCRIBED);

        $this->assertInstanceOf(Contact::class, $result);
        $this->assertSame(Contact::STATUS_SUBSCRIBED, $contact->getStatus());
    }

    public function testGetCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $contact = new Contact();
        $contact->setCreatedAt($createdAt);

        $this->assertSame($createdAt, $contact->getCreatedAt());
    }

    public function testSetCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $contact = new Contact();
        $result = $contact->setCreatedAt($createdAt);

        $this->assertInstanceOf(Contact::class, $result);
        $this->assertSame($createdAt, $contact->getCreatedAt());
    }
}

