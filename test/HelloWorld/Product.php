<?php
namespace HelloWorld;
use Doctrine\ORM\Mapping as ORM;
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