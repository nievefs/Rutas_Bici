<?php

/**
 * Plugin Name: Rutas_Bici_NAFS
 * Plugin URI: https://example.com
 * Drescription: Rutas de bicicletas en Catalunya
 * Version: 1.0.0
 * Author: Nieve Fernández Salazar
 * Authot: https://example.com
 * License: GPL2
 */

define('NAF_FIELD_PREFIX', 'naf_');
define('NAF_VIEWS_PATH', __DIR__ . '/views');


/**
 * Enseña los campos extras para el CPT Rutas
 */
function display_route_meta_boxes($post){
    $cities = getCities();
    include __DIR__ . '/views/backend-form-routes.php';
}

function getCities(){
    $posts = get_posts(['post_type' => 'city']);
    $cities = [];
    foreach ($posts as $city) {
        $cities[$city->ID] = $city->post_title;
    }
    return $cities;
}

/**
 * AÑADIENDO CUSTOM POST TYPES PARA LAS RUTAS Y CIUDADES
 */
add_action('init', function () {

    // Registracion de rutas juntos con los metaboxes
    register_post_type('route', [ //---->funcion que añade CPT Rutas
        'labels' => [
            'name' => 'Rutas de Bici',
            'singular_name' => 'Route',
            'plural_name' => 'Routes',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'routes'),
        'supports' => array('title'),

        // Añadir meta boxes para rutas
        'register_meta_box_cb' => function () {
            add_meta_box('routes-meta-box', 'Extra information', 'display_route_meta_boxes', 'route', 'normal');
        },
    ]);

    // Registration de city sin metaboxes
    register_post_type('city', [ //----->funcion que añade CPT ciudades de las Rutas
        'labels' => [
            'name' => 'Ciudades',
            'singular_name' => 'City',
            'plural_name' => 'Cieties',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => array('title'),
    ]);
});

/**
 * Guardar valores de campos extra en rutas cuando el custom post type ejecuta la action 'save_post'
 */
add_action('save_post', function ($post_id) {

    if (!array_key_exists(NAF_FIELD_PREFIX . 'km', $_POST)) {
        return;
    }

    update_post_meta(
        $post_id,
        NAF_FIELD_PREFIX . 'city', // naf_city
        sanitize_text_field($_POST[NAF_FIELD_PREFIX . 'city']) 
    );
    update_post_meta(
        $post_id,
        NAF_FIELD_PREFIX . 'km', // naf_km
        sanitize_text_field($_POST[NAF_FIELD_PREFIX . 'km'])
    );
    update_post_meta(
        $post_id,
        NAF_FIELD_PREFIX . 'difficulty', // naf_difficulty
        sanitize_text_field($_POST[NAF_FIELD_PREFIX . 'difficulty']) 
    );
    update_post_meta(
        $post_id,
        NAF_FIELD_PREFIX . 'punctuation', // naf_punctuation
        sanitize_text_field($_POST[NAF_FIELD_PREFIX . 'punctuation']) 
    );
});


/**
 * Shortcode
 */
function get_inf_post_types(){
    //echo "hola";  
    return NAF_VIEWS_PATH . '/shortcode.php';       
}
add_shortcode('Listado_Rutas_Bicis','get_inf_post_types');


/**
 * Template  
 */ 
add_filter('single_template', function ($single) {
    global $post;

    // si el post que vamos a  imprimir es de tipo route usamos la template 
    if ($post->post_type === 'route' && file_exists(NAF_VIEWS_PATH . '/frontend-single-route.php')) {
        return NAF_VIEWS_PATH . '/frontend-single-route.php';
    }

    return $single;
});


// Cuando tenemos un CPT  wordpress chequea si tenmos un plantila definida en el tema activo.
// Sino existe carga el estandar que tiene el tema activo, osea single.php



// --create extra campos para rutas: km, puntuacion, etc
// utilizar add_meta_box
// add_meta_box('mb_rutas', 'Campos Extra', function() {
//     echo  'Km: <input type="text" value="">';
// }, 'rutas');

// --cada vez que guardas el post type, aplicar un hook 'save_post'
// para guardar los campos extra

// --crear shorcode con nombre de ruta y kilometros
// en la function de shortcode pedir posts info de Kms
// con el while loop presentar la información


// --crear shorcode rutas decada CPT
// en la function de shortcode pedir posts del tipo rutas
// con el while loop presentar las rutas



/*
Tipos de Ruta en Bici en Terrassa:
    1.-Rutas mountain bike ( id, ruta, distancia, dificultad, puntuación 0-5)
   Terrassa-Vic                  77,49Km    moderada        3 
   Terrassa-Castell de Gallifa   51,76Km    moderada        4 
   Terrassa-Sabadell             32,65Km    moderada        3 
   Terrassa-Ruta Verde(urbana)   20,52Km    fácil           4

   2.-Rutas ciclismo  (id ruta, distancia, dificultad, puntuación 0-5)
   Terrassa-Andorra           194,55Km    difícil       3 
   El Brull por el MOnstseny  153,59Km    moderada      5
   Terrassa-Tibidabo           64,36Km    moderada      4 
   Terrassa-Castelltallat     138,01Km    difícil       3 

   3.-Rutas ciclo Turismo  (id ruta, distancia, dificultad, puntuación 0-5)
   Terrassa-Castelldefels          99,98Km     fácil        4 
   Ruta de las Paparoles           15,31Km     moderada     4 
   Terrassa-bicicletada turística  16,09Km     fácil        5
   Terrassa-San Cugat              31,6Km      fácil        5 

*/


// Links de ayuda para la práctica:********************************************
// https://es.wikiloc.com/rutas/ciclismo/espana/catalunya/terrassa
// https://wordpress.org/support/article/post-types/
// https://developer.wordpress.org/reference/functions/register_post_type/
// https://wordpress.org/plugins/custom-post-types/
// https://developer.wordpress.org/reference/functions/add_meta_box/
