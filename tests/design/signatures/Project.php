<?php

namespace PhpUnitWorkshopTest\design\signatures;

class Project
{
    private int $id;
    private string $code;
    private string $name;
    private string $description;

    private string $poEmail;
    private string $poPhone;
    private string $startDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Project
    {
        $this->id = $id;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Project
    {
        $this->code = $code;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Project
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Project
    {
        $this->description = $description;
        return $this;
    }

    public function getPoEmail(): string
    {
        return $this->poEmail;
    }

    public function setPoEmail(string $poEmail): Project
    {
        $this->poEmail = $poEmail;
        return $this;
    }

    public function getPoPhone(): string
    {
        return $this->poPhone;
    }

    public function setPoPhone(string $poPhone): Project
    {
        $this->poPhone = $poPhone;
        return $this;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): Project
    {
        $this->startDate = $startDate;
        return $this;
    }
    // + 10 more fields


}

