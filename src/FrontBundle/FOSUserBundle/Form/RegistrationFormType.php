<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FrontBundle\FOSUserBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
	/**
	 * @var string
	 */
	private $class;

	public function getParent()
	{
		return 'FOS\UserBundle\Form\Type\RegistrationFormType';

		// Or for Symfony < 2.8
		// return 'fos_user_registration';
	}

//	/**
//	 * @param string $class The User class name
//	 */
//	public function __construct($class)
//	{
//		$this->class = $class;
//	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
			->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
			->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
				'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
				'options' => array('translation_domain' => 'FOSUserBundle'),
				'first_options' => array('label' => 'form.password'),
				'second_options' => array('label' => 'form.password_confirmation'),
				'invalid_message' => 'fos_user.password.mismatch'))
			->add('nom')
			->add('prenom')
			->add('age')
			->add('date_naissance')
			->add('lieu_naissance')
			->add('departement_naissance')
			->add('adresse')
			->add('code_postal')
			->add('ville')
			->add('tel')
			->add('relation')
		;
	}


	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
//			'data_class' => $this->class,
			'csrf_token_id' => 'registration',
			// BC for SF < 2.8
			'intention' => 'registration',
			'data_class' => 'AdminBundle\Entity\User',
		));
	}

//	// BC for SF < 3.0
//	/**
//	 * {@inheritdoc}
//	 */
//	public function getName()
//	{
//		return $this->getBlockPrefix();
//	}
//
//	/**
//	 * {@inheritdoc}
//	 */
//	public function getBlockPrefix()
//	{
//		return 'fos_user_registration';
//	}

	public function getBlockPrefix()
	{
		return 'app_user_registration';
	}

	// For Symfony 2.x
	public function getName()
	{
		return $this->getBlockPrefix();
	}

	/**
	 * @return string
	 */
	public function getClass(): string
	{
		return $this->class;
	}

	/**
	 * @param string $class
	 */
	public function setClass(string $class)
	{
		$this->class = $class;
	}

}
