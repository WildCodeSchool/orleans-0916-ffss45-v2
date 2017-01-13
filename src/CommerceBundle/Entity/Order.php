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