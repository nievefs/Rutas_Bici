
<?php

// El html es basado en el tema twentytwenty

// Normalmente para sacar las ciudad correspondiente se usa  WP_Query para hacer los join
// pero en este caso lo hacemos sencillo pidiendo un array de ciudades
// cada elemento en la array tiene como key el ID de la ciudad
$cities = getCities();

// Pedimos el ID de la ciudada al cual corresponde esta ruta
$routeCityId = get_post_meta($post->ID, NAF_FIELD_PREFIX . 'city', true);

?>

    <h2><?= $post->post_title; ?></h2>
   
    <?php // Ahora aqui sacamos en el nombre de la ciudad utilizando el city ID que guardamos en la ruta ?>
    <p>ciudad: <?= $cities[$routeCityId]; // $cities[id] ?></p>
    <p>Km: <?= get_post_meta($post->ID, NAF_FIELD_PREFIX . 'km', true) ?></p>
    <p>Dificultad: <?= get_post_meta($post->ID, NAF_FIELD_PREFIX . 'difficulty', true) ?></p>
    <p>Puntuación: <?= get_post_meta($post->ID, NAF_FIELD_PREFIX . 'punctuation', true) ?></p>
