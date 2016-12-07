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
     * Add reservation
     *
     * @param \CommerceBundle\Entity\Reservations $reservation
     *
     * @return User
     */
    public function addReservation(\CommerceBundle\Entity\Reservations $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \CommerceBundle\Entity\Reservations $reservation
     */
    public function removeReservation(\CommerceBundle\Entity\Reservations $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
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

    /**
     * Get uploads
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUploads()
    {
        return $this->uploads;
    }
}
