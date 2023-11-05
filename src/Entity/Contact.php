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
 * Class Contact
 *
 * @package Ideneal\EmailOctopus\Entity
 */
class Contact
{
    public const STATUS_SUBSCRIBED = 'SUBSCRIBED';
    public const STATUS_UNSUBSCRIBED = 'UNSUBSCRIBED';
    public const STATUS_PENDING = 'PENDING';

    private string $id;
    private string $email;
    private array $fields = [];
    private ?string $status = null;
    private array $tags = [];
    private \DateTimeInterface $createdAt;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->fields['FirstName'] ?? null;
    }

    public function setFirstName(string $firstName): self
    {
        $this->addField('FirstName', $firstName);
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->fields['LastName'] ?? null;
    }

    public function setLastName(string $lastName): self
    {
        $this->addField('LastName', $lastName);
        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setFields(array $fields): self
    {
        $this->fields = $fields;
        return $this;
    }

    public function addField(string $key, string $value): self
    {
        $this->fields[$key] = $value;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status ?? '';
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
            self::STATUS_PENDING,
            self::STATUS_SUBSCRIBED,
            self::STATUS_UNSUBSCRIBED,
        ], true);
    }

    public function getTags(string $callerInfo="createContact"): array
    {
        $newTags = [];
        array_walk(
            $this->tags,
            function($val, $key) use (&$newTags)
            {
                if(is_numeric($key)) {
                    $newTags[$val] = true;
                    return;
                }
                
                $newTags[$key] = $val;
            }
        );
        return (in_array($callerInfo, ["createContact","testSerialization"]))?array_keys($newTags,true):$newTags;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    public function addTag(string $key): self
    {
        if( !in_array($key, $this->tags) ){
            $this->tags[] = $key;
        }
        return $this;
    }

    public function removeTag(string $key): self
    {
        while (($index = array_search($key, $this->tags)) !== false)
        {
            unset($this->tags[$index]);
        }
        $this->tags[$key] = false;
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
