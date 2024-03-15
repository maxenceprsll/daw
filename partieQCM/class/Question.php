<?php
class Question {
    private $idQuestion;
    private $questionText;
    private $Reponse ;
    private $ReponseTable = array();

    public function __construct($id,$questionText,$rep) {
        $this->idQuestion = $id;
        $this->questionText = $questionText;
        $this->Reponse = $rep;
    }

    public function addReponse($reponse) {
        $this->ReponseTable[] = $reponse;
    }

    public function getReponselist() {
        return $this->ReponseTable;
    }
    public function getQuestionText() {
        return $this->questionText;
    }

    public function setQuestionText($questionText) {
        $this->questionText = $questionText;
    }
    public function getIdQuestion() {
        return $this->idQuestion;
    }
    public function setIdQuestion($idQuestion) {
        $this->idQuestion = $idQuestion;
    }

    public function getReponse() {
        return $this->Reponse;
    }
}
?>
