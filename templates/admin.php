<div class="wrap">
    <h1>Resilient Bits Plugin</h1>
    <?php settings_errors(); ?>
    
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-1">Manage Settings</a></li>
        <li><a href="#tab-2">Updates</a></li>
        <li><a href="#tab-3">About</a></li>
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <form action="options.php" method="post">
                <?php
                    settings_fields('resilientbits_options_group');
                    do_settings_sections('resilientbits_plugin');
                    submit_button();
                ?>
            </form>
        </div>

        <div id="tab-2" class="tab-pane">
            <h3>Updates</h3>
        </div>

        <div id="tab-3" class="tab-pane">
            <h3>About</h3>
            <p>
                We are a small but highly productive software agency focused on web application development.
                Our services include development of:
            </p>
            <ul>
                <li>WordPress Websites</li>
                <li>Online Stores & E-Commerce</li>
                <li>REST APIs</li>
                <li>PWAs</li>
            </ul>
            <div class="info">
                <p class="title">Resilient Bits Tech</p>
                <p class="caption">Software & Data Consultants</p>
                <p>Visit us on:</p>
                <p>
                    <ul>
                        <li><a href="https://resilientbits.github.io">Web</a></li>
                        <li><a href="https://resilientbits.github.io">GitHub</a></li>
                    </ul>
                </p>
            </div>
        </div>
    </div>

</div>