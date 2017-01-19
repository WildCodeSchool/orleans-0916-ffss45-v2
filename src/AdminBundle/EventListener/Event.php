<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 08/12/16
 * Time: 11:18
 */

namespace AdminBundle\EventListener;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Event implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return array(
			FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
		);
	}
	public function onRegistrationSuccess(FormEvent $event) {
		$roles = array('ROLE_CLIENT');
		$user = $event ->getForm()->getData();
		$user->setRoles($roles);
	}
}