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
     * @ORM\OneToMany(targetEntity="Agenda", mappedBy="formation")
     */
    private $agendas;
    /**
     * @var string
     *
     * @ORM\Column(name="nom_long", type="string", length=255)page3
     */
    private $nomLong;


    /**
     * @var string
     * @ORM\Column(name="nom_court", type="string", length=255)
     */
    private $nomCourt;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="formations")
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
     * @var text
     *
     * @ORM\Column(name="publicVise", type="text")
     */
    private $publicVise;

    /**
     * @var text
     *
     * @ORM\Column(name="objectifVise", type="text")
     */
    private $objectifVise;

    /**
     * @var text
     *
     * @ORM\Column(name="dureeFormation", type="text")
     */
    private $dureeFormation;

    /**
     * @var text
     *
     * @ORM\Column(name="contenuFormation", type="text")
     */
    private $contenuFormation;

    /**
     * @var text
     *
     * @ORM\Column(name="methodePedagogique", type="text", nullable=true)
     */
    private $methodePedagogique;

    /**
     * @var text
     *
     * @ORM\Column(name="validation", type="text")
     */
    private $validation;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string")
     */
    private $photo;

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
     * Set categorie
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
    public function getCategorie()
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


    /**
     * @param mixed $agendas
     */
    public function setAgendas($agendas)
    {
        $this->agendas = $agendas;
    }

    /**
     * @return mixed
     */
    public function getAgendas()
    {
        return $this->agendas;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->agendas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add agenda
     *
     * @param \AdminBundle\Entity\Agenda $agenda
     *
     * @return Formation
     */
    public function addAgenda(\AdminBundle\Entity\Agenda $agenda)
    {
        $this->agendas[] = $agenda;

        return $this;
    }

    /**
     * Remove agenda
     *
     * @param \AdminBundle\Entity\Agenda $agenda
     */
    public function removeAgenda(\AdminBundle\Entity\Agenda $agenda)
    {
        $this->agendas->removeElement($agenda);
    }

    /**
     * @param text $publicVise
     */
    public function setPublicVise($publicVise)
    {
        $this->publicVise = $publicVise;
    }

    /**
     * @return text
     */
    public function getPublicVise()
    {
        return $this->publicVise;
    }

    /**
     * @return text
     */
    public function getObjectifVise()
    {
        return $this->objectifVise;
    }

    /**
     * @param text $objectifVise
     */
    public function setObjectifVise($objectifVise)
    {
        $this->objectifVise = $objectifVise;
    }

    /**
     * @param text $dureeFormation
     */
    public function setDureeFormation($dureeFormation)
    {
        $this->dureeFormation = $dureeFormation;
    }

    /**
     * @return text
     */
    public function getDureeFormation()
    {
        return $this->dureeFormation;
    }

    /**
     * @param text $contenuFormation
     */
    public function setContenuFormation($contenuFormation)
    {
        $this->contenuFormation = $contenuFormation;
    }

    /**
     * @return text
     */
    public function getContenuFormation()
    {
        return $this->contenuFormation;
    }

    /**
     * @param text $methodePedagogique
     */
    public function setMethodePedagogique($methodePedagogique)
    {
        $this->methodePedagogique = $methodePedagogique;
    }

    /**
     * @return text
     */
    public function getMethodePedagogique()
    {
        return $this->methodePedagogique;
    }

    /**
     * @param text $validation
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;
    }

    /**
     * @return text
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
}
