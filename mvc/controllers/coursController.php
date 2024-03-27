<?php // Maxence Persello

require_once 'models/coursModel.php';

function coursController(): void {

    
    
    head('Cours');
    heading();
    nav();

    $admin = isset($_SESSION['usAdmin']) && $_SESSION['usAdmin'];

    if($admin && isset($_POST['btnNewPage'])) {
        addCours($_POST['formation'], $_POST['niveau'], $_POST['titre']);
        header('Location: ?route=cours');
    }

    if ($admin && isset($_GET['saveElement'])) {
        if (isset($_POST['saveElement'])) {
            $paID = $_POST['paID'];
            $elementType = $_POST['elementType'];
        
            $directory = 'import/' . $paID . '/';
        
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
        
            if ($elementType === "file" && isset($_FILES['fileContent'])) {
                $file = $_FILES['fileContent'];
                $fileName = $directory . basename($file['name']);
                
                if (move_uploaded_file($file['tmp_name'], $fileName)) {
                    echo "File uploaded successfully.";
                    addElem($paID, 'doc', basename($file['name']), '');
                } else {
                    echo "Error uploading file.";
                }
            } elseif ($elementType === "text" && isset($_POST['textContent'])) {

                $textContent = $_POST['textContent'];
                $textType = $_POST['textType'];
                addElem($paID, 'txt', $textContent, $textType);
            } else {

                echo "Unsupported element type.";
            }
            header('Location: ?route=cours&page='.$_POST['paID'].'&addElement');
        }
    }

    if ($admin && isset($_GET['pageRemove'])) {
        removePage($_GET['pageRemove']);
        header('Location: ?route=cours&page='.$_GET['page']);
    }

    if (isset($_GET['page'])) {

        if ($admin && isset($_GET['removeElement'])) {
            removeElement($_GET['removeElement']);
            header('Location: ?route=cours&page='.$_GET['page']);
        }

        $titre = getTitre($_GET['page']);
        $cours = getAllElements($_GET['page']);
        include_once 'views/cours_page.php';

    } else {

        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
        
        $input =isset($_POST['input'])?$_POST['input']:'';

        echo '<section>',
        '<h1>Liste des Cours</h1>',
        '<div class="inline-searchbar"><input type="text" id="searchInput" oninput="getCours()" placeholder="Nom, Prenom, Titre, Niveau, ou Formation"></div>',
        '<table id="table_cours" class="table">';

        ?>
        <script>
            $(document).ready(function() {
                getCours();
            });
            function getCours() {
                var input = document.getElementById('searchInput').value;
                $.ajax({
                    url: 'ajax/coursAJAX.php',
                    method: 'POST',
                    data: { input: input },
                    success: function(response) {
                        $('#table_cours').html(response);
                    }
                });
            }
        </script>
        <?php
        
        echo '</table>',
        '</section>';

        $formations = getFormations();
        $niveaux = getNiveaux();
        $lstCours = getlstCours();
        include_once 'views/cours_index.php';
        
    }
    
    footer();
}

function coursRemover($paID): void {
    if (!$paID) {
        header('Location: index.php');
    }

    head('Suppression Cours');
    heading();
    nav();

    if (isset($_POST['btnRemove'])) {
        removePage($paID);
        header('Location: ?route=cours');
    } else {
        $page = getTitre($paID);
        include_once 'views/cours_remover.php';
    }

    footer();
}