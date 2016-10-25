<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 22/10/16
 * Time: 22:50
 */

namespace FrontBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class CreatePosteSecoursFlow extends FormFlow {
    protected $allowDynamicStepNavigation = true;
    protected function loadStepsConfig() {

        return array(
            array(
                'label' => 'Base',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep1Form',
            ),
            array(
                'label' => 'Manifestation sportive',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep4Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && $flow->getFormData()->getTypeManif()!='sport';
                },
            ),
            array(
                'label' => 'Manifestation culturelle',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep2Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && $flow->getFormData()->getTypeManif()!='culture';
                },
            ),
            array(
                'label' => 'Rassemblement de personnes',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep3Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && $flow->getFormData()->getTypeManif()!='personnes';
                },
            ),
            array(
                'label' => 'Course pédestre',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep5Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='course';
                },
            ),
            array(
                'label' => 'Sport collectif',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep6Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='collectif';
                },
            ),
            array(
                'label' => 'Sport individuel',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep7Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='individuel';
                },
            ),
            array(
                'label' => 'Sport mécanique',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep8Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='mécanique';
                },
            ),
            array(
                'label' => 'Sport aquatique',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep9Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='aquatique';
                },
            ),
            array(
                'label' => 'Sport équestre',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep10Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='équestre';
                },
            ),
            array(
                'label' => 'Autre type de sport',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep11Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='autre';
                },
            ),
            array(
                'label' => 'Fin de formulaire sportif',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep12Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && !$flow->getFormData()->getTypeEvtCulturel()!=null;
                }
            ),
            array(
                'label' => 'Fin de formulaire culturel',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep12Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && !$flow->getFormData()->getTypeEvtSportif()!=null;
                }
            ),
            array(
                'label' => 'Fin de formulaire rassemblement de personnes',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep12Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && !$flow->getFormData()->getTypeRdP()!=null;
                }
            ),
        );
    }



}