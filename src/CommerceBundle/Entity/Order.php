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
    private $livraison;

    /**
     * @var
     *
     */
//    private $inscrits;

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
     * @return mixed
     */
    public function getLivraison()
    {
        return $this->livraison;
    }

    /**
     * @param mixed $livraison
     */
    public function setLivraison($livraison)
    {
        $this->livraison = $livraison;
    }

    
//    /**
//     * @return mixed
//     */
//    public function getInscrits()
//    {
//        return $this->inscrits;
//    }
//
//    /**
//     * @param mixed $inscrits
//     */
//    public function setInscrits($inscrits)
//    {
//        $this->inscrits = $inscrits;
//    }





}