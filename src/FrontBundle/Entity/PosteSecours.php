<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosteSecours
 *
 * @ORM\Table(name="poste_secours")
 * @ORM\Entity(repositoryClass="FrontBundle\Repository\PosteSecoursRepository")
 */
class PosteSecours
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
     * @ORM\Column(name="nomManif", type="string", length=255)
     */
    private $nomManif;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionManif", type="text")
     */
    private $descriptionManif;

    /**
     * @var string
     *
     * @ORM\Column(name="typeManif", type="string", length=255)
     */
    private $typeManif;

    /**
     * @var string
     *
     * @ORM\Column(name="typeManifSportive", type="string", length=255)
     */
    private $typeManifSportive;

    /**
     * @var int
     *
     * @ORM\Column(name="taillePiscine", type="integer")
     */
    private $taillePiscine;

    /**
     * @var string
     *
     * @ORM\Column(name="tailleStade", type="string", length=255)
     */
    private $tailleStade;

    /**
     * @var int
     *
     * @ORM\Column(name="nbScene", type="integer")
     */
    private $nbScene;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text")
     */
    private $commentaire;


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
     * Set nomManif
     *
     * @param string $nomManif
     * @return PosteTravail
     */
    public function setNomManif($nomManif)
    {
        $this->nomManif = $nomManif;

        return $this;
    }

    /**
     * Get nomManif
     *
     * @return string 
     */
    public function getNomManif()
    {
        return $this->nomManif;
    }

    /**
     * Set descriptionManif
     *
     * @param string $descriptionManif
     * @return PosteTravail
     */
    public function setDescriptionManif($descriptionManif)
    {
        $this->descriptionManif = $descriptionManif;

        return $this;
    }

    /**
     * Get descriptionManif
     *
     * @return string 
     */
    public function getDescriptionManif()
    {
        return $this->descriptionManif;
    }

    /**
     * Set typeManif
     *
     * @param string $typeManif
     * @return PosteTravail
     */
    public function setTypeManif($typeManif)
    {
        $this->typeManif = $typeManif;

        return $this;
    }

    /**
     * Get typeManif
     *
     * @return string 
     */
    public function getTypeManif()
    {
        return $this->typeManif;
    }

    /**
     * Set typeManifSportive
     *
     * @param string $typeManifSportive
     * @return PosteTravail
     */
    public function setTypeManifSportive($typeManifSportive)
    {
        $this->typeManifSportive = $typeManifSportive;

        return $this;
    }

    /**
     * Get typeManifSportive
     *
     * @return string 
     */
    public function getTypeManifSportive()
    {
        return $this->typeManifSportive;
    }

    /**
     * Set taillePiscine
     *
     * @param integer $taillePiscine
     * @return PosteTravail
     */
    public function setTaillePiscine($taillePiscine)
    {
        $this->taillePiscine = $taillePiscine;

        return $this;
    }

    /**
     * Get taillePiscine
     *
     * @return integer 
     */
    public function getTaillePiscine()
    {
        return $this->taillePiscine;
    }

    /**
     * Set tailleStade
     *
     * @param string $tailleStade
     * @return PosteTravail
     */
    public function setTailleStade($tailleStade)
    {
        $this->tailleStade = $tailleStade;

        return $this;
    }

    /**
     * Get tailleStade
     *
     * @return string 
     */
    public function getTailleStade()
    {
        return $this->tailleStade;
    }

    /**
     * Set nbScene
     *
     * @param integer $nbScene
     * @return PosteTravail
     */
    public function setNbScene($nbScene)
    {
        $this->nbScene = $nbScene;

        return $this;
    }

    /**
     * Get nbScene
     *
     * @return integer 
     */
    public function getNbScene()
    {
        return $this->nbScene;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return PosteTravail
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
}
