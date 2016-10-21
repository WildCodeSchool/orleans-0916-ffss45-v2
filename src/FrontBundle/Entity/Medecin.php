<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 20/10/16
 * Time: 17:41
 */

namespace FrontBundle\Entity;


class Medecin
{
    protected $reglementationMedicale;

    /**
     * @return mixed
     */
    public function getReglementationMedicale()
    {
        return $this->reglementationMedicale;
    }

    /**
     * @param mixed $reglementationMedicale
     */
    public function setReglementationMedicale($reglementationMedicale)
    {
        $this->reglementationMedicale = $reglementationMedicale;
    }



}