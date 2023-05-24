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
 * Class MailingListField
 *
 * @package Ideneal\EmailOctopus\Entity
 */
class MailingListField
{
    public const NUMBER = 'NUMBER';
    public const TEXT = 'TEXT';

    private string $tag;
    private string $type;
    private string $label;
    private ?string $fallback = null;

    public function __construct()
    {
        $this->type = self::TEXT;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        if ($this->isValidType($type)) {
            $this->type = $type;
        }
        return $this;
    }

    public function isValidType(string $type): bool
    {
        return \in_array($type, [self::NUMBER, self::TEXT], true);
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getFallback(): ?string
    {
        return $this->fallback;
    }

    public function setFallback(?string $fallback): self
    {
        $this->fallback = $fallback;
        return $this;
    }
}
