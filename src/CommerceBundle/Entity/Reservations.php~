<?php

namespace CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservations
 *
 * @ORM\Table(name="reservations")
 * @ORM\Entity(repositoryClass="CommerceBundle\Repository\ReservationsRepository")
 */
class Reservations
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
     * @ORM\Column(name="status", type="string", length=45)
     */
    private $status;

    /**
     * @var int
     * @ORM\Column(name="numero_reservation", type="integer")
     */
    private $numeroReservation;

	/**
	 *
	 * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Agenda", inversedBy="Reservationss")
	 */
	private $agenda;

	/**
	 *
	 * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\User", inversedBy="Reservationss")
	 */
	private $user;

	/**
	 *
	 * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\FormulaireSecours", inversedBy="Reservationss")
	 */
	private $formulairesecours;

	/**
     * @var string
     *
     * @ORM\Column(name="convocation", type="string", length=45)
     */
    private $convocation;

    /**
     * @var string
     *
     * @ORM\Column(name="certificate", type="string", length=45)
     */
    private $certificate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delai_expiration", type="datetime")
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
     * @return Reservations
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
     * @return Reservations
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
     * @return Reservations
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
     * @return Reservations
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
     * @return Reservations
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
}

