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
    private string $id;
    private string $name;
    private bool $doubleOptIn;
    /**
     * @var MailingListField[]
     */
    private array $fields = [];
    private array $counts = [];
    private \DateTimeInterface $createdAt;

    public function __construct()
    {
        $this->doubleOptIn = false;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
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

    public function isDoubleOptIn(): bool
    {
        return $this->doubleOptIn;
    }

    public function setDoubleOptIn(bool $doubleOptIn): self
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
     */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;
        return $this;
    }

    public function addField(MailingListField $field): self
    {
        $this->fields[] = $field;
        return $this;
    }

    public function getCounts(): array
    {
        return $this->counts;
    }

    public function setCounts(array $counts): self
    {
        $this->counts = $counts;
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
}
