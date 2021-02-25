<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payments
 *
 * @ORM\Table(name="payments", indexes={@ORM\Index(name="IDX_65D29B32D53183C5", columns={"customerNumber"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PaymentsRepository")
 */
class Payments
{
    /**
     * @var string
     *
     * @ORM\Column(name="checkNumber", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $checknumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="paymentDate", type="date", nullable=false)
     */
    private $paymentdate;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $amount;

    /**
     * @var \Customers
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Customers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customerNumber", referencedColumnName="customerNumber")
     * })
     */
    private $customernumber;

    public function getChecknumber(): ?string
    {
        return $this->checknumber;
    }

    public function getPaymentdate(): ?\DateTimeInterface
    {
        return $this->paymentdate;
    }

    public function setPaymentdate(\DateTimeInterface $paymentdate): self
    {
        $this->paymentdate = $paymentdate;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCustomernumber(): ?Customers
    {
        return $this->customernumber;
    }

    public function setCustomernumber(?Customers $customernumber): self
    {
        $this->customernumber = $customernumber;

        return $this;
    }


}
