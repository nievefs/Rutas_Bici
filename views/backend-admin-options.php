<div class="wrap">
    <h1>Rutas options</h1>
    <form action="options.php" method="post">
        <?php settings_fields(NAF_OPTIONS_GROUP); ?>
        <?php do_settings_sections(NAF_OPTIONS_GROUP); ?>
        <table class="form-table">
            <tr>
                <th>Presentacion ruta</th>
                <td>
                    <select name="naf_option_presentacion">
                        <option <?php selected(get_option('naf_option_presentacion'), 'tabla') ?>>tabla</option>
                        <option <?php selected(get_option('naf_option_presentacion'), 'lista') ?>>lista</option>
                    </select>
                </td>
            </tr>

        </table>
        <?php submit_button('Guardar cambios'); ?>
    </form>
</div>