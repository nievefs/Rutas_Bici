

<?php if (get_option('naf_option_presentacion') == 'lista') : ?>
    <?php foreach($cityRoutes as $cityRoute): ?>
    <h4><?= $cityRoute['post_title'] ?> @ <?= $cityRoute['city'] ?></h4>
    <ul>
        <li>Km: <?= $cityRoute['km'] ?></li>
        <li>Dificultad: <?= $cityRoute['difficulty'] ?></li>
        <li>Puntuación: <?= $cityRoute['punctuaction'] ?></li>
    </ul>
    <?php endforeach; ?>
<?php else : ?>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Km</th>
            <th>Ciudad</th>
            <th>Dificultad</th>
            <th>Puntuación</th>
        </tr>
        <?php foreach($cityRoutes as $cityRoute): ?>
        <tr>
            <td><?= $cityRoute['post_title'] ?></td>
            <td><?= $cityRoute['km'] ?></td>
            <td><?= $cityRoute['city']; // $cities[id] ?></td>
            <td><?= $cityRoute['difficulty'] ?></td>
            <td><?= $cityRoute['punctuaction'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
