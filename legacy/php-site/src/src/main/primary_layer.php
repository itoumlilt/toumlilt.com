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
                echo article_xpath_to_wide_html(parse_article_xml(article_id_to_filepath(10)), false);
                ?>
                <hr class="divider">
                <?php
                echo article_xpath_to_wide_html(parse_article_xml(article_id_to_filepath(9)), false);
                ?>
                <hr class="divider">
                <?php
                echo article_xpath_to_small_html(parse_article_xml(article_id_to_filepath(8)), false);
                ?>
                <hr class="divider">
                <?php
                echo article_xpath_to_small_html(parse_article_xml(article_id_to_filepath(7)), false);
                ?>
                <hr class="divider">
                <?php
                echo article_xpath_to_small_html(parse_article_xml(article_id_to_filepath(6)), false);
                ?>

                <hr class="divider">
                <h4 class="title">
                    <a href="<?php echo URL_BLOG; ?>">
                        <i class="fas fa-external-link-alt"></i> See older articles and projects ...
                    </a>
                </h4>

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
                <!--//item: Concordant -->
                <div class="item">
                    <h3 class="title">Co-Founder, CTO - <span class="place"><a href="https://concordant.io" target="_blank">Concordant.io</a></span> <span class="year">(Sep 2019 - Mar 2022)</span></h3>
                    <p>
                        Started from a year doctoral internship, a start-up and entrepreneurship experience in the <a href="https://www.inria.fr/en/inria-startup-studio" target="_blank">Inria Startup Studio</a> incubator, building a local-first and large-scale data store from my thesis results. Then leading the project tech developpement in parallel to my thesis.
                    </p>
                    <p>
                    <a class="more-link" href="https://concordant.io" target="_blank">
                            <i class="fas fa-external-link-alt">.</i> Concordant Website</a>
                    </p>
                </div>
                <!--//item-->
                <!--//item: PhD Student -->
                <div class="item">
                    <h3 class="title">PhD Student - <span class="place"><a href="https://www.sorbonne-universite.fr/" target="_blank">Sorbonne University, LIP6, INRIA</a></span> <span class="year">(Jan 2017 - Dec 2021)</span></h3>
                    <p>
                        <i>Thesis:</i> Highly-available and consistent group collaboration at the edge with Colony.
                    </p>
                    <p>
                        My research work is on the design of highly available distributed systems, principally consistency protocols in case of replication between Datacenters and Edge Computing devices. Part of the RainbowFS French project and the LightKone EU Consortium.
                    </p>
                    <p>
                        <a class="more-link" href="/blog?article=10" target="_blank">
                            <i class="fas fa-external-link-alt">.</i> More about my thesis contributions</a>
                    </p>
                </div>
                <!--//item-->
                <!--//item: Teaching Assistant -->
                <div class="item">
                    <h3 class="title">Operating Systems Teacher - <span class="place"><a href="https://www.sorbonne-universite.fr/" target="_blank">Sorbonne University</a></span> <span class="year">(Jan 2017 - Dec 2021)</span></h3>
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
                    <h3 class="title">
                        Master Research Intern - <span class="place"><a href="http://www.lip6.fr/" target="_blank">LIP6, Regal Team </a></span> <span class="year">(Feb 2016 - August 2016)</span>
                    </h3>
                    <p>
                        First development experience within the Linux Kernel, providing a mechanism to properly and efficiently size the cache available in a container, by offering different heuristics to improve page age approximation, at an acceptable cost.
                    </p>
                </div>
                <!--//item-->
                <!--//item: Master 1 Internship-->
                <div class="item">
                    <h3 class="title">Experiments assistant Intern - <span class="place"><a href="http://www.lip6.fr/" target="_blank">LIP6, Whisper Team </a></span> <span class="year">(June 2015 - August 2015)</span></h3>
                    <p>
                        Calculation and optimisation of software load distribution on an automotive SabreLite MX6 board.
                    </p>
                </div>
                <!--//item-->

                <p>
                    <a class="btn btn-cta-secondary" href="<?php echo URL_LINKEDIN; ?>" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        More on my LinkedIn
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
        //echo HV_main_pl_work_experience();
        echo HV_main_pl_my_github();
        ?>
    </div>
    <!--//primary-->
    <!-- ====================== END MAIN PRIMARY LAYER ====================== -->
<?php
    return ob_get_clean();
}
