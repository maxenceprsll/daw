<?php // Maxence Persello & Alexis

echo '<section id="cours">',
    '<h1>'.$titre['paTitre'].'</h1>';
foreach ($cours as $objet) {
    switch ($objet['elType']) {
        case "txt":
            echo "<".$objet['elFormat'].">".$objet['elContenu']."</".$objet['elFormat'].">";
            break;
        case "vid":
            echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/".$objet['elContenu']."' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>";
            break;
        case "img":
            echo "<img src='".$objet['elContenu']."' alt='Lien de l'image Faux'>";
    }
}
echo '</section>';