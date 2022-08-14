<?php

$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";
require_once $ABS_PATH_TO_BASE . "src/main/primary_layer.php";

function HV_aboutme_pl_description() {
    ob_start();
    ?>
    <!-- ******************* MAIN PL ABOUT ME ******************** -->
    <section class="about section">
        <div class="section-inner">
            <h2 class="heading">Description</h2>
            <div class="content">
                <p>I'm currently a PhD Student in computer science
                    at <a href="https://www.sorbonne-universite.fr/" target="_blank">Sorbonne Université</a>
                    (previously UPMC).
                    I am part of the <a href="https://team.inria.fr/delys/fr/" target="_blank">
                        Delys INRIA team</a> at Laboratoire d'Informatique de Paris 6
                    (<a href="https://lip6.fr" target="_blank">LIP6</a>), under the supervision
                    of <a href="https://pages.lip6.fr/Marc.Shapiro/" target="_blank">Marc Shapiro</a>.
                </p>
                <p>
                    My research interest is the design of highly available distributed systems, principally consistency protocols in case of replication between Datacenters and Edge devices.
                </p>
                <p>
                    My current thesis work is part of <a href="https://www.lightkone.eu/" target="_blank">LightKone EU Project</a>.
                </p>
            </div><!--//content-->
        </div><!--//section-inner-->
    </section><!--//section-->
    <!-- ******************* END MAIN PL ABOUT ME ******************** -->
    <?php
    return ob_get_clean();
}



function HV_aboutme_primary_layer() {
    ob_start();
    ?>
    <!-- ====================== MAIN PRIMARY LAYER ====================== -->
    <div class="primary col-md-8 col-sm-12 col-xs-12">
        <?php
        echo HV_aboutme_pl_description();
        echo HV_main_pl_work_experience();
        ?>
    </div><!--//primary-->
    <!-- ====================== END MAIN PRIMARY LAYER ====================== -->
    <?php
    return ob_get_clean();
}