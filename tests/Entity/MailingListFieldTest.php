<?php
declare(strict_types=1);

namespace Ideneal\EmailOctopus\Tests\Entity;

use Ideneal\EmailOctopus\Entity\MailingListField;
use PHPUnit\Framework\TestCase;

final class MailingListFieldTest extends TestCase
{
    public function testGetTag(): void
    {
        $tag = 'field_tag';
        $field = (new MailingListField())->setTag($tag);

        $this->assertSame($tag, $field->getTag());
    }

    public function testSetTag(): void
    {
        $tag = 'field_tag';
        $field = new MailingListField();
        $result = $field->setTag($tag);

        $this->assertInstanceOf(MailingListField::class, $result);
        $this->assertSame($tag, $field->getTag());
    }

    public function testGetType(): void
    {
        $type = MailingListField::NUMBER;
        $field = (new MailingListField())->setType($type);

        $this->assertSame($type, $field->getType());
    }

    public function testSetType(): void
    {
        $type = MailingListField::NUMBER;
        $field = new MailingListField();
        $result = $field->setType($type);

        $this->assertInstanceOf(MailingListField::class, $result);
        $this->assertSame($type, $field->getType());
    }

    public function testGetLabel(): void
    {
        $label = 'Field Label';
        $field = (new MailingListField())->setLabel($label);

        $this->assertSame($label, $field->getLabel());
    }

    public function testSetLabel(): void
    {
        $label = 'Field Label';
        $field = new MailingListField();
        $result = $field->setLabel($label);

        $this->assertInstanceOf(MailingListField::class, $result);
        $this->assertSame($label, $field->getLabel());
    }

    public function testGetFallback(): void
    {
        $fallback = 'Fallback Value';
        $field = (new MailingListField())->setFallback($fallback);

        $this->assertSame($fallback, $field->getFallback());
    }

    public function testSetFallback(): void
    {
        $fallback = 'Fallback Value';
        $field = new MailingListField();
        $result = $field->setFallback($fallback);

        $this->assertInstanceOf(MailingListField::class, $result);
        $this->assertSame($fallback, $field->getFallback());
    }
}
