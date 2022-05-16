<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('products')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]

    private string $modelName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('products')]
    private string $brand;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('products')]
    private string $operatingSystem;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('products')]
    private string $cpu;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('products')]
    private string $storage;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('products')]
    private string $screenSize;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('products')]
    private string $screenType;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('products')]
    private string $year;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2)]
    #[Groups('products')]
    private string $price;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'orders')]
    private Customer $customer;

    #[ORM\ManyToOne(targetEntity: Partner::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('partners')]
    private Partner $reseller;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModelName(): ?string
    {
        return $this->modelName;
    }

    public function setModelName(string $modelName): self
    {
        $this->modelName = $modelName;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getOperatingSystem(): ?string
    {
        return $this->operatingSystem;
    }

    public function setOperatingSystem(string $operatingSystem): self
    {
        $this->operatingSystem = $operatingSystem;

        return $this;
    }

    public function getCpu(): ?string
    {
        return $this->cpu;
    }

    public function setCpu(string $cpu): self
    {
        $this->cpu = $cpu;

        return $this;
    }

    public function getStorage(): ?string
    {
        return $this->storage;
    }

    public function setStorage(string $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function getScreenSize(): ?string
    {
        return $this->screenSize;
    }

    public function setScreenSize(string $screenSize): self
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    public function getScreenType(): ?string
    {
        return $this->screenType;
    }

    public function setScreenType(string $screenType): self
    {
        $this->screenType = $screenType;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getReseller(): ?Partner
    {
        return $this->reseller;
    }

    public function setReseller(?Partner $reseller): self
    {
        $this->reseller = $reseller;

        return $this;
    }
}
