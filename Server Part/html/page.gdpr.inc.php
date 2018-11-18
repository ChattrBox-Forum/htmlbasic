<?php

    /*!
     * ifsoft.co.uk v1.1
     *
     * http://ifsoft.com.ua, http://ifsoft.co.uk
     * raccoonsquare@gmail.com
     *
     * Copyright 2012-2019 Demyanchuk Dmitry (raccoonsquare@gmail.com)
     */

    $page_id = "gdpr";

    $css_files = array("main.css", "my.css");
    $page_title = $LANG['page-gdpr']." | ".APP_TITLE;

    include_once("../html/common/header.inc.php");

    ?>

<body class="about">


    <?php
        include_once("../html/common/topbar.inc.php");
    ?>


    <div class="wrap content-page">

        <div class="main-column">

            <div class="main-content">

                <?php

                    if (file_exists("../html/gdpr/".$LANG['lang-code'].".inc.php")) {

                        include_once("../html/gdpr/".$LANG['lang-code'].".inc.php");

                    } else {

                        include_once("../html/gdpr/en.inc.php");
                    }
                ?>

            </div>

        </div>

        <?php

            include_once("../html/common/sidebar.inc.php");
        ?>

    </div>

    <?php

        include_once("../html/common/footer.inc.php");
    ?>


</body
</html>