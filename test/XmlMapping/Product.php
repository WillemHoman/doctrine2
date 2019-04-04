<?php

namespace XmlMapping;

class Product
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    private $sku;

    public function __construct(
        string $name,
        string $sku
    )
    {
        $this->name = $name;
        $this->sku = $sku;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }
}