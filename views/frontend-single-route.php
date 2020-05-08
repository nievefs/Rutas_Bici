<?php

// El html es basado en el tema twentytwenty

// Normalmente para sacar las ciudad correspondiente utilzamos WP_Query para hacer los join
// pero en este caso lo hacemos sencillo pidiendo un array de ciudades
// cada elemento en la array tiene como key el ID de la ciudad
$cities = getCities();

// Pedimos el ID de la ciudada al cual corresponde esta ruta
$routeCityId = get_post_meta($post->ID, NAF_FIELD_PREFIX . 'city', true);


get_header(); ?>

<main id="site-content" role="main">

    <h2><?= $post->post_title; ?></h2>
    <?php if (get_option('naf_option_presentacion') == 'lista') : ?>
        <ul>
            <li>Km: <?= get_post_meta($post->ID, NAF_FIELD_PREFIX . 'km', true) ?></li>
            <?php // Ahora aqui sacamos en el nombre de la ciudad utilizando el city ID que guardamos en la ruta  ?>
            <li>ciudad: <?= $cities[$routeCityId]; // $cities[id] ?></li>
            <li>Dificultad: <?= get_post_meta($post->ID, NAF_FIELD_PREFIX . 'difficulty', true) ?></li>
            <li>Puntuación: <?= get_post_meta($post->ID, NAF_FIELD_PREFIX . 'punctuation', true) ?></li>
        </ul>
    <?php else : ?>
        <table>
            <tr>
                <th>Km</th>
                <th>Ciudad</th>
                <th>Dificultad</th>
                <th>Puntuación</th>
            </tr>
            <tr>
                <td><?= get_post_meta($post->ID, NAF_FIELD_PREFIX . 'km', true) ?></td>
                <td><?= $cities[$routeCityId]; // $cities[id] ?></td>
                <td><?= get_post_meta($post->ID, NAF_FIELD_PREFIX . 'difficulty', true) ?></td>
                <td><?= get_post_meta($post->ID, NAF_FIELD_PREFIX . 'punctuation', true) ?></td>
            </tr>
        </table>
    <?php endif; ?>

</main>

<?php get_footer(); ?>