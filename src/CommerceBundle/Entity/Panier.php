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
     * @ORM\Column(name="information", type="text")
     */
    private $information;
    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

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
     *
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\User" )
     */
    private $user;



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




    /**
     * Set information
     *
     * @param string $information
     *
     * @return Panier
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Panier
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set user
     *
     * @param \AdminBundle\Entity\User $user
     *
     * @return Panier
     */
    public function setUser(\AdminBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AdminBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
