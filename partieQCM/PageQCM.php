<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="QCM.css">
</head>

<body>
    <?php
    spl_autoload_register(function ($class) {
        include './class/' . $class . '.php';
    });
    $url = "http://localhost/projetdaw/api/GetAllQuestion.php";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST["cat"])){
            $url = "http://localhost/projetdaw/api/GetAllQuestionByCat.php?cat=" . $_POST["cat"];
        }
    }else {
        
    }
    
    $QuestionList = array();
    $raw = file_get_contents($url);
    $json = json_decode($raw);
    if (!empty($json)) {
        $idQuestionActu = 0;
        $questionActu = null;
        $premiereFois = true;
        foreach ($json as $question) {
            if ($questionActu == null) {
                $questionActu = new Question($question->idQuestion, $question->Intitulé,$question->valRep);
                $questionActu->addReponse(new Reponse($question->idReponse, $question->texteRep, $question->val));
            } else {
                if ($question->Intitulé != $questionActu->getQuestionText()) {
                    $QuestionList[] = $questionActu;
                    $questionActu = new Question($question->idQuestion, $question->Intitulé,$question->valRep);
                    $questionActu->addReponse(new Reponse($question->idReponse, $question->texteRep, $question->val));
                } else {
                    $questionActu->addReponse(new Reponse($question->idReponse, $question->texteRep, $question->val));
                }
            }
        }
        $QuestionList[] = $questionActu;
        if (isset($_GET['Ques'])) {
            echo $_POST['rr1'];
            $compteurQuestion = $_GET['Ques'];
        } else {
            $compteurQuestion = 0;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultat = 0;
            foreach ($QuestionList as $q) {
                foreach ($q->getReponselist() as $rep) {
                    if (isset($_POST[$q->getIdQuestion()])) {
                        if ($rep->getVal() == $q->getReponse()) {
                            $resultat++;
                        }
                    }
                }
            }
            echo "Vous avez eu " . $resultat . "/".count($QuestionList)." bonnes réponses";
        }
    }
    ?>
    <h1>QCM</h1>
    <form method="post" id="listeRep">
    <div id="QMarge">
        <?php
        $cptQ = 1;
        foreach($QuestionList as $q){
            echo '<p id="q'.$cptQ.'">'.$q->getQuestionText().'</p>';
            $cptQ++;
            $cpt = 1;
            foreach($q->getReponselist() as $rep){
                echo "<input type='radio' name='".$q->getIdQuestion()."' id='rr".$cpt."' />";
                echo "<label for='rr".$cpt."'  id='r".$cpt."' class='alignQR' >".$rep->getTexteRep()."</label>";
                $cpt++;
            }
        }?>
        <br>
        </div>
        <input type="submit" value="Valider" id="bag">
    </form>
</body>

</html>