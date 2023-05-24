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

namespace Ideneal\EmailOctopus\Entity;

/**
 * Class Campaign
 *
 * @package Ideneal\EmailOctopus\Entity
 */
class Campaign
{
    public const STATUS_DRAFT = 'DRAFT';
    public const STATUS_SENDING = 'SENDING';
    public const STATUS_SENT = 'SENT';
    public const STATUS_ERROR = 'ERROR';

    private string $id;
    private string $status;
    private string $name;
    private string $subject;
    /**
     * @var string[]
     */
    private array $to = [];
    /**
     * @var string[]
     */
    private array $from = [];
    /**
     * @var string[]
     */
    private array $content = [];
    private \DateTimeInterface $createdAt;
    private ?\DateTimeInterface $sentAt;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        if ($this->isValidStatus($status)) {
            $this->status = $status;
        }
        return $this;
    }

    public function isValidStatus(string $status): bool
    {
        return \in_array($status, [
            self::STATUS_DRAFT,
            self::STATUS_SENDING,
            self::STATUS_SENT,
            self::STATUS_ERROR,
        ], true);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function getTo(): array
    {
        return $this->to;
    }

    public function setTo(array $to): self
    {
        $this->to = $to;
        return $this;
    }

    public function getFrom(): array
    {
        return $this->from;
    }

    public function setFrom(array $from): self
    {
        $this->from = $from;
        return $this;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function setContent(array $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(?\DateTimeInterface $sentAt): self
    {
        $this->sentAt = $sentAt;
        return $this;
    }
}
