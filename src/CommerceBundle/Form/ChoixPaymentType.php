<?php

namespace CommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoixPaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('payment', ChoiceType::class, [
            'choices'  => [
                'cb'       => 'CB',
                'cheque'   => 'Chèque',
                'virement' => 'Virement',
            ],
            'multiple' => false,
            'expanded' => true,
        ])
            ->add('numPO', TextType::class, [
                'required' => false,
                'label'=>'N° PO'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'front_bundlechoix_payment_type';
    }
}
