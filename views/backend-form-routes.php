<?php 
$valueCity = get_post_meta($post->ID, NAF_FIELD_PREFIX . 'city', true);
$valueKm = get_post_meta($post->ID, NAF_FIELD_PREFIX . 'km', true);
$valueDifficulty = get_post_meta($post->ID, NAF_FIELD_PREFIX . 'difficulty', true);
$valuePunctuation = get_post_meta($post->ID, NAF_FIELD_PREFIX . 'punctuation', true);
?>

<div>
    <!-- Añadimos un prefijo para evitar para hacer campos unicos. 
Porque pueden existir otros plugins que tambien tenga un campo con el nombre km -->

    <div class="field-group">
        <label for="<?= NAF_FIELD_PREFIX . 'city' ?>">Ciudad</label><br>
        <select name="<?= NAF_FIELD_PREFIX . 'city' ?>" id="<?= NAF_FIELD_PREFIX . 'city' ?>" class="postbox">
            <option value="">- Select a city of the route -</option>
            <?php foreach ($cities as $cityId => $cityName): ?>
                <option value="<?= $cityId ?>" <?= selected($valueCity, $cityId) // if ($cityId == $valueCityId) echo "selected"; ?>><?= $cityName ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="field-group">
        <label for="<?= NAF_FIELD_PREFIX . 'km' ?>">KM</label><br>
        <input type="text" 
            name="<?= NAF_FIELD_PREFIX . 'km' ?>" 
            id="<?= NAF_FIELD_PREFIX . 'km' ?>" 
            class="postbox"
            value="<?= $valueKm ?>">
    </div>
    <div class="field-group">
        <label for="<?= NAF_FIELD_PREFIX . 'difficulty' ?>">Dificultad</label><br>
        <input type="text" 
            name="<?= NAF_FIELD_PREFIX . 'difficulty' ?>" 
            id="<?= NAF_FIELD_PREFIX . 'difficulty' ?>" 
            class="postbox"
            value="<?= $valueDifficulty ?>">
    </div>
    <div class="field-group">
        <label for="<?= NAF_FIELD_PREFIX . 'punctuation' ?>">Puntuación</label><br>
        <input type="text" 
            name="<?= NAF_FIELD_PREFIX . 'punctuation' ?>" 
            id="<?= NAF_FIELD_PREFIX . 'punctuation' ?>" 
            class="postbox"
            value="<?= $valuePunctuation ?>">
    </div>
      
</div>

