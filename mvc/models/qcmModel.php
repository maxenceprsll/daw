<?php //Maxence Persello

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

function aff_qcm(): void {

    echo 'aff';
    $questions_api_url = "http://localhost:8888/Documents/GitHub/daw/mvc/api/GetAllQuestion.php";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST["categorie"])){
            $questions_api_url = "http://localhost:8888/Documents/GitHub/daw/mvc/api/GetAllQuestionByCat.php?categorie=" . $_POST["categorie"];
        }
    }
    
    $raw_questions = file_get_contents($questions_api_url);
    $questions_array = json_decode($raw_questions,true);

    if (!empty($questions_array)) {
        echo '<form action="" method="post" id="listeRep">',
        '<h1>QCM</h1>',
        '<div id="QMarge">';

        foreach ($questions_array as $question_data) {
            $question_data = json_decode($question_data,true);

            $question_id = $question_data['quID'];
            $question_text = $question_data['quIntitule'];
            $question_category = $question_data['quCategorie'];

            $answers_api_url = "http://localhost:8888/Documents/GitHub/daw/ploodle/api/GetReponsesByQuestion.php?quID=" . $question_id;
            $raw_answers = file_get_contents($answers_api_url);
            $answers_array = json_decode($raw_answers);

            $question = new Question($question_id, $question_text, $question_category);

            foreach ($answers_array as $answer_data) {
                $answer_data = json_decode($answer_data,true);
                $answer_id = $answer_data['reID'];
                $answer_text = $answer_data['reIntitule'];
                $answer_correctness = $answer_data['reCorrecte'];
                $answer_of = new Reponse($answer_id, $answer_text, $question_id, $answer_correctness);
                $question->addReponse($answer_of);
            }

            echo '<h3 id="q' . $question->getQuID() . '">' . $question->getQuIntitule() . '</h3><div class="listeReponse">';
            foreach ($question->getReponses() as $answer) {
                echo "<div class='reponse'>";
                echo "<input type='radio' name='answers[" . $question->getQuID() . "]' value='" . $answer->getReCorrecte() ."'id='rr" . $answer->getReID() . "' />";
                echo "<label for='rr" . $answer->getReID() . "'  id='r" . $answer->getReID() . "'>" . $answer->getReIntitule() . "</label>";
                echo "</div>";
            }
            echo '</div>';
        }

        echo '<input id="qcmSubmit" type="submit" name="Valider" value="Valider">';
        echo '</form>';
    }
}

function traitement_reponses(): void {
    if (isset($_POST['answers']) && isset($_POST['Valider'])) {
        $answers = $_POST['answers'];
        $correct_answers = 0;
        
        foreach ($answers as $question_id => $answer_id) {
            if ($answer_id == "1") {
                $correct_answers++;
            }
        }

        echo "<section><h2>Résultats</h2>",
        "<p>Vous avez obtenu " . $correct_answers . " bonnes réponses.</p></section>";
    } else {
        echo "Erreur : Données du formulaire erronées";
    }
}