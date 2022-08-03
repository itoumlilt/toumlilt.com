<?php

/**
 */
$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";
require_once $ABS_PATH_TO_BASE . "src/articles/articles_env.php";
require_once $ABS_PATH_TO_BASE . "src/articles/articles_api.php";

function HV_main_pl_about_me()
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
                <p>
                    <a class="btn btn-cta-secondary" href="<?php echo URL_ABOUT_ME; ?>" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        More details about me
                    </a>
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

function HV_main_pl_my_github()
{
    ob_start();
?>
    <!-- ******************* MY GITHUB ******************** -->
    <section class="github section">
        <div class="section-inner">
            <h2 class="heading">My GitHub</h2>
            <!--
                      <p>You can embed your GitHub activities using Casey Scarborough's <a href="http://caseyscarborough.com/projects/github-activity/" target="_blank">GitHub Activity Stream</a> widget. You can also take a screenshot of your GitHub chart and put it here for fun.</p>
                    -->
            <p><a href="<?php echo URL_GITHUB; ?>"><img class="img-responsive" src="<?php echo PATH_IMAGES . "/github-chart.png" ?>" alt="GitHub Contributions Chart" /></a></p>
            <!--//Usage: http://caseyscarborough.com/projects/github-activity/ -->
            <div id="ghfeed" class="ghfeed">
            </div>
            <!--//ghfeed-->

        </div>
        <!--//secton-inner-->
    </section>
    <!--//section-->
    <!-- ******************* END MY GITHUB ******************** -->
<?php
    return ob_get_clean();
}

function HV_main_pl_latest_projects()
{
    ob_start();
?>
    <!-- ******************* LATEST ******************** -->
    <section class="latest section">
        <div class="section-inner">
            <h2 class="heading">Latest Projects & Blog posts</h2>
            <div class="content">
                <?php
                echo article_xpath_to_wide_html(parse_article_xml(article_id_to_filepath(5)), false);
                ?>
                <hr class="divider">
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
                <hr class="divider">
                <!-- //item: The concordant platform -->
                <div class="item row">
                    <a class="col-md-4 col-sm-4 col-xs-12" href="https://concordant.io" target="_blank">
                        <img class="img-responsive project-image" src="assets/images/projects/project-concordant.png" alt="project name">
                    </a>
                    <div class="desc col-md-8 col-sm-8 col-xs-12">
                        <h3 class="title"><a href="https://concordant.io" target="_blank">The Concordant Platform</a> <span class="label label-theme">open source</span></h3>
                        <p>
                            Build mobile, edge, and collaborative applications that just work, anywhere across the edge-cloud spectrum, seamlessly whether connected or not. Choose your deployment, in the cloud or on-premise; Concordant maintains app consistency and keeps it up and running. Develop applications quickly, with a single code base for multiple devices. Reduce time to market, and focus on your customers' needs.
                        </p>
                        <p><a class="more-link" href="https://concordant.io" target="_blank"><i class="fas fa-external-link-alt"></i> Find out more</a></p>
                    </div>
                    <!--//desc-->
                </div>
                <!--//item-->

                <!--//item: MD Editor -->
                <div class="item row">
                    <a class="col-md-4 col-sm-4 col-xs-12" href="https://github.com/itoumlilt/crdt-md-editor" target="_blank">
                        <img class="img-responsive project-image" src="assets/images/projects/project-crdt-mded.png" alt="project name">
                    </a>
                    <div class="desc col-md-8 col-sm-8 col-xs-12">
                        <h3 class="title">
                            <a href="https://github.com/itoumlilt/crdt-md-editor" target="_blank">CRDT Markdown Editor</a>
                            <span class="label label-theme">open source</span>
                        </h3>
                        <p>
                            Collaborative text editing application using two eventual consitency backends: revision-based and CRDT-based. This demo shows that with a revision based approach, the user loses updates, either if updates are executed concurrently online, or if multiple users edit the document offline. To have an adequate semantics, the user needs to provide custom, non-trivial, code to merge the updates executed by each user. With the CRDT-based backend, update convergence is available out-of-the-box.
                        </p>
                        <p><a class="more-link" href="https://github.com/itoumlilt/crdt-md-editor" target="_blank"><i class="fas fa-external-link-alt"></i> Find out more</a></p>
                    </div>
                    <!--//desc-->
                </div>
                <!--//item-->

                <!-- //item: antidoteDB -->
                <div class="item row">
                    <a class="col-md-4 col-sm-4 col-xs-12" href="https://www.antidotedb.eu/" target="_blank">
                        <img class="img-responsive project-image" src="assets/images/projects/project-antidotedb.png" alt="project name">
                    </a>
                    <div class="desc col-md-8 col-sm-8 col-xs-12">
                        <h3 class="title">
                            <a href="https://www.antidotedb.eu/" target="_blank">AntidoteDB</a>
                            <span class="label label-theme">open source</span>
                        </h3>
                        <p>
                            AntidoteDB is a highly available geo-replicated key-value database. AntidoteDB provides features that help programmers to write correct applications while having the same performance and horizontal scalability as AP/NoSQL databases. Furthermore, AntidoteDB operations are based on the principle of synchronization-free execution by using Conflict-free replicated datatypes (CRDTs).
                        </p>
                        <p><a class="more-link" href="https://www.antidotedb.eu/" target="_blank"><i class="fas fa-external-link-alt"></i> Find out more</a></p>
                    </div>
                    <!--//desc-->
                </div>
                <!--//item-->

            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </section>
    <!-- ******************* END LATEST ******************** -->
<?php
    return ob_get_clean();
}

