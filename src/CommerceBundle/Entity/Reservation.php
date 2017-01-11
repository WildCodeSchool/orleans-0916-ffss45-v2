<?php

namespace CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="CommerceBundle\Repository\ReservationRepository")
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
	 * @ORM\Column(name="agenda_id", type="integer")
	 * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Agenda", inversedBy="reservations")
	 */
	private $agenda;

	/**
	 *@ORM\Column(name="user_id", type="integer")
	 * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\User", inversedBy="reservations")
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
    public function setAgenda($agenda)
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
    public function setUser($user)
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
}
