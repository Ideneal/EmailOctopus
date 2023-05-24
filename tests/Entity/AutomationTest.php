<?php
declare(strict_types=1);

namespace Ideneal\EmailOctopus\Tests\Entity;

use Ideneal\EmailOctopus\Entity\Automation;
use PHPUnit\Framework\TestCase;

final class AutomationTest extends TestCase
{
    public function testGetId(): void
    {
        $automation = new Automation();
        $automation->setId('123');

        $this->assertSame('123', $automation->getId());
    }

    public function testSetId(): void
    {
        $automation = new Automation();
        $result = $automation->setId('123');

        $this->assertInstanceOf(Automation::class, $result);
        $this->assertSame('123', $automation->getId());
    }

    public function testGetListMemberId(): void
    {
        $automation = new Automation();
        $automation->setListMemberId('456');

        $this->assertSame('456', $automation->getListMemberId());
    }

    public function testSetListMemberId(): void
    {
        $automation = new Automation();
        $result = $automation->setListMemberId('456');

        $this->assertInstanceOf(Automation::class, $result);
        $this->assertSame('456', $automation->getListMemberId());
    }
}