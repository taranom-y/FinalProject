<?php

namespace App\Entity;

use App\Model\TimeLoggerInterface;
use App\Model\TimeLoggerTrait;
use App\Model\UserLoggerInterface;
use App\Model\UserLoggerTrait;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;


#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[Gedmo\SoftDeleteable(fieldName:"deletedAt")]
#[Vich\Uploadable]
/**
 * InheritanceType("SINGLE_TABLE")
 * DiscriminatorColumn(name="type", type="string")
 * DiscriminatorMap({"planner" = "Planner", "paper" = "Paper","product"="Product"})
 */
class Product implements TimeLoggerInterface,UserLoggerInterface
{
    use TimeLoggerTrait;
    use UserLoggerTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    protected ?string $name = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    protected ?int $price = null;

    #[ORM\Column(length: 255)]
    protected ?string $description =null;

    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $image = null;

    #[ORM\Column(nullable: true)]
    #[Vich\UploadableField(mapping:"product",fileNameProperty: "image")]
    protected ?File $imageFile = null;


    #[ORM\Column(type:"datetime",nullable:true)]
    protected $deletedAt;

    #[ORM\ManyToMany(targetEntity: Order::class, mappedBy: 'product')]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }


    public function setDeletedAt($deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->addProduct($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            $order->removeProduct($this);
        }

        return $this;
    }

    public function isTypeOf($type){
        return match ($type) {
            'planner' => $this instanceof Planner,
            'paper' => $this instanceof Paper,
            default => throw new \RuntimeException('The type is invalid' . $type),
        };
    }


}
