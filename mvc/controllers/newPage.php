<?php
require_once "models/coursModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['lstT']) && isset($_POST['lstV'])) {
    var_dump($_POST);
    // Récupérer les valeurs envoyées
    $lstT = json_decode($_POST['lstT'], true); // true pour obtenir un tableau associatif
    $lstV = json_decode($_POST['lstV'], true);
    $lstF = json_decode($_POST['lstF'], true);
    $titre = $_POST['titre'];
    $categorie = $_POST['categorie'];
    $niveau = $_POST['niveau'];
    $cours = ModelCours::save($categorie, $niveau, $titre, $lstT, $lstV, $lstF);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des éléments à la page</title>
</head>
<body>
    <h1>Ajouter des éléments à la page</h1>
    <div>
        <label for="selection">Sélectionnez le type d'élément à ajouter</label>
        <select id="selection">
            <option value="image">Image</option>    
            <option value="texte">Texte</option>
            <option value="video">Vidéo</option>
        </select>
        <br>
        <label for="contenu">Contenu à ajouter (lien pour image et vidéo)</label>
        <br>
        <select id="texteOption" style="display: none" onchange="updateFormatage()">
            <option value="h1">Titre</option> 
            <option value="h2">Titre 2</option>
            <option value="p" selected>Corps</option>
        </select>
        <br>
        <input type="text" id="contenu">
        <textarea id="text" rows="10" cols="50" style="display: none"></textarea>
        <br>
        <button onclick="ajouterElement()">Ajouter</button>
    </div>
    <hr>
    <div id="show"></div>
    <hr>
    <div id="valide">
        <input type="button" value="Valider" onclick="test()" style="width: 49%;">
        <input type="button" value="Annuler" onclick="" style="width: 49%;">
    </div>

    <script>
        var lstT = [];
        var lstV = [];
        var lstF = [];
        var cpt = 0;
        var titre = '';
        var categorie = 0;
        var niveau = 'L1';

        function updateTitre() {
            titre = document.getElementById('titreInput').value;
        }

        function updateCategorie() {
            var selectElement = document.getElementById('categorieInput');
            if (selectElement) {
                categorie = selectElement.value;
            }
        }


        function updateNiveau() {
            var selectElement = document.getElementById('niveauInput');
            if (selectElement) {
                niveau = selectElement.value;
            }
        }

        function updateFormatage() {
            var format = document.getElementById('texteOption').value;
            lstF[cpt] = format?format:'p';
        }

        
        // Fonction pour modifier la taille de l'élément d'entrée en fonction du type d'élément sélectionné
        function modifierTailleInput() {
            var typeElement = document.getElementById('selection').value;

             // Si le type d'élément est du texte, augmentez la taille de l'entrée
            if (typeElement === 'texte') 
            {
                var lien = document.getElementById("contenu");
                var text =document.getElementById("text");
                lien.style.display = 'none';
                text.style.display = 'block';
                document.getElementById('texteOption').style.display = 'block';
            } 
            else 
            {
                var lien = document.getElementById("contenu");
                var text =document.getElementById("text");
                lien.style.display = 'block';
                text.style.display = 'none';
                document.getElementById('texteOption').style.display = 'none';
            }
        }   

        // Ajoutez un écouteur d'événements pour détecter les changements dans le menu déroulant
        document.getElementById('selection').addEventListener('change', modifierTailleInput);

        function extractVideoId(url) {
            var match = url.match(/[?&]v=([^&]+)/);
            return match && match[1];
        }

        // Fonction pour ajouter l'élément sélectionné à la page
        function ajouterElement() 
        {
            // Récupérer le type d'élément sélectionné dans le menu déroulant
            var typeElement = document.getElementById('selection').value;
            var contenu = document.getElementById('contenu').value;
            var text =document.getElementById('text').value;
            var show =document.getElementById('show');

            // Créer un nouvel élément en fonction du type sélectionné
            var nouvelElement;
            if (typeElement === 'texte')
            {
                nouvelElement = document.createElement('p');
                nouvelElement.textContent = text;
                lstT[cpt] = "txt";
                lstV[cpt] = text;
                cpt++;
            } 
            else if (typeElement === 'video') 
            {
                var videoId = extractVideoId(contenu);
                if(videoId)
                {
                    nouvelElement = document.createElement('iframe');
                    nouvelElement.setAttribute('src','https://www.youtube.com/embed/' + videoId);
                    nouvelElement.setAttribute('width', '560');
                    nouvelElement.setAttribute('height', '315');
                    nouvelElement.setAttribute('allowfullscreen', 'true');
                    nouvelElement.setAttribute('frameborder', '0');
                    lstT[cpt] = "vid";
                    lstV[cpt] = videoId;
                    cpt++;
                }
                else
                {
                    alert("rentrez un lien youtube valide");
                }
                
            } 
            else if (typeElement === 'image') 
            {
                nouvelElement = document.createElement('img');
                nouvelElement.src = contenu;
                nouvelElement.alt = 'erreur lien image';
                lstT[cpt] = "img" ;
                lstV[cpt] = encodeURIComponent(contenu);
                cpt++;
            }

            // Ajouter le nouvel élément à la page
            show.appendChild(nouvelElement);
            document.getElementById('contenu').value = "";
            document.getElementById('text').value = "";
        }

        function test()
        {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true); // Utilisez le même script PHP ('' représente la même page)
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send("lstT=" + JSON.stringify(lstT) + "&lstV=" + JSON.stringify(lstV) + "&lstF=" + JSON.stringify(lstF) + "&cpt=" + cpt + "&titre=" + titre + "&categorie=" + categorie + "&niveau=" + niveau);
        }
    </script>
    
</body>
</html>
