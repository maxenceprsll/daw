<?php
class Reponse {
    private $idReponse;
    private $texteRep;
    private $val;

    public function __construct($idReponse, $texteRep, $val) {
        $this->idReponse = $idReponse;
        $this->texteRep = $texteRep;
        $this->val = $val;
    }

    public function getIdReponse() {
        return $this->idReponse;
    }

    public function setIdReponse($idReponse) {
        $this->idReponse = $idReponse;
    }

    public function getTexteRep() {
        return $this->texteRep;
    }

    public function setTexteRep($texteRep) {
        $this->texteRep = $texteRep;
    }

    public function getVal() {
        return $this->val;
    }

    public function setVal($val) {
        $this->val = $val;
    }
}
?>