<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\FormationRepository")

 */
class Formation
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
     * @ORM\Column(name="nom_long", type="string", length=255)

     * @ORM\ManyToOne(targetEntity="Agenda", inversedBy="typeFormation")
     * @ORM\JoinColumn(name="nomLong_id", referencedColumnName="id")
     */
    private $nomLong;

    /**
     * @var string
     * @ORM\Column(name="nom_court", type="string", length=255)
     */
    private $nomCourt;

    /**
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="nomCategorie")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;

    /**
     * @var text
     *
     * @ORM\Column(name="descriptif", type="text")
     */
    private $descriptif;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomLong
     *
     * @param string $nomLong
     * @return Formation
     */
    public function setNomLong($nomLong)
    {
        $this->nomLong = $nomLong;

        return $this;
    }

    /**
     * Get nomLong
     *
     * @return string 
     */
    public function getNomLong()
    {
        return $this->nomLong;
    }

    /**
     * Set nomCourt
     *
     * @param string $nomCourt
     * @return Formation
     */
    public function setNomCourt($nomCourt)
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    /**
     * Get nomCourt
     *
     * @return string 
     */
    public function getNomCourt()
    {
        return $this->nomCourt;
    }

    /**
     * Set categories_id
     *
     * @param string $categorie
     * @return Formation
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie_Id()
    {
        return $this->categorie;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     * @return Formation
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string 
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }
}
