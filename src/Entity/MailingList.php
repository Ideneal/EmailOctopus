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
 * Class MailingList
 *
 * @package Ideneal\EmailOctopus\Entity
 */
class MailingList
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $doubleOptIn;

    /**
     * @var MailingListField[]
     */
    private $fields = [];

    /**
     * @var array
     */
    private $counts = [];

    /**
     * @var \DateTimeInterface
     */
    private $createdAt;

    /**
     * MailingList constructor.
     */
    public function __construct()
    {
        $this->doubleOptIn = false;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return MailingList
     */
    public function setId(string $id): MailingList
    {
        $this->id = $id;
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
     * @return MailingList
     */
    public function setName(string $name): MailingList
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDoubleOptIn(): bool
    {
        return $this->doubleOptIn;
    }

    /**
     * @param bool $doubleOptIn
     * @return MailingList
     */
    public function setDoubleOptIn(bool $doubleOptIn): MailingList
    {
        $this->doubleOptIn = $doubleOptIn;
        return $this;
    }

    /**
     * @return MailingListField[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param MailingListField[] $fields
     * @return MailingList
     */
    public function setFields(array $fields): MailingList
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param MailingListField $field
     * @return $this
     */
    public function addField(MailingListField $field): MailingList
    {
        $this->fields[] = $field;
        return $this;
    }

    /**
     * @return array
     */
    public function getCounts(): array
    {
        return $this->counts;
    }

    /**
     * @param array $counts
     * @return MailingList
     */
    public function setCounts(array $counts): MailingList
    {
        $this->counts = $counts;
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
     * @return MailingList
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): MailingList
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}