<?php
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
    const NUMBER = 'NUMBER';
    const TEXT   = 'TEXT';

    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $fallback;

    /**
     * MailingListField constructor.
     */
    public function __construct()
    {
        $this->type = self::TEXT;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     *
     * @return MailingListField
     */
    public function setTag(string $tag): MailingListField
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return MailingListField
     */
    public function setType(string $type): MailingListField
    {
        if (in_array($type, [self::NUMBER, self::TEXT])) {
            $this->type = $type;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return MailingListField
     */
    public function setLabel(string $label): MailingListField
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getFallback(): ?string
    {
        return $this->fallback;
    }

    /**
     * @param string $fallback
     *
     * @return MailingListField
     */
    public function setFallback(?string $fallback): MailingListField
    {
        $this->fallback = $fallback;
        return $this;
    }
}