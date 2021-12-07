<?php

$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";
require_once $ABS_PATH_TO_BASE . "src/articles/articles_env.php";
require_once $ABS_PATH_TO_BASE . "src/articles/articles_api.php";
require_once $ABS_PATH_TO_BASE . "src/main/primary_layer.php";

function HV_thesis_pl_livestream_event()
{
    ob_start();
?>
    <!-- ******************* MAIN PL ABOUT ME ******************** -->
    <section class="about section">
        <div class="section-inner">
            <!-- <h2 class="heading">Description</h2> -->
            <div class="item featured text-center">
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-video"></i> The livestream video will start on this page on
                    <a href="#calendar-links">December 21, 2021 at 1:00 p.m.</a>
                </div>
                <h3 class="title">
                    Thesis Defense Live Video
                </h3>
                <div class="featured-image">
                    <a href="#" target="_blank">
                        <img class="img-responsive project-image" src="<?php echo PATH_IMG_ARTICLES . "/blogarticle_5_wide.png"; ?>" alt="2021_12_21 Thesis Defense" />
                    </a>
                    <!-- <div class="ribbon">
                        <div class="text">21/12/2021</div>
                    </div> -->
                </div>


                <p class="summary" id="calendar-links">
                    <i>Soutenance de thèse pour l'obtention du grade de
                        <br />docteur en informatique de Sorbonne Université</i>
                </p>

                <div class="desc text-left">
                    <p>
                    <h3 class="title">
                        Add this event to your calendar
                    </h3>
                    Add to your <a target="_blank" href="https://calendar.google.com/event?action=TEMPLATE&amp;tmeid=XzZwMjQyY2E2OGQxM2FiYTY2b3M0NGI5azcwcmowYjlwODkyajRiOW83NTFqMmhhMjcxMWthaGhpOGMgYnQ1ampzYWlvdWZlNHZnNDVyM3FtcGQwYm9AZw&amp;tmsrc=bt5jjsaioufe4vg45r3qmpd0bo%40group.calendar.google.com"><img border="0" src="https://www.google.com/calendar/images/ext/gc_button1_en.gif"></a>
                    <br />
                    or
                    <a class="btn btn-default btn-xs" href="<?php echo BASE_URL . '/data/ilyas-toumlilt-thesis-livestream.ics'; ?>" role="button">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Download ICS calendar event
                    </a>
                    </p>
                    <p>
                    <h3 class="title">
                        Description
                    </h3>
                    It is my pleasure to invite you to the livestream of my thesis defense,
                    completed within the <a href="https://lip6.fr" target="_blank">LIP6</a>
                    <a href="https://team.inria.fr/delys/fr/" target="_blank">Delys INRIA team</a>
                    and titled
                    "Colony: A Hybrid Consistency System for Highly-Available Collaborative Edge Computing".
                    <br />
                    The defense will be in english and take place on Tuesday, Decembre 21, 2021
                    at 13:00 (Paris Time).
                    </p>
                    <p>
                    <h3 class="title">
                        Jury Members
                    </h3>
                        <b>President:</b> <a href="http://valerie-issarny.me/">Valérie Issarny</a><br />
                        Senior Research Scientist, INRIA<br />
                        <br />
                        <b>Reviewer:</b> <a href="https://www.univ-smb.fr/listic/pages-fr/sebastien-monnet-fr/">Sébastien Monnet</a><br />
                        Full Professor, Université Savoie Mont Blanc<br />
                        <br />
                        <b>Reviewer:</b> <a href="https://cloudlargescale-uclouvain.github.io/Etienne_Riviere">Etienne Rivière</a><br />
                        Full Professor, UCLouvain<br />
                        <br />
                        <b>Examiner:</b> <a href="https://sites.google.com/site/soniabm/">Sonia Ben Mokhtar</a><br />
                        Senior Research Scientist, Laboratoire d'InfoRmatique en Image et Systèmes d’information<br />
                        <br />
                        <b>Examiner:</b> <a href="https://softech.informatik.uni-kl.de/homepage/de/staff/AnnetteBieniusa/">Annette Bieniusa</a><br />
                        Senior Research Scientist, Technische Universität Kaiserslautern<br />
                        <br />
                        <b>Supervisor:</b> <a href="https://lip6.fr/Marc.Shapiro/">Marc Shapiro</a><br />
                        Distinguished Research Scholar (Emeritus), Sorbonne Université, LIP6, INRIA<br />
                        <br />
                        <b>Invited:</b> <a href="https://sites.google.com/site/0track/">Pierre Sutra</a><br />
                        Associate Professor, Télécom SudParis<br />
                        <br />
                        <b>Invited:</b> <a href="https://pages.lip6.fr/Marek.Zawirski/">Marek Zawirski</a><br />
                        Software Engineer, Google<br />
                        <br />
                    <h3 class="title">
                        Abstract
                    </h3>
                    Edge applications, such as gaming, cooperative engineering, or in-the-field information sharing, enjoy immediate response, autonomy and availability by distributing and replicating data at the edge. However, application developers and users demand the highest possible consistency guarantees, and specific support for group collaboration. To address this challenge, Colony guarantees Transactional Causal Plus Consistency (TCC+) globally, strengthened to Snapshot Isolation within edge groups. To help with scalability, fault tolerance and security, its logical communication topology is forest-like, with replicated roots in the core cloud, but with the flexibility to migrate a node or a group. Despite this hybrid approach, applications enjoy the same semantics everywhere in the topology. Our experiments show that local caching and peer groups improve throughput and response time significantly, performance is not affected in offline mode, and that migration is seamless.
                    </p>
                </div>
                <!--//desc-->
            </div>
            <!--//item-->
        </div>
        <!--//section-inner-->
    </section>
    <!--//section-->
    <!-- ******************* END MAIN PL ABOUT ME ******************** -->
<?php
    return ob_get_clean();
}

function HV_thesis_pl_related_projects()
{
    ob_start();
?>
    <!-- ******************* LATEST ******************** -->
    <section class="latest section">
        <div class="section-inner">
            <h2 class="heading">Related Blog posts</h2>
            <div class="content">
                <?php
                echo article_xpath_to_wide_html(parse_article_xml(article_id_to_filepath(4)), false);
                ?>
                <hr class="divider">
                <?php
                echo article_xpath_to_wide_html(parse_article_xml(article_id_to_filepath(3)), false);
                ?>
                <hr class="divider">
                <?php
                echo article_xpath_to_wide_html(parse_article_xml(article_id_to_filepath(2)), false);
                ?>
                <hr class="divider">
                <?php
                echo article_xpath_to_wide_html(parse_article_xml(article_id_to_filepath(1)), false);
                ?>
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </section>
    <!-- ******************* END LATEST ******************** -->
<?php
    return ob_get_clean();
}

function HV_thesis_primary_layer()
{
    ob_start();
?>
    <!-- ====================== MAIN PRIMARY LAYER ====================== -->
    <div class="primary col-md-8 col-sm-12 col-xs-12">
        <?php
        echo HV_thesis_pl_livestream_event();
        echo HV_thesis_pl_related_projects();
        echo HV_main_pl_lab_contact();
        ?>
    </div>
    <!--//primary-->
    <!-- ====================== END MAIN PRIMARY LAYER ====================== -->
<?php
    return ob_get_clean();
}
