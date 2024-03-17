<?php
class Question {
    private $quID;
    private $quIntitule;
    private $reponses = array();

    public function __construct($quID,$quIntitule) {
        $this->quID = $quID;
        $this->quIntitule = $quIntitule;
    }
    public function getQuIntitule() {
        return $this->quIntitule;
    }
    public function setQuIntitule($quIntitule) {
        $this->quIntitule = $quIntitule;
    }
    public function getQuID() {
        return $this->quID;
    }
    public function setQuID($quID) {
        $this->quID = $quID;
    }
    public function addReponse($reponse) {
        $this->reponses[] = $reponse;
    }
    public function getReponses() {
        return $this->reponses;
    }
}
