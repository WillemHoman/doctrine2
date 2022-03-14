<?php
namespace HelloWorld;
use Doctrine\ORM\Mapping as ORM;
use PickupStatus;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 **/
class Product
{
    /**
     * @var int
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $sku;

    /**
     * @var PickupStatus
     * @ORM\Column(type="pickup_status")
     */
    private $pickupStatus;


    public function __construct(
        string $name,
        string $sku,
        PickupStatus $pickupStatus
    )
    {
        $this->name = $name;
        $this->sku = $sku;
        $this->pickupStatus = $pickupStatus;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getPickupStatus(): PickupStatus
    {
        return $this->pickupStatus;
    }
}