function HV_main_pl_work_experience()
{
    ob_start();
?>
    <!-- ******************* WORK EXPERIENCE ******************** -->
    <section class="experience section">
        <div class="section-inner">
            <h2 class="heading">Work Experience</h2>
            <div class="content">
                <!--//item: PhD Student -->
                <div class="item">
                    <h3 class="title">PhD Student - <span class="place">Sorbonne Université, LIP6, INRIA</span> <span class="year">(Jan 2017 - Present)</span></h3>
                    <p>
                        My research work is on the design of highly available distributed systems, principally consistency protocols in case of replication between Datacenters and Edge Computing devices. Part of the LightKone EU Project.
                        Advisor: Marc Shapiro
                    </p>
                </div>
                <!--//item-->
                <!--//item: Thesis Internship -->
                <div class="item">
                    <h3 class="title">Thesis Internship, Senior Software Developer - <span class="place">Concordant</span> <span class="year">(Sep 2019 - Aug 2020)</span></h3>
                    <p>
                        Doctoral internship, start-up and entrepreneurship experience in the Inria Startup Studio incubator.
                    </p>
                    <p>
                        Design and development of an innovative Mobile Backend-as-a-Service platform that facilitates the develop- ment of powerful mobile edge applications deployed independently of the Cloud.
                        First experience building a new startup product, the Concordant platform.
                    </p>
                </div>
                <!--//item-->
                <!--//item: Teaching Assistant -->
                <div class="item">
                    <h3 class="title">Teaching Assistant - <span class="place">Sorbonne Université</span> <span class="year">(Jan 2017 - Present)</span></h3>
                    <p>
                        I teach the following courses:<br />
                        - <a href="https://moodle-sciences.upmc.fr/moodle-2020/course/info.php?id=4539&lang=en" target="_blank"> Programming inside the Linux Kernel (master 1).</a>(2021)<br />
                        - <a href="http://www-master.ufr-info-p6.jussieu.fr:8080/ue/2014/description.php?code_ue=5I453" target="_blank">Multicore Kernels and Virtualisation (master 2)</a>, memory garbage collection part. (2018, 2019, 2020)<br />
                        - <a href="http://www-master.ufr-info-p6.jussieu.fr:8080/ue/2014/description.php?code_ue=4I405" target="_blank"> Security and System Administration (master 1).</a>(2017, 2018, 2019)<br />
                        - <a href="http://www-licence.ufr-info-p6.jussieu.fr/lmd/licence/2018/ue/2I010-2019fev/" target="_blank">Introduction to operating systems (licence 2).</a> (2019)<br />
                        - <a href="http://www-connex.lip6.fr/~guigue/wikihomepage/pmwiki.php?n=Course.CourseLI230" target="_blank">Introduction to Java langage (licence 2).</a> (2018)
                    </p>
                </div>
                <!--//item-->
                <!--//item: Master 2 Internship-->
                <div class="item">
                    <h3 class="title">Master Internship - <span class="place"><a href="http://www.lip6.fr/" target="_blank">LIP6, Regal Team </a></span> <span class="year">(Feb 2016 - August 2016)</span></h3>
                    <p>
                        First development experience within the Linux Kernel, providing a mechanism to properly and efficiently size the cache available in a container, by offering different heuristics to improve page age approximation, at an acceptable cost.
                    </p>
                </div>
                <!--//item-->
                <!--//item: Master 1 Internship-->
                <div class="item">
                    <h3 class="title">Summer Internship - <span class="place"><a href="http://www.lip6.fr/" target="_blank">LIP6, Whisper Team </a></span> <span class="year">(June 2015 - August 2015)</span></h3>
                    <p>
                        First embedded systems experience, calculation and optimisation of software load distribution on an automotive SabreLite MX6 board.
                    </p>
                </div>
                <!--//item-->
                <!--//item: COM Internship-->
                <div class="item">
                    <h3 class="title">Internship - <span class="place">COM</span> <span class="year">(June 2014 - August 2014)</span></h3>
                    <p>Automating forms processing of market studies, from a web based application.</p>
                </div>
                <!--//item-->

                <p>
                    <a class="btn btn-cta-secondary" href="<?php echo URL_LINKEDIN; ?>" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        More on LinkedIn
                    </a>
                </p>

            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </section>
    <!-- ******************* END WORK EXPERIENCE ******************** -->

<?php
    return ob_get_clean();
}

function HV_main_primary_layer()
{
    ob_start();
?>
    <!-- ====================== MAIN PRIMARY LAYER ====================== -->
    <div class="primary col-md-8 col-sm-12 col-xs-12">
        <?php
        echo HV_main_pl_about_me();
        echo HV_main_pl_latest_projects();
        echo HV_main_pl_work_experience();
        echo HV_main_pl_my_github();
        ?>
    </div>
    <!--//primary-->
    <!-- ====================== END MAIN PRIMARY LAYER ====================== -->
<?php
    return ob_get_clean();
}
