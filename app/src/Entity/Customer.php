<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer extends Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Product::class)]
    private $orders;

    #[ORM\ManyToOne(targetEntity: Partner::class, inversedBy: 'customers')]
    #[ORM\JoinColumn(nullable: false)]
    private $reseller;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Product $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Product $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
            }
        }

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
