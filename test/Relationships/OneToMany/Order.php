<?php

namespace Relationships\OneToMany;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 **/
class Order
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var DateTime $name
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @var string $customerEmail
     * @ORM\Column(type="string")
     */
    private $customerEmail;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="LineItem", mappedBy="order", cascade={"all"}, orphanRemoval=true)
     */
    private $lineItems;


    function __construct(
        string $customerEmail
    ) {
        $this->createdDate = new \DateTime;
        $this->lineItems = new ArrayCollection;
        $this->customerEmail = $customerEmail;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function addLineItem(
        string $name,
        int $quantity,
        string $amount

    ): void {
        $lineItem = new LineItem($this, $name, $quantity, $amount);
        $this->lineItems->add($lineItem);
    }

    public function removeLineItem(LineItem $lineItem): void
    {
        $this->lineItems->removeElement($lineItem);
    }

    public function getLineItems(): Collection
    {
        return $this->lineItems;
    }

    /**
     * @param Collection|LineItem[] $lineItems
     */
    public function setLineItems(Collection $lineItems): void
    {
        $this->lineItems = $lineItems;
    }

    /**
     * @return DateTime
     */
    public function getCreatedDate(): DateTime
    {
        return $this->createdDate;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    /**
     * @param string $customerEmail
     */
    public function setCustomerEmail(string $customerEmail): void
    {
        $this->customerEmail = $customerEmail;
    }
}