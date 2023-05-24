<?php
declare(strict_types=1);

namespace Ideneal\EmailOctopus\Tests\Entity;

use Ideneal\EmailOctopus\Entity\Campaign;
use PHPUnit\Framework\TestCase;

final class CampaignTest extends TestCase
{
    public function testGetId(): void
    {
        $campaign = new Campaign();
        $campaign->setId('123');

        $this->assertSame('123', $campaign->getId());
    }

    public function testSetId(): void
    {
        $campaign = new Campaign();
        $result = $campaign->setId('123');

        $this->assertInstanceOf(Campaign::class, $result);
        $this->assertSame('123', $campaign->getId());
    }

    public function testGetStatus(): void
    {
        $campaign = new Campaign();
        $campaign->setStatus(Campaign::STATUS_DRAFT);

        $this->assertSame(Campaign::STATUS_DRAFT, $campaign->getStatus());
    }

    public function testSetStatus(): void
    {
        $campaign = new Campaign();
        $result = $campaign->setStatus(Campaign::STATUS_DRAFT);

        $this->assertInstanceOf(Campaign::class, $result);
        $this->assertSame(Campaign::STATUS_DRAFT, $campaign->getStatus());
    }

    public function testSetName(): void
    {
        $campaign = new Campaign();
        $result = $campaign->setName('Campaign Name');

        $this->assertInstanceOf(Campaign::class, $result);
        $this->assertSame('Campaign Name', $campaign->getName());
    }

    public function testSetSubject(): void
    {
        $campaign = new Campaign();
        $result = $campaign->setSubject('Campaign Subject');

        $this->assertInstanceOf(Campaign::class, $result);
        $this->assertSame('Campaign Subject', $campaign->getSubject());
    }

    public function testSetTo(): void
    {
        $campaign = new Campaign();
        $result = $campaign->setTo(['email1@example.com', 'email2@example.com']);

        $this->assertInstanceOf(Campaign::class, $result);
        $this->assertSame(['email1@example.com', 'email2@example.com'], $campaign->getTo());
    }

    public function testSetFrom(): void
    {
        $campaign = new Campaign();
        $result = $campaign->setFrom(['from@example.com']);

        $this->assertInstanceOf(Campaign::class, $result);
        $this->assertSame(['from@example.com'], $campaign->getFrom());
    }

    public function testSetContent(): void
    {
        $campaign = new Campaign();
        $result = $campaign->setContent(['content1', 'content2']);

        $this->assertInstanceOf(Campaign::class, $result);
        $this->assertSame(['content1', 'content2'], $campaign->getContent());
    }

    public function testSetCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $campaign = new Campaign();
        $result = $campaign->setCreatedAt($createdAt);

        $this->assertInstanceOf(Campaign::class, $result);
        $this->assertSame($createdAt, $campaign->getCreatedAt());
    }

    public function testSetSentAt(): void
    {
        $sentAt = new \DateTimeImmutable();
        $campaign = new Campaign();
        $result = $campaign->setSentAt($sentAt);

        $this->assertInstanceOf(Campaign::class, $result);
        $this->assertSame($sentAt, $campaign->getSentAt());
    }
}
