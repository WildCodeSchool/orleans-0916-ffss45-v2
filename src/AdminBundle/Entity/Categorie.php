<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\OneToMany(targetEntity="FormationPublic", mappedBy="formationPublics")
     */
    private $formationPublics;



    /**
     * @var string
     *
     * @ORM\Column(name="nom_categorie", type="string", length=255)
     */
    private $nomCategorie;

    /**
     * @ORM\OneToMany(targetEntity="Formation", mappedBy="categorie")
     */
    private $formations;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
    }

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
     * Set nomCategorie
     *
     * @param string $nomCategorie
     * @return Categorie
     */
    public function setNomCategorie($nomCategorie)
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * Get nomCategorie
     *
     * @return string 
     */
    public function getNomCategorie()
    {
        return $this->nomCategorie;
    }



    /**
     * Add formationPublic
     *
     * @param \AdminBundle\Entity\FormationPublic $formationPublic
     *
     * @return Categorie
     */
    public function addFormationPublic(\AdminBundle\Entity\FormationPublic $formationPublic)
    {
        $this->formationPublics[] = $formationPublic;

        return $this;
    }

    /**
     * Remove formationPublic
     *
     * @param \AdminBundle\Entity\FormationPublic $formationPublic
     */
    public function removeFormationPublic(\AdminBundle\Entity\FormationPublic $formationPublic)
    {
        $this->formationPublics->removeElement($formationPublic);
    }

    /**
     * Get formationPublics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormationPublics()
    {
        return $this->formationPublics;
    }

    /**
     * Add formation
     *
     * @param \AdminBundle\Entity\Formation $formation
     *
     * @return Categorie
     */
    public function addFormation(\AdminBundle\Entity\Formation $formation)
    {
        $this->formations[] = $formation;

        return $this;
    }

    /**
     * Remove formation
     *
     * @param \AdminBundle\Entity\Formation $formation
     */
    public function removeFormation(\AdminBundle\Entity\Formation $formation)
    {
        $this->formations->removeElement($formation);
    }

    /**
     * Get formations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormations()
    {
        return $this->formations;
    }
}
