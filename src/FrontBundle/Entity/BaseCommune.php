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