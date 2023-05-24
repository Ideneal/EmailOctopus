<?php
declare(strict_types=1);

namespace Ideneal\EmailOctopus\Tests\Entity;

use Ideneal\EmailOctopus\Entity\MailingList;
use Ideneal\EmailOctopus\Entity\MailingListField;
use PHPUnit\Framework\TestCase;

final class MailingListTest extends TestCase
{
    public function testGetId(): void
    {
        $id = 'list_id';
        $list = (new MailingList())->setId($id);

        $this->assertSame($id, $list->getId());
    }

    public function testSetId(): void
    {
        $id = 'list_id';
        $list = new MailingList();
        $result = $list->setId($id);

        $this->assertInstanceOf(MailingList::class, $result);
        $this->assertSame($id, $list->getId());
    }

    public function testGetName(): void
    {
        $name = 'List Name';
        $list = (new MailingList())->setName($name);

        $this->assertSame($name, $list->getName());
    }

    public function testSetName(): void
    {
        $name = 'List Name';
        $list = new MailingList();
        $result = $list->setName($name);

        $this->assertInstanceOf(MailingList::class, $result);
        $this->assertSame($name, $list->getName());
    }

    public function testIsDoubleOptIn(): void
    {
        $doubleOptIn = true;
        $list = (new MailingList())->setDoubleOptIn($doubleOptIn);

        $this->assertSame($doubleOptIn, $list->isDoubleOptIn());
    }

    public function testSetDoubleOptIn(): void
    {
        $doubleOptIn = true;
        $list = new MailingList();
        $result = $list->setDoubleOptIn($doubleOptIn);

        $this->assertInstanceOf(MailingList::class, $result);
        $this->assertSame($doubleOptIn, $list->isDoubleOptIn());
    }

    public function testGetFields(): void
    {
        $fields = [new MailingListField()];
        $list = (new MailingList())->setFields($fields);

        $this->assertSame($fields, $list->getFields());
    }

    public function testSetFields(): void
    {
        $fields = [new MailingListField()];
        $list = new MailingList();
        $result = $list->setFields($fields);

        $this->assertInstanceOf(MailingList::class, $result);
        $this->assertSame($fields, $list->getFields());
    }

    public function testAddField(): void
    {
        $field = new MailingListField();
        $list = new MailingList();
        $result = $list->addField($field);

        $this->assertInstanceOf(MailingList::class, $result);
        $this->assertContains($field, $list->getFields());
    }

    public function testGetCounts(): void
    {
        $counts = ['subscribers' => 100];
        $list = (new MailingList())->setCounts($counts);

        $this->assertSame($counts, $list->getCounts());
    }

    public function testSetCounts(): void
    {
        $counts = ['subscribers' => 100];
        $list = new MailingList();
        $result = $list->setCounts($counts);

        $this->assertInstanceOf(MailingList::class, $result);
        $this->assertSame($counts, $list->getCounts());
    }

    public function testGetCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $list = (new MailingList())->setCreatedAt($createdAt);

        $this->assertSame($createdAt, $list->getCreatedAt());
    }

    public function testSetCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $list = new MailingList();
        $result = $list->setCreatedAt($createdAt);

        $this->assertInstanceOf(MailingList::class, $result);
        $this->assertSame($createdAt, $list->getCreatedAt());
    }
}
