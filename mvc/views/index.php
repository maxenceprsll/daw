<?php 
//Maxence Persello

echo    '<section>',
        '<h2>Annonces du site</h2>',
        '<p>C\'est bien vide ici...</p>',
    '</section>',
    '<section>',
        '<h2>Forum</h2>',
        '<p>C\'est bien vide ici...</p>',
    '</section>',
    '<section>',
        '<div class="carousel">',
            '<a class="prev" onclick="changeSlides(-1)">&#10094;</a>',
            '<img src="img/BanniereSOS.png" alt="Slide 1" class="slides">',
            '<img src="img/BanniereSup.png" alt="Slide 2" class="slides">',
            '<img src="img/BanniereEtreEtudiant.jpeg" alt="Slide 3" class="slides">',
            '<a class="next" onclick="changeSlides(1)">&#10095;</a>',
        '</div>',
    '</section>',
    '<script>',
    'var slideIndex = 1;',
    'showSlides(slideIndex);',

    'function changeSlides(n) {',
        'showSlides(slideIndex += n);',
    '}',

    'function showSlides(n) {',
        'var i;',
        'var slides = document.getElementsByClassName("slides");',
        'if (n > slides.length) {slideIndex = 1}',
        'if (n < 1) {slideIndex = slides.length}',
        'for (i = 0; i < slides.length; i++) {',
            'slides[i].style.display = "none";',
        '}',
        'slides[slideIndex-1].style.display = "block";',
    '}',
    '</script>';