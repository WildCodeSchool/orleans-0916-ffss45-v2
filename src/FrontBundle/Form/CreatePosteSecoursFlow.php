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
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep3Form',
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
                'label' => 'confirmation',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep4Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeManifSportive()!='aqua';
                },
            ),
            array(
                'label' => 'confirmation',
                'form_type' => 'FrontBundle\Form\CreatePosteSecoursStep5Form',
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && $flow->getFormData()->getTypeManifSportive()!='foot';
                },
            ),
        );
    }

}