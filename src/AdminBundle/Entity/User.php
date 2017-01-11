<?php
// src/AppBundle/Entity/User.php

namespace AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
	 * @ORM\OneToMany(targetEntity="CommerceBundle\Entity\Reservation", mappedBy="user")
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
	 *
	 */
	private $nom;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="prenom", type="string", length=45)
	 */
	private $prenom;


	/**
	 * @var date
	 *
	 * @ORM\Column(name="date_naissance", type="date", nullable=true)
	 */
	private $date_naissance;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="lieu_naissance", type="string", length=45, nullable=true)
	 */
	private $lieu_naissance;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="departement_naissance", type="string", length=45, nullable=true)
	 */
	private $departement_naissance;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="adresse", type="string", length=45, nullable=true)
	 */
	private $adresse;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="code_postal", type="integer", length=45, nullable=true)
	 */
	private $code_postal;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ville", type="string", length=45, nullable=true))
	 */
	private $ville;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="tel", type="string", length=45, nullable=true)
	 */
	private $tel;

	/**
	 * @var text
	 *
	 * @ORM\Column(name="relation", type="text", length=45, nullable=true))
	 */
	private $relation;

//    /**
//     * @var integer
//     *
//     * @ORM\Column(name="ciRecto", type="string", length=255)
//     */
//    private $ciRecto;
//
//    /**
//     * @var integer
//     *
//     * @ORM\Column(name="ciVerso", type="string", length=255)
//     */
//    private $ciVerso;
//
//    /**
//     * @return int
//     */
//    public function getCiRecto()
//    {
//        return $this->ciRecto;
//    }
//
//    /**
//     * @param int $ciRecto
//     */
//    public function setCiRecto($ciRecto)
//    {
//        $this->ciRecto = $ciRecto;
//    }
//
//    /**
//     * @return int
//     */
//    public function getCiVerso()
//    {
//        return $this->ciVerso;
//    }
//
//    /**
//     * @param int $ciVerso
//     */
//    public function setCiVerso($ciVerso)
//    {
//        $this->ciVerso = $ciVerso;
//    }



	/**
	 * @return int
	 */


	/**
	 * @return string
	 */
	public function getLieuNaissance()
	{
		return $this->lieu_naissance;
	}

	/**
	 * @param string $lieu_naissance
	 */
	public function setLieuNaissance($lieu_naissance)
	{
		$this->lieu_naissance = $lieu_naissance;
	}

	/**
	 * @return string
	 */
	public function getAdresse()
	{
		return $this->adresse;
	}

	/**
	 * @param string $adresse
	 */
	public function setAdresse($adresse)
	{
		$this->adresse = $adresse;
	}

	/**
	 * @return int
	 */
	public function getCodePostal()
	{
		return $this->code_postal;
	}

	/**
	 * @param int $code_postal
	 */
	public function setCodePostal($code_postal)
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
	public function getDateNaissance()
	{
		return $this->date_naissance;
	}

	/**
	 * @param date $date_naissance
	 */
	public function setDateNaissance(\DateTime $date_naissance)
	{
		$this->date_naissance = $date_naissance;
	}

	/**
	 * @return string
	 */
	public function getDepartementNaissance()
	{
		return $this->departement_naissance;
	}

	/**
	 * @param string $departement_naissance
	 */
	public function setDepartementNaissance($departement_naissance)
	{
		$this->departement_naissance = $departement_naissance;
	}

	/**
	 * @return string
	 */
	public function getNom()
	{
		return $this->nom;
	}

	/**
	 * @param string $nom
	 */
	public function setNom($nom)
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
	public function getPrenom()
	{
		return $this->prenom;
	}

	/**
	 * @param string $prenom
	 */
	public function setPrenom($prenom)
	{
		$this->prenom = $prenom;
	}

	/**
	 * @return text
	 */
	public function getRelation()
	{
		return $this->relation;
	}

	/**
	 * @param text $relation
	 */
	public function setRelation($relation)
	{
		$this->relation = $relation;
	}

	/**
	 * @return string
	 */
	public function getVille()
	{
		return $this->ville;
	}

	/**
	 * @param string $ville
	 */
	public function setVille($ville)
	{
		$this->ville = $ville;
	}

	/**
	 * @return int
	 */
	public function getTel()
	{
		return $this->tel;
	}

	/**
	 * @param int $tel
	 */
	public function setTel($tel)
	{
		$this->tel = $tel;
	}








    /**
     * Add reservation
     *
     * @param \CommerceBundle\Entity\Reservation $reservation
     *
     * @return User
     */
    public function addReservation(\CommerceBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \CommerceBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\CommerceBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Add upload
     *
     * @param \CommerceBundle\Entity\Upload $upload
     *
     * @return User
     */
    public function addUpload(\CommerceBundle\Entity\Upload $upload)
    {
        $this->uploads[] = $upload;

        return $this;
    }

    /**
     * Remove upload
     *
     * @param \CommerceBundle\Entity\Upload $upload
     */
    public function removeUpload(\CommerceBundle\Entity\Upload $upload)
    {
        $this->uploads->removeElement($upload);
    }
}
