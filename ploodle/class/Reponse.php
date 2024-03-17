<?php
class Reponse {
    private $reID;
    private $reIntitule;
    private $reQuestionID;
    private $reCorrecte;

    public function __construct($reID, $reIntitule, $reQuestionID, $reCorrecte) {
        $this->reID = $reID;
        $this->reIntitule = $reIntitule;
        $this->reQuestionID = $reQuestionID;
        $this->reCorrecte = $reCorrecte;
    }

    public function getReID() {
        return $this->reID;
    }

    public function setReID($ReID) {
        $this->reID = $reID;
    }

    public function getReIntitule() {
        return $this->reIntitule;
    }

    public function setReIntitule($reIntitule) {
        $this->reIntitule = $reIntitule;
    }

    public function getReQuestionID() {
        return $this->reQuestionID;
    }

    public function setReQuestionID($reQuestionID) {
        $this->reQuestionID = $reQuestionID;
    }

    public function getReCorrecte() {
        return $this->reCorrecte;
    }

    public function setReCorrecte($reCorrecte) {
        $this->reCorrecte = $reCorrecte;
    }
}