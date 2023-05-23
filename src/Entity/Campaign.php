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
    const STATUS_DRAFT   = 'DRAFT';
    const STATUS_SENDING = 'SENDING';
    const STATUS_SENT    = 'SENT';
    const STATUS_ERROR   = 'ERROR';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var array
     */
    private $to;

    /**
     * @var array
     */
    private $from;

    /**
     * @var array
     */
    private $content;

    /**
     * @var \DateTimeInterface
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface
     */
    private $sentAt;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Campaign
     */
    public function setId(string $id): Campaign
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Campaign
     */
    public function setStatus(string $status): Campaign
    {
        if (in_array($status, [
            self::STATUS_DRAFT,
            self::STATUS_SENDING,
            self::STATUS_SENT,
            self::STATUS_ERROR,
        ])) {
            $this->status = $status;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Campaign
     */
    public function setName(string $name): Campaign
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return Campaign
     */
    public function setSubject(string $subject): Campaign
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return array
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @param array $to
     *
     * @return Campaign
     */
    public function setTo(array $to): Campaign
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return array
     */
    public function getFrom(): array
    {
        return $this->from;
    }

    /**
     * @param array $from
     *
     * @return Campaign
     */
    public function setFrom(array $from): Campaign
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @param array $content
     *
     * @return Campaign
     */
    public function setContent(array $content): Campaign
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return Campaign
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Campaign
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getSentAt(): \DateTimeInterface
    {
        return $this->sentAt;
    }

    /**
     * @param \DateTimeInterface $sentAt
     *
     * @return Campaign
     */
    public function setSentAt(\DateTimeInterface $sentAt): Campaign
    {
        $this->sentAt = $sentAt;
        return $this;
    }
}