<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormationPublic
 *
 * @ORM\Table(name="formation_public")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\FormationPublicRepository")
 */
class FormationPublic
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
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="formations")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;


    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
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
     * Set type
     *
     * @param string $type
     *
     * @return FormationPublic
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set categorie
     *
     * @param \AdminBundle\Entity\Categorie $categorie
     *
     * @return FormationPublic
     */
    public function setCategorie(\AdminBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AdminBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
