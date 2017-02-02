<?php


namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
class ProfileFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('nom')
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
				'label' => 'Carte d\'identité'
			]);
		;
	}

	public function getParent()
	{
		return 'fos_user_profile';
	}
}