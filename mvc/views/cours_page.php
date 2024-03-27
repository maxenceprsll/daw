<?php // Maxence Persello & Alexis

echo '<section id="cours">',
    '<h1>'.$titre['paTitre'].'</h1>';

foreach ($cours as $objet) {
    echo '<div class="cours-elem">';

    if ($admin) {
        echo '<a href="?route=cours&page='.$_GET['page'].'&removeElement='.$objet['elID'].'" class="remove-link">&times;</a>';
    }
    switch ($objet['elType']) {
        case "txt":
            echo "<".$objet['elFormat'].">".$objet['elContenu']."</".$objet['elFormat'].">";
            break;
        default:
            echo "<a href=import/".$objet['elCoursID']."/".$objet['elContenu'].">".$objet['elContenu']."</a>";
    }

    echo '</div>';

}
echo '</section>';

if ($admin) {
    if (isset($_GET['addElement'])) {
        echo '<section class="add-element">',
            '<h2>Ajouter un élément au cours</h2>',
            '<form action="?route=cours&page='.$_GET['page'].'&saveElement" method="post" enctype="multipart/form-data">',
                '<input type="hidden" name="paID" value="'.$_GET['page'].'">',
                '<label for="elementType">Type d\'élément</label>',
                '<select name="elementType" id="elementType" onchange="toggleInput()">',
                    '<option value="text" selected>Texte</option>',
                    '<option value="file">Fichier</option>',
                '</select>',
                '<div id="textTypeInput" class=element-input">',
                    '<label for="textType">Formatage</label>',
                    '<select name="textType" id="textType">',
                        '<option value="h2">Titre 2</option>',
                        '<option value="h3">Titre 3</option>',
                        '<option value="p" selected>Corps</option>',
                    '</select>',
                '</div>',
                '<div id="textInput" class="element-input">',
                    '<label for="textContent">Contenu texte</label>',
                    '<textarea name="textContent" id="textContent" cols="30" rows="10"></textarea>',
                '</div>',
                '<div id="fileInput" class="element-input" style="display: none;">',
                    '<label id="fileInputLabel" for="fileContent">Sélectionnez un fichier</label>',
                    '<input type="file" name="fileContent" id="fileContent">',
                '</div>',
                '<input type="submit" name="saveElement" value="Ajouter"/>',
            '</form>',
        '</section>';

    } else {
        echo '<a href="?route=cours&page='.$_GET['page'].'&addElement" class="button">Ajouter un élément</a>';
    }
}

?>

<script>
    function toggleInput() {
        var elementType = document.getElementById("elementType").value;
        var textInput = document.getElementById("textInput");
        var textType = document.getElementById("textTypeInput");
        var fileInput = document.getElementById("fileInput");

        if (elementType === "text") {
            textInput.style.display = "block";
            textType.style.display = "block";
            fileInput.style.display = "none";
        } else if (elementType === "file") {
            textInput.style.display = "none";
            textType.style.display = "none";
            fileInput.style.display = "block";
        }
    }
</script>