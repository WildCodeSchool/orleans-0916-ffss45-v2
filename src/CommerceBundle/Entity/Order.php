<?php

namespace CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AdminBundle\Entity\User;

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
     * @var
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
    public function setNom(User $nom)
    {
        $this->nom = $nom;
    }

}