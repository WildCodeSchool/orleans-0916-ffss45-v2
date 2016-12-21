<?php

namespace CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organisme
 *
 */
class Order
{
    /**
     * @var int
     *
     */
    private $quantity;

    /**
     * @var int
     *
     */
    private $nom;

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param int $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

}