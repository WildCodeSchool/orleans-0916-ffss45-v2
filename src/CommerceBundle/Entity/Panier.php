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
     * @return string
     */
    public function getPosteDeSecours()
    {
        return $this->posteDeSecours;
    }

    /**
     * @param string $posteDeSecours
     */
    public function setPosteDeSecours($posteDeSecours)
    {
        $this->posteDeSecours = $posteDeSecours;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="json", type="text")
     */
    private $json;

    /**
     * @var string
     *
     * @ORM\Column(name="poste_secours", type="string", nullable = true)
     */
    private $posteDeSecours;

    /**
     * @var int
     *
     * @ORM\Column(name="paid", type="boolean", nullable = true)
     */
    private $paid;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable = true)
     */
    private $type;



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

    /**
     * @return int
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * @param int $paid
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }



}

