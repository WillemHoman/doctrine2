<?php

namespace Relationships\OneToMany\UniDirectional;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 **/
class LineItem
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $productName;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $quantity;


    /**
     * @var string
     * @ORM\Column(type="decimal")
     */
    private $amount;

    public function __construct(
        string $name,
        int $quantity,
        string $amount
    )
    {
        $this->productName = $name;
        $this->quantity = $quantity;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }
}