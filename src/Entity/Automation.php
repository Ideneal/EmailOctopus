<?php
declare(strict_types=1);

namespace Ideneal\EmailOctopus\Entity;

final class Automation
{
    private string $id;

    private string $listMemberId;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getListMemberId(): string
    {
        return $this->listMemberId;
    }

    public function setListMemberId(string $listMemberId): self
    {
        $this->listMemberId = $listMemberId;
        return $this;
    }
}