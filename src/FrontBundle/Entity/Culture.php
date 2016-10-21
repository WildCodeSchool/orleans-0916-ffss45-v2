<?php


namespace FrontBundle\Entity;


class Culture
{

    protected $typeCulture;
    protected $tarifCulture;
    protected $intExt;
    protected $intLieu;
    protected $extLieu;
    protected $nbPersonneTotal1;
    protected $nbPersonneInst1;
    protected $nbPersonneTotal2;
    protected $nbPersonneInst2;
    protected $nbPersonneTotal3;
    protected $nbPersonneInst3;
    protected $typeSiege;
    protected $typePublic;
    protected $capaciteSite;
    protected $superficieSite;
    protected $accesPublic;
    protected $nbScene;
    protected $simulScene;
    protected $installTemp;

    /**
     * @return mixed
     */
    public function getTypeCulture()
    {
        return $this->typeCulture;
    }

    /**
     * @param mixed $typeCulture
     */
    public function setTypeCulture($typeCulture)
    {
        $this->typeCulture = $typeCulture;
    }

    /**
     * @return mixed
     */
    public function getTarifCulture()
    {
        return $this->tarifCulture;
    }

    /**
     * @param mixed $tarifCulture
     */
    public function setTarifCulture($tarifCulture)
    {
        $this->tarifCulture = $tarifCulture;
    }

    /**
     * @return mixed
     */
    public function getIntExt()
    {
        return $this->intExt;
    }

    /**
     * @param mixed $intExt
     */
    public function setIntExt($intExt)
    {
        $this->intExt = $intExt;
    }

    /**
     * @return mixed
     */
    public function getIntLieu()
    {
        return $this->intLieu;
    }

    /**
     * @param mixed $intLieu
     */
    public function setIntLieu($intLieu)
    {
        $this->intLieu = $intLieu;
    }

    /**
     * @return mixed
     */
    public function getExtLieu()
    {
        return $this->extLieu;
    }

    /**
     * @param mixed $extLieu
     */
    public function setExtLieu($extLieu)
    {
        $this->extLieu = $extLieu;
    }

    /**
     * @return mixed
     */
    public function getNbPersonneTotal1()
    {
        return $this->nbPersonneTotal1;
    }

    /**
     * @param mixed $nbPersonneTotal1
     */
    public function setNbPersonneTotal1($nbPersonneTotal1)
    {
        $this->nbPersonneTotal1 = $nbPersonneTotal1;
    }

    /**
     * @return mixed
     */
    public function getNbPersonneInst1()
    {
        return $this->nbPersonneInst1;
    }

    /**
     * @param mixed $nbPersonneInst1
     */
    public function setNbPersonneInst1($nbPersonneInst1)
    {
        $this->nbPersonneInst1 = $nbPersonneInst1;
    }

    /**
     * @return mixed
     */
    public function getNbPersonneTotal2()
    {
        return $this->nbPersonneTotal2;
    }

    /**
     * @param mixed $nbPersonneTotal2
     */
    public function setNbPersonneTotal2($nbPersonneTotal2)
    {
        $this->nbPersonneTotal2 = $nbPersonneTotal2;
    }

    /**
     * @return mixed
     */
    public function getNbPersonneInst2()
    {
        return $this->nbPersonneInst2;
    }

    /**
     * @param mixed $nbPersonneInst2
     */
    public function setNbPersonneInst2($nbPersonneInst2)
    {
        $this->nbPersonneInst2 = $nbPersonneInst2;
    }

    /**
     * @return mixed
     */
    public function getNbPersonneTotal3()
    {
        return $this->nbPersonneTotal3;
    }

    /**
     * @param mixed $nbPersonneTotal3
     */
    public function setNbPersonneTotal3($nbPersonneTotal3)
    {
        $this->nbPersonneTotal3 = $nbPersonneTotal3;
    }

    /**
     * @return mixed
     */
    public function getNbPersonneInst3()
    {
        return $this->nbPersonneInst3;
    }

    /**
     * @param mixed $nbPersonneInst3
     */
    public function setNbPersonneInst3($nbPersonneInst3)
    {
        $this->nbPersonneInst3 = $nbPersonneInst3;
    }

    /**
     * @return mixed
     */
    public function getTypeSiege()
    {
        return $this->typeSiege;
    }

    /**
     * @param mixed $typeSiege
     */
    public function setTypeSiege($typeSiege)
    {
        $this->typeSiege = $typeSiege;
    }

    /**
     * @return mixed
     */
    public function getTypePublic()
    {
        return $this->typePublic;
    }

    /**
     * @param mixed $typePublic
     */
    public function setTypePublic($typePublic)
    {
        $this->typePublic = $typePublic;
    }

    /**
     * @return mixed
     */
    public function getCapaciteSite()
    {
        return $this->capaciteSite;
    }

    /**
     * @param mixed $capaciteSite
     */
    public function setCapaciteSite($capaciteSite)
    {
        $this->capaciteSite = $capaciteSite;
    }

    /**
     * @return mixed
     */
    public function getSuperficieSite()
    {
        return $this->superficieSite;
    }

    /**
     * @param mixed $superficieSite
     */
    public function setSuperficieSite($superficieSite)
    {
        $this->superficieSite = $superficieSite;
    }

    /**
     * @return mixed
     */
    public function getAccesPublic()
    {
        return $this->accesPublic;
    }

    /**
     * @param mixed $accesPublic
     */
    public function setAccesPublic($accesPublic)
    {
        $this->accesPublic = $accesPublic;
    }

    /**
     * @return mixed
     */
    public function getNbScene()
    {
        return $this->nbScene;
    }

    /**
     * @param mixed $nbScene
     */
    public function setNbScene($nbScene)
    {
        $this->nbScene = $nbScene;
    }

    /**
     * @return mixed
     */
    public function getSimulScene()
    {
        return $this->simulScene;
    }

    /**
     * @param mixed $simulScene
     */
    public function setSimulScene($simulScene)
    {
        $this->simulScene = $simulScene;
    }

    /**
     * @return mixed
     */
    public function getInstallTemp()
    {
        return $this->installTemp;
    }

    /**
     * @param mixed $installTemp
     */
    public function setInstallTemp($installTemp)
    {
        $this->installTemp = $installTemp;
    }

}