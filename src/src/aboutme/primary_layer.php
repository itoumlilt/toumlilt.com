<?php

$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";
require_once $ABS_PATH_TO_BASE . "src/main/primary_layer.php";

function HV_aboutme_pl_description()
{
    ob_start();
?>
    <!-- ******************* MAIN PL ABOUT ME ******************** -->
    <section class="about section">
        <div class="section-inner">
            <h2 class="heading">Intro</h2>
            <div class="content">
                <p>Hello World! Welcome to my personal website.</p>
                <p>
                    I'm a Systems Software Engineer and a PhD in Distributed Systems;
                    My R&D topics concern the design of highly-available cloud and edge storage systems, data replication and consistency protocols, and the implementation of the Linux Kernel.
                    I made several Open Source contributions around these topics.
                </p>
                <p>
                    I teach Master and Licence Operating Systems lectures at
                    <a href="https://www.sorbonne-universite.fr/" target="_blank">Sorbonne University</a>.
                </p>
                <p>
                    I'm also a tech enthusiast,
                    knowledgeable about Blockchains
                    and a track and field athlete.
                </p>
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </section>
    <!--//section-->
    <!-- ******************* END MAIN PL ABOUT ME ******************** -->
<?php
    return ob_get_clean();
}



function HV_aboutme_primary_layer()
{
    ob_start();
?>
    <!-- ====================== MAIN PRIMARY LAYER ====================== -->
    <div class="primary col-md-8 col-sm-12 col-xs-12">
        <?php
        echo HV_aboutme_pl_description();
        echo HV_main_pl_work_experience();
        ?>
    </div>
    <!--//primary-->
    <!-- ====================== END MAIN PRIMARY LAYER ====================== -->
<?php
    return ob_get_clean();
}
