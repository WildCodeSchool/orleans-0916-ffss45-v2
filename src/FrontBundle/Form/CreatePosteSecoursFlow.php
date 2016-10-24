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

    protected function loadStepsConfig() {
        return array(
            array(
                'label' => 'base',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep1Form',
            ),
            array(
                'label' => 'manifestation sportive',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep4Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && $flow->getFormData()->getTypeManif()!='sport';
                },
            ),
            array(
                'label' => 'manifestation culturelle',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep2Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && $flow->getFormData()->getTypeManif()!='culture';
                },
            ),
            array(
                'label' => 'rassemblement de personnes',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep3Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && $flow->getFormData()->getTypeManif()!='personnes';
                },
            ),
            array(
                'label' => 'course pédestre',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep5Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='course';
                },
            ),
            array(
                'label' => 'sport collectif',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep6Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='collectif';
                },
            ),
            array(
                'label' => 'sport individuel',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep7Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='individuel';
                },
            ),
            array(
                'label' => 'sport mécanique',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep8Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='mécanique';
                },
            ),
            array(
                'label' => 'sport aquatique',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep9Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='aquatique';
                },
            ),
            array(
                'label' => 'sport équestre',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep10Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='équestre';
                },
            ),
            array(
                'label' => 'autre type de sport',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep11Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeEvtSportif()!='autre';
                },
            ),
            array(
                'label' => 'confirmation',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep12Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && !$flow->getFormData()->getTypeEvtCulturel()!=null;
                }
            ),
            array(
                'label' => 'confirmation',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep12Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && !$flow->getFormData()->getTypeEvtSportif()!=null;
                }
            ),
            array(
                'label' => 'confirmation',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep12Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && !$flow->getFormData()->getTypeRdP()!=null;
                }
            ),
        );
    }

}