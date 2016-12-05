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
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $reservations;

	/**
	 * @ORM\OneToMany(targetEntity="CommerceBundle\Entity\Upload", mappedBy="user")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $upload;
}

