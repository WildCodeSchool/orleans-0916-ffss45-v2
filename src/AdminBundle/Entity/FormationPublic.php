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
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="formationPublics")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $category;


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
     * Set category
     *
     * @param \AdminBundle\Entity\Categorie $category
     *
     * @return FormationPublic
     */
    public function setCategory(\AdminBundle\Entity\Categorie $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AdminBundle\Entity\Categorie
     */
    public function getCategory()
    {
        return $this->category;
    }
}
