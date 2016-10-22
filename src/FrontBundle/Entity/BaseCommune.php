<?php

namespace FrontBundle\Entity;

class BaseCommune
{

    protected $nomManif;
    protected $presentationManif;
    protected $dateJour1;
    protected $heureJour1;
    protected $dateJour2;
    protected $heureJour2;
    protected $dateJour3;
    protected $heureJour3;
    protected $adresseManif;
    protected $villeManif;
    protected $pompiersLieu;
    protected $pompiersDist;
    protected $pompiersDelai;
    protected $urgencesLieu;
    protected $urgencesDist;
    protected $urgencesDelai;
    protected $raisonSociale;
    protected $nomRep;
    protected $telRep;
    protected $mailRep;
    protected $nomChef;
    protected $telChef;
    protected $mailChef;
    protected $nomSiteWeb;
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
    /**
     * @return mixed
     */
    public function getNomManif()
    {
        return $this->nomManif;
    }

    /**
     * @param mixed $nomManif
     */

    public function setNomManif($nomManif)
    {
        $this->nomManif = $nomManif;
    }

    /**
     * @return mixed
     */
    public function getPresentationManif()
    {
        return $this->presentationManif;
    }

    /**
     * @param mixed $presentationManif
     */
    public function setPresentationManif($presentationManif)
    {
        $this->presentationManif = $presentationManif;
    }

    /**
     * @return mixed
     */
    public function getDateJour1()
    {
        return $this->dateJour1;
    }

    /**
     * @param mixed $dateJour1
     */
    public function setDateJour1(\DateTime $dateJour1 = null)
    {
        $this->dateJour1 = $dateJour1;
    }

    /**
     * @return mixed
     */
    public function getHeureJour1()
    {
        return $this->heureJour1;
    }

    /**
     * @param mixed $heureJour1
     */
    public function setHeureJour1(\DateTime $heureJour1 = null)
    {
        $this->heureJour1 = $heureJour1;
    }

    /**
     * @return mixed
     */
    public function getDateJour2()
    {
        return $this->dateJour2;
    }

    /**
     * @param mixed $dateJour2
     */
    public function setDateJour2(\DateTime $dateJour2 = null)
    {
        $this->dateJour2 = $dateJour2;
    }

    /**
     * @return mixed
     */
    public function getHeureJour2()
    {
        return $this->heureJour2;
    }

    /**
     * @param mixed $heureJour2
     */
    public function setHeureJour2(\DateTime $heureJour2 = null)
    {
        $this->heureJour2 = $heureJour2;
    }

    /**
     * @return mixed
     */
    public function getDateJour3()
    {
        return $this->dateJour3;
    }

    /**
     * @param mixed $dateJour3
     */
    public function setDateJour3(\DateTime $dateJour3 = null)
    {
        $this->dateJour3 = $dateJour3;
    }

    /**
     * @return mixed
     */
    public function getHeureJour3()
    {
        return $this->heureJour3;
    }

    /**
     * @param mixed $heureJour3
     */
    public function setHeureJour3(\DateTime $heureJour3 = null)
    {
        $this->heureJour3 = $heureJour3;
    }

    /**
     * @return mixed
     */
    public function getAdresseManif()
    {
        return $this->adresseManif;
    }

    /**
     * @param mixed $adresseManif
     */
    public function setAdresseManif($adresseManif)
    {
        $this->adresseManif = $adresseManif;
    }

    /**
     * @return mixed
     */
    public function getVilleManif()
    {
        return $this->villeManif;
    }

    /**
     * @param mixed $villeManif
     */
    public function setVilleManif($villeManif)
    {
        $this->villeManif = $villeManif;
    }

    /**
     * @return mixed
     */
    public function getPompiersLieu()
    {
        return $this->pompiersLieu;
    }

    /**
     * @param mixed $pompiersLieu
     */
    public function setPompiersLieu($pompiersLieu)
    {
        $this->pompiersLieu = $pompiersLieu;
    }

    /**
     * @return mixed
     */
    public function getPompiersDist()
    {
        return $this->pompiersDist;
    }

    /**
     * @param mixed $pompiersDist
     */
    public function setPompiersDist($pompiersDist)
    {
        $this->pompiersDist = $pompiersDist;
    }

    /**
     * @return mixed
     */
    public function getPompiersDelai()
    {
        return $this->pompiersDelai;
    }

    /**
     * @param mixed $pompiersDelai
     */
    public function setPompiersDelai($pompiersDelai)
    {
        $this->pompiersDelai = $pompiersDelai;
    }

    /**
     * @return mixed
     */
    public function getUrgencesLieu()
    {
        return $this->urgencesLieu;
    }

    /**
     * @param mixed $urgencesLieu
     */
    public function setUrgencesLieu($urgencesLieu)
    {
        $this->urgencesLieu = $urgencesLieu;
    }

    /**
     * @return mixed
     */
    public function getUrgencesDist()
    {
        return $this->urgencesDist;
    }

    /**
     * @param mixed $urgencesDist
     */
    public function setUrgencesDist($urgencesDist)
    {
        $this->urgencesDist = $urgencesDist;
    }

    /**
     * @return mixed
     */
    public function getUrgencesDelai()
    {
        return $this->urgencesDelai;
    }

    /**
     * @param mixed $urgencesDelai
     */
    public function setUrgencesDelai($urgencesDelai)
    {
        $this->urgencesDelai = $urgencesDelai;
    }

    /**
     * @return mixed
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * @param mixed $raisonSociale
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;
    }

    /**
     * @return mixed
     */
    public function getNomRep()
    {
        return $this->nomRep;
    }

    /**
     * @param mixed $nomRep
     */
    public function setNomRep($nomRep)
    {
        $this->nomRep = $nomRep;
    }

    /**
     * @return mixed
     */
    public function getTelRep()
    {
        return $this->telRep;
    }

    /**
     * @param mixed $telRep
     */
    public function setTelRep($telRep)
    {
        $this->telRep = $telRep;
    }

    /**
     * @return mixed
     */
    public function getMailRep()
    {
        return $this->mailRep;
    }

    /**
     * @param mixed $mailRep
     */
    public function setMailRep($mailRep)
    {
        $this->mailRep = $mailRep;
    }

    /**
     * @return mixed
     */
    public function getNomChef()
    {
        return $this->nomChef;
    }

    /**
     * @param mixed $nomChef
     */
    public function setNomChef($nomChef)
    {
        $this->nomChef = $nomChef;
    }

    /**
     * @return mixed
     */
    public function getTelChef()
    {
        return $this->telChef;
    }

    /**
     * @param mixed $telChef
     */
    public function setTelChef($telChef)
    {
        $this->telChef = $telChef;
    }

    /**
     * @return mixed
     */
    public function getMailChef()
    {
        return $this->mailChef;
    }

    /**
     * @param mixed $mailChef
     */
    public function setMailChef($mailChef)
    {
        $this->mailChef = $mailChef;
    }

    /**
     * @return mixed
     */
    public function getNomSiteWeb()
    {
        return $this->nomSiteWeb;
    }

    /**
     * @param mixed $nomSiteWeb
     */
    public function setNomSiteWeb($nomSiteWeb)
    {
        $this->nomSiteWeb = $nomSiteWeb;
    }



}