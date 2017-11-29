<?php

namespace ScfLib\Tms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Currency
 * @ORM\Entity
 * @ORM\Table(name="currency",uniqueConstraints={
 *     @ORM\UniqueConstraint(name="un_currency_currency_iso",columns={"currency_iso"})
 * })
 */
class Currency
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", unique=true, nullable=false, name="id")
     * @var integer
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="currency_iso", nullable=false)
     */
    protected $currencyIso;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCurrencyIso()
    {
        return $this->currencyIso;
    }

    /**
     * @param string $currencyIso
     * @return Currency
     */
    public function setCurrencyIso($currencyIso)
    {
        $this->currencyIso = $currencyIso;
        return $this;
    }
}