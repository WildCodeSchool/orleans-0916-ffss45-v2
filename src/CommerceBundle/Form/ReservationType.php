<?php

namespace CommerceBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use CommerceBundle\Entity\Reservation;
use AdminBundle\Entity\User;

class ReservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('status')
	        ->add('status', ChoiceType::class, array(
		        'choices' => array(1 => 'En cours d \'inscription',
			        2 => 'Inscrit',
			        3 => 'Inscription annulée',
			        4 => 'Inscription reportée')))
               ->add('user', EntityType::class, [
               	'class'=>'AdminBundle\Entity\User',
	               'choice_label'=>'username'
               ])
//	          ->add('nom', [
//	          	'class'=>'AdminBundle\Entity\User',
////		          'choice_label'=>'nom',
//		          'mapped'=>false
//	          ])
//	          ->add('prenom', EntityType::class, [
//	          	'class'=>'AdminBundle\Entity\User',
////		          'choice_label'=>'prenom',
//		          'mapped'=>false
//	          ])
//	        ->add('adresse', EntityType::class, [
//		        'class'=>'AdminBundle\Entity\User',
////		          'choice_label'=>'prenom',
//		        'mapped'=>false
//	        ])
               ->add('imageFile', VichImageType::class, [
		               'required' => false,
		               'allow_delete' => true, // not mandatory, default is true
		               'download_link' => true, // not mandatory, default is true
	        ])

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CommerceBundle\Entity\Reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'commerceBundle_reservation';
    }
}
