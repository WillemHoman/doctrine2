<?php

namespace Relationships\OneToMany\UniDirectional;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Relationships\OneToMany\UniDirectional\OrderRepository")
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
     * The following annotations define a one to many unidirectional relationship between Order and LineItems
     * To make it unidirectional, there must be a many to many relationship implemented by join table with a uniqueness constraint on one of the join columns.
     * If the last sentence made your head spin a bit, read on and run the example...
     * Or better yet run the example, look at the tables and data and then read on.
     *
     * Order, LineItem refer to the PHP instances of these classes in memory
     * order, lineitem, order_lineitem are the corresponding database tables
     *
     * Without a join table, it is possible to create a many to one unidirectional relationship. see Relationships\ManyToOne
     * However, it is impossible to create a one to many unidirectional relationship.
     * This is because, without the join table, the lineitem table must have the order_id foreign key referencing the order table.
     * This makes it the "owning side" as per the doctrine manual.
     *
     * lineitem table: one to many without join table
     *
     * lineitem_id | order_id | name       | quantity | etc
     * 1           | 1        | Hat        |
     * 2           | 1        | Shoes      |
     * 3           | 2        | Football   |
     * 4           | 2        | Sunglasses |
     *
     * This means that when doctrine goes to persist the LineItem, it must have
     * a reference back to the Order so it can grab the Order::id to populate the order_id column with.
     *
     * This is not how we would normally model the Order/LineItem relationship as we would prefer Order to have a
     * dependency on LineItem but not vice-versa.
     *
     * Such a unidirectional relationship is achieved by using a many to many table with a with uniqueness constraint on the lineitem_id.
     * This means that for every lineitem there may only be one order, but every order may have multiple lineitems.
     * Or in more general terms, there is a m:n relationship, where for every n there may be only a single m, thus enforcing the 1:n relationship
     *
     * order_lineitem: many to many join table
     *
     * order_id | lineitem_id
     * 1        | 1
     * 1        | 2
     * 2        | 3
     * 2        | 4
     *
     * If the uniqueness constraint on lineitem_id was removed, the following row could be inserted
     * order_id | lineitem_id
     * 2        | 1
     *
     * This would be result in a many to many relationship as orders would have many lineitems, and lineitem with id 1 would belong to both orders.
     *
     * One-To-Many, Bidirectional
     * https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/association-mapping.html#one-to-many-bidirectional
     *
     * One-To-Many, Unidirectional with Join Table
     * https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/association-mapping.html#one-to-many-unidirectional-with-join-table
     *
     * @var Collection|LineItem[]
     * @ORM\ManyToMany(targetEntity="LineItem", cascade="persist")
     * @ORM\JoinTable(name="order_lineitems",
     *      joinColumns={@ORM\JoinColumn(name="order_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="lineitem_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $lineItems;


    public function __construct(
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
        $lineItem = new LineItem($name, $quantity, $amount);
        $this->lineItems->add($lineItem);
    }

    /**
     * @return LineItem[]|Collection
     */
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