<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categories
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
     * @var string
     *
     * @ORM\Column(name="nom_categorie", type="string", length=255)
     */
    private $nomCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=7)
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity="Formation", mappedBy="categories")
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
     * Add formations
     *
     * @param \AdminBundle\Entity\Formation $formations
     * @return Categorie
     */
    public function addFormation(\AdminBundle\Entity\Formation $formations)
    {
        $this->formations[] = $formations;

        return $this;
    }

    /**
     * Remove formations
     *
     * @param \AdminBundle\Entity\Formation $formations
     */
    public function removeFormation(\AdminBundle\Entity\Formation $formations)
    {
        $this->formations->removeElement($formations);
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

    /**
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param string $couleur
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }
}
