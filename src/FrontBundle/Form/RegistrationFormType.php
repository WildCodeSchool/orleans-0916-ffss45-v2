<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FrontBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class RegistrationFormType extends AbstractType
{
	/**
	 * @var string
	 */
	private $class;

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
//			->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
			->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
				'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
				'options' => array('translation_domain' => 'FOSUserBundle'),
				'first_options' => array('label' => 'form.password'),
				'second_options' => array('label' => 'form.password_confirmation'),
				'invalid_message' => 'fos_user.password.mismatch'))
			->add('nom')
			->add('prenom')
			->add('date_naissance', BirthdayType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
			->add('lieu_naissance')
			->add('departement_naissance')
			->add('adresse')
			->add('code_postal')
			->add('ville')
			->add('tel')
			->add('relation')
			->add('imageFile', VichImageType::class, [
				'required' => false,
				'allow_delete' => true, // not mandatory, default is true
				'download_link' => true, // not mandatory, default is true
			]);
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
	public function getClass()
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
