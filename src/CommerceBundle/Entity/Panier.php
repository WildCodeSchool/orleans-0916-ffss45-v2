<?php

namespace CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="CommerceBundle\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroReservation", type="string", length=255)
     */
    private $numeroReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="json", type="text")
     */
    private $json;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numeroReservation
     *
     * @param string $numeroReservation
     *
     * @return Panier
     */
    public function setNumeroReservation($numeroReservation)
    {
        $this->numeroReservation = $numeroReservation;

        return $this;
    }

    /**
     * Get numeroReservation
     *
     * @return string
     */
    public function getNumeroReservation()
    {
        return $this->numeroReservation;
    }

    /**
     * Set json
     *
     * @param string $json
     *
     * @return Panier
     */
    public function setJson($json)
    {
        $this->json = $json;

        return $this;
    }

    /**
     * Get json
     *
     * @return string
     */
    public function getJson()
    {
        return $this->json;
    }
}

