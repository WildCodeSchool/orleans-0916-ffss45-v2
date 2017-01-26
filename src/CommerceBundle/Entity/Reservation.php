<?php

namespace CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use AdminBundle\Entity\Agenda;
use AdminBundle\Entity\User;
/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="CommerceBundle\Repository\ReservationRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Reservation
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
     * @ORM\Column(name="status", type="string", length=45, nullable=true)
     */
    private $status;

    /**
     * @var int
     * @ORM\Column(name="numero_reservation", type="integer", nullable=true)
     */
    private $numeroReservation;

	/**
     *
	 * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Agenda", inversedBy="reservations",cascade={"persist"} )
	 */
	private $agenda;



	/**
	 * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\User", inversedBy="reservations",cascade={"persist"} )
	 */
	private $user;

	/**
	 * @ORM\Column(nullable=true)
	 * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\FormulaireSecours", inversedBy="reservations")
	 */
	private $formulaireSecours;

	/**
     * @var string
     *
     * @ORM\Column(name="convocation", type="string", length=45, nullable=true)
     */
    private $convocation;

    /**
     * @var string
     *
     * @ORM\Column(name="certificate", type="string", length=45, nullable=true)
     */
    private $certificate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delai_expiration", type="datetime", nullable=true)
     */
    private $delaiExpiration;


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
     * Set status
     *
     * @param string $status
     *
     * @return Reservation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusLabel ()
    {
    	     $statuses =  [
    	     	1=>'En cours d \'inscription',
	          2=>'Inscrit',
	          3=>'Inscription annulée',
	          4=>'Inscription reportée',
          ];
    	     return $statuses[$this->status];
    }

    /**
     * Set numeroReservation
     *
     * @param integer $numeroReservation
     *
     * @return Reservation
     */
    public function setnumeroReservation($numeroReservation)
    {
        $this->numeroReservation = $numeroReservation;

        return $this;
    }

    /**
     * Get numeroReservation
     *
     * @return int
     */
    public function getnumeroReservation()
    {
        return $this->numeroReservation;
    }

    /**
     * Set convocation
     *
     * @param string $convocation
     *
     * @return Reservation
     */
    public function setConvocation($convocation)
    {
        $this->convocation = $convocation;

        return $this;
    }

    /**
     * Get convocation
     *
     * @return string
     */
    public function getConvocation()
    {
        return $this->convocation;
    }

    /**
     * Set certificate
     *
     * @param string $certificate
     *
     * @return Reservation
     */
    public function setCertificate($certificate)
    {
        $this->certificate = $certificate;

        return $this;
    }

    /**
     * Get certificate
     *
     * @return string
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * Set delaiExpiration
     *
     * @param \DateTime $delaiExpiration
     *
     * @return Reservation
     */
    public function setDelaiExpiration($delaiExpiration)
    {
        $this->delaiExpiration = $delaiExpiration;

        return $this;
    }

    /**
     * Get delaiExpiration
     *
     * @return \DateTime
     */
    public function getDelaiExpiration()
    {
        return $this->delaiExpiration;
    }

    /**
     * @param mixed $agenda
     */
    public function setAgenda(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }



    /**
     * Get agenda
     *
     * @return \AdminBundle\Entity\Agenda
     */
    public function getAgenda()
    {
        return $this->agenda;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }



    /**
     * Get user
     *
     * @return \AdminBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set formulairesecours
     *
     * @param \FrontBundle\Entity\FormulaireSecours $formulairesecours
     *
     * @return Reservation
     */
    public function setFormulairesecours(\FrontBundle\Entity\FormulaireSecours $formulairesecours = null)
    {
        $this->formulairesecours = $formulairesecours;

        return $this;
    }

    /**
     * Get formulairesecours
     *
     * @return \FrontBundle\Entity\FormulaireSecours
     */
    public function getFormulairesecours()
    {
        return $this->formulairesecours;
    }

	/**
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Vich\UploadableField(mapping="img_image", fileNameProperty="imageName")
	 *
	 * @var File
	 */
	private $imageFile;

	/**
	 * @ORM\Column(type="string", length=255,  nullable=true)
	 *
	 * @var string
	 */
	private $imageName;

	/**
	 * @ORM\Column(type="datetime")
	 *
	 * @var \DateTime
	 */
	private $updatedAt;

    public function __construct()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
	 * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
	 * of 'UploadedFile' is injected into this setter to trigger the  update. If this
	 * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
	 * must be able to accept an instance of 'File' as the bundle will inject one here
	 * during Doctrine hydration.
	 *
	 * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
	 *
	 * @return img
	 */
	public function setImageFile(File $image = null)
	{
		$this->imageFile = $image;

		if ($image) {
			// It is required that at least one field changes if you are using doctrine
			// otherwise the event listeners won't be called and the file is lost
			$this->updatedAt = new \DateTimeImmutable();
		}

		return $this;
	}

	/**
	 * @return File|null
	 */
	public function getImageFile()
	{
		return $this->imageFile;
	}

	/**
	 * @param string $imageName
	 *
	 * @return img
	 */
	public function setImageName($imageName)
	{
		$this->imageName = $imageName;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getImageName()
	{
		return $this->imageName;
	}



    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return img
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
