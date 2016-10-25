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
     * @ORM\Column(name="descriptionManif", type="text", nullable=true)
     */
    private $descriptionManif;

    /**
     * @var string
     *
     * @ORM\Column(name="typeManif", type="string", length=255, nullable=true)
     */
    private $typeManif;

    /**
     * @var string
     *
     * @ORM\Column(name="typeManifSportive", type="string", length=255, nullable=true)
     */
    private $typeManifSportive;

    /**
     * @var int
     *
     * @ORM\Column(name="taillePiscine", type="integer", nullable=true)
     */
    private $taillePiscine;

    /**
     * @var string
     *
     * @ORM\Column(name="tailleStade", type="string", length=255, nullable=true)
     */
    private $tailleStade;

    /**
     * @var int
     *
     * @ORM\Column(name="nbScene", type="integer", nullable=true)
     */
    private $nbScene;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
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
     * @return PosteSecours
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
     * @return PosteSecours
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
     * @return PosteSecours
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
     * @return PosteSecours
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
     * @return PosteSecours
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
     * @return PosteSecours
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
     * @return PosteSecours
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
     * @return PosteSecours
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
