<div class="wrap">
    <h1>Resilient Bits Plugin</h1>
    <?php settings_errors(); ?>

    <form action="options.php" method="post">
        <?php
            settings_fields('resilientbits_options_group');
            do_settings_sections('resilientbits_plugin');
            submit_button();
        ?>
    </form>
</div>