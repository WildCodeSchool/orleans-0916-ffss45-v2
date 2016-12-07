<?php
// src/AppBundle/Entity/User.php

namespace AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

	/**
	 * @ORM\OneToMany(targetEntity="CommerceBundle\Entity\Reservations", mappedBy="user")
	 *
	 */
	private $reservations;

	/**
	 * @ORM\OneToMany(targetEntity="CommerceBundle\Entity\Upload", mappedBy="user")
	 *
	 */
	private $uploads;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="nom", type="string", length=45)
	 */
	private $nom;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="prenom", type="string", length=45)
	 */
	private $prenom;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="age", type="integer", length=45)
	 */
	private $age;

	/**
	 * @var date
	 *
	 * @ORM\Column(name="date_naissance", type="date", length=45)
	 */
	private $date_naissance;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="lieu_naissance", type="string", length=45)
	 */
	private $lieu_naissance;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="departement_naissance", type="string", length=45)
	 */
	private $departement_naissance;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="adresse", type="string", length=45)
	 */
	private $adresse;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="code_postal", type="integer", length=45)
	 */
	private $code_postal;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ville", type="string", length=45)
	 */
	private $ville;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="tel", type="integer", length=45)
	 */
	private $tel;

	/**
	 * @var text
	 *
	 * @ORM\Column(name="relation", type="text", length=45)
	 */
	private $relation;

	/**
	 * @return int
	 */
	public function getAge(): int
	{
		return $this->age;
	}

	/**
	 * @param int $age
	 */
	public function setAge(int $age)
	{
		$this->age = $age;
	}

	/**
	 * @return string
	 */
	public function getLieuNaissance(): string
	{
		return $this->lieu_naissance;
	}

	/**
	 * @param string $lieu_naissance
	 */
	public function setLieuNaissance(string $lieu_naissance)
	{
		$this->lieu_naissance = $lieu_naissance;
	}

	/**
	 * @return string
	 */
	public function getAdresse(): string
	{
		return $this->adresse;
	}

	/**
	 * @param string $adresse
	 */
	public function setAdresse(string $adresse)
	{
		$this->adresse = $adresse;
	}

	/**
	 * @return int
	 */
	public function getCodePostal(): int
	{
		return $this->code_postal;
	}

	/**
	 * @param int $code_postal
	 */
	public function setCodePostal(int $code_postal)
	{
		$this->code_postal = $code_postal;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return date
	 */
	public function getDateNaissance(): date
	{
		return $this->date_naissance;
	}

	/**
	 * @param date $date_naissance
	 */
	public function setDateNaissance(date $date_naissance)
	{
		$this->date_naissance = $date_naissance;
	}

	/**
	 * @return string
	 */
	public function getDepartementNaissance(): string
	{
		return $this->departement_naissance;
	}

	/**
	 * @param string $departement_naissance
	 */
	public function setDepartementNaissance(string $departement_naissance)
	{
		$this->departement_naissance = $departement_naissance;
	}

	/**
	 * @return string
	 */
	public function getNom(): string
	{
		return $this->nom;
	}

	/**
	 * @param string $nom
	 */
	public function setNom(string $nom)
	{
		$this->nom = $nom;
	}

	/**
	 * @return mixed
	 */
	public function getReservations()
	{
		return $this->reservations;
	}

	/**
	 * @param mixed $reservations
	 */
	public function setReservations($reservations)
	{
		$this->reservations = $reservations;
	}

	/**
	 * @return mixed
	 */
	public function getUploads()
	{
		return $this->uploads;
	}

	/**
	 * @param mixed $uploads
	 */
	public function setUploads($uploads)
	{
		$this->uploads = $uploads;
	}

	/**
	 * @return string
	 */
	public function getPrenom(): string
	{
		return $this->prenom;
	}

	/**
	 * @param string $prenom
	 */
	public function setPrenom(string $prenom)
	{
		$this->prenom = $prenom;
	}

	/**
	 * @return text
	 */
	public function getRelation(): text
	{
		return $this->relation;
	}

	/**
	 * @param text $relation
	 */
	public function setRelation(text $relation)
	{
		$this->relation = $relation;
	}

	/**
	 * @return string
	 */
	public function getVille(): string
	{
		return $this->ville;
	}

	/**
	 * @param string $ville
	 */
	public function setVille(string $ville)
	{
		$this->ville = $ville;
	}

	/**
	 * @return int
	 */
	public function getTel(): int
	{
		return $this->tel;
	}

	/**
	 * @param int $tel
	 */
	public function setTel(int $tel)
	{
		$this->tel = $tel;
	}


}

