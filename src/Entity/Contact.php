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
    const STATUS_SUBSCRIBED   = 'SUBSCRIBED';
    const STATUS_UNSUBSCRIBED = 'UNSUBSCRIBED';
    const STATUS_PENDING      = 'PENDING';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTimeInterface
     */
    private $createdAt;

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
     * @return Contact
     */
    public function setId(string $id): Contact
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail(string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return isset($this->fields['FirstName']) ? $this->fields['FirstName'] : null;
    }

    /**
     * @param string $firstName
     *
     * @return Contact
     */
    public function setFirstName(string $firstName): Contact
    {
        return $this->addField('FirstName', $firstName);
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return isset($this->fields['LastName']) ? $this->fields['LastName'] : null;
    }

    /**
     * @param string $lastName
     *
     * @return Contact
     */
    public function setLastName(string $lastName): Contact
    {
        return $this->addField('LastName', $lastName);
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     *
     * @return Contact
     */
    public function setFields(array $fields): Contact
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function addField(string $key, string $value): Contact
    {
        $this->fields[$key] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status ? $this->status : '';
    }

    /**
     * @param string $status
     *
     * @return Contact
     */
    public function setStatus(string $status): Contact
    {
        if (in_array($status, [
            self::STATUS_PENDING,
            self::STATUS_SUBSCRIBED,
            self::STATUS_UNSUBSCRIBED,
        ])) {
            $this->status = $status;
        }
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
     * @return Contact
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Contact
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
