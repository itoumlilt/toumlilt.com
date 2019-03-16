<?php
/**
 */
$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";
require_once $ABS_PATH_TO_BASE . "src/articles/articles_env.php";
require_once $ABS_PATH_TO_BASE . "src/articles/articles_api.php";

function HV_main_pl_about_me() {
    ob_start();
    ?>
    <!-- ******************* MAIN PL ABOUT ME ******************** -->
    <section class="about section">
        <div class="section-inner">
            <h2 class="heading">About Me</h2>
            <div class="content">
                <p>Hello World! Welcome to my personal website.</p>
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
                <a class="btn btn-cta-secondary"
                   href="<?php echo URL_ABOUT_ME; ?>"
                   target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    More details
                </a>
            </div><!--//content-->
        </div><!--//section-inner-->
    </section><!--//section-->
    <!-- ******************* END MAIN PL ABOUT ME ******************** -->
    <?php
    return ob_get_clean();
}

function HV_main_pl_lab_contact() {
    ob_start();
    ?>
    <!-- ******************* MAIN PL LAB CONTACT ******************** -->
    <section class="about section">
        <div class="section-inner">
            <h2 class="heading">Lab Contact</h2>
            <div class="content">
                <p>
                    <b>Address :</b><br/>
                    Ilyas Toumlilt<br/>
                    Campus Pierre et Marie Curie<br/>
                    Sorbonne Université - LIP6<br/>
                    Case Courrier 169<br/>
                    Tower 26-00, Floor 2, Office 234<br/>
                    4 Place Jussieu<br/>
                    75252 PARIS CEDEX 05<br/>
                    FRANCE<br/>
                </p>
                <p>
                    <b>Phone:</b> +33 (0)1 44 27 88 17<br/>
                    <b>Email:</b> ilyas.toumlilt (at) lip6.fr
                </p>
            </div><!--//content-->
        </div><!--//section-inner-->
    </section><!--//section-->
    <!-- ******************* END MAIN PL LAB CONTACT ******************** -->
    <?php
    return ob_get_clean();
}

function HV_main_pl_my_github() {
    ob_start();
    ?>
    <!-- ******************* MY GITHUB ******************** -->
    <section class="github section">
        <div class="section-inner">
            <h2 class="heading">My GitHub</h2>
            <!--
                      <p>You can embed your GitHub activities using Casey Scarborough's <a href="http://caseyscarborough.com/projects/github-activity/" target="_blank">GitHub Activity Stream</a> widget. You can also take a screenshot of your GitHub chart and put it here for fun.</p>
                    -->
            <p><a href="<?php echo URL_GITHUB;?>"><img class="img-responsive" src="<?php echo PATH_IMAGES . "/github-chart.png"?>" alt="GitHub Contributions Chart" /></a></p>
            <!--//Usage: http://caseyscarborough.com/projects/github-activity/ -->
            <div id="ghfeed" class="ghfeed">
            </div><!--//ghfeed-->

        </div><!--//secton-inner-->
    </section><!--//section-->
    <!-- ******************* END MY GITHUB ******************** -->
    <?php
    return ob_get_clean();
}

function HV_main_pl_latest_projects() {
    ob_start();
    ?>
    <!-- ******************* LATEST ******************** -->
    <section class="latest section">
    <div class="section-inner">
        <h2 class="heading">Latest Projects & Blog posts</h2>
        <div class="content">
            <?php
            echo article_xpath_to_wide_html(parse_article_xml(article_id_to_filepath(1)), false);
            ?>
            <hr class="divider">
            <div class="item row">
                <a class="col-md-4 col-sm-4 col-xs-12" href="https://github.com/tnajdek/angular-requirejs-seed" target="_blank">
                    <img class="img-responsive project-image" src="assets/images/projects/project-1.png" alt="project name">
                </a>
                <div class="desc col-md-8 col-sm-8 col-xs-12">
                    <h3 class="title"><a href="https://github.com/tnajdek/angular-requirejs-seed" target="_blank">Angular-RequireJS seed project</a> <span class="label label-theme">open source</span></h3>
                    <p>Running AngularJS paired up with RequireJS involves configuring few tweaks and hacks, especially if trying to preserve testability of Angular app. This seed project has been created to setup the entire front-end stack correctly and help developers get started with their projects.</p>
                    <p><a class="more-link" href="https://github.com/tnajdek/angular-requirejs-seed" target="_blank"><i class="fas fa-external-link-alt"></i> Find out more</a></p>
                </div><!--//desc-->
            </div><!--//item-->

            <div class="item row">
                <a class="col-md-4 col-sm-4 col-xs-12" href="http://gl.gg/" target="_blank">
                    <img class="img-responsive project-image" src="assets/images/projects/project-2.png" alt="project name">
                </a>
                <div class="desc col-md-8 col-sm-8 col-xs-12">
                    <h3 class="title"><a href="http://gl.gg/" target="_blank">GL &amp; GG [mvp]</a></h3>
                    <p>Simple web-based app that allows you to team up, organize and prepare for online, competetive gameplay. Implemented only to an MVP stage in order to test it with a small group of gamers, it has turned out to be impractical. Build with AngularJS and Semantic UI.</p>
                    <p><a class="more-link" href="http://gl.gg/" target="_blank"><i class="fas fa-external-link-alt"></i> Find out more</a></p>
                </div><!--//desc-->
            </div><!--//item-->

            <div class="item row">
                <a class="col-md-4 col-sm-4 col-xs-12" href="http://spellstack.com" target="_blank">
                    <img class="img-responsive project-image" src="assets/images/projects/project-3.png" alt="project name">
                </a>
                <div class="desc col-md-8 col-sm-8 col-xs-12">
                    <h3 class="title"><a href="http://spellstack.com" target="_blank">Spellstack</a></h3>
                    <p>Spellstack is a web-based toolset for Magic: The Gathering players. Using Spellstack users can put together a well-balanced, powerful deck for your next casual or tournament game. Additional tools such as random hand, statistics etc. help users evaluate deck's potential and performance.</p>
                    <p><a class="more-link" href="http://spellstack.com" target="_blank"><i class="fas fa-external-link-alt"></i> Find out more</a></p>
                </div><!--//desc-->
            </div><!--//item-->

        </div><!--//content-->
    </div><!--//section-inner-->
    </section>
    <!-- ******************* END LATEST ******************** -->
    <?php
    return ob_get_clean();
}

function HV_main_pl_work_experience() {
    ob_start();
    ?>
    <!-- ******************* WORK EXPERIENCE ******************** -->
    <section class="experience section">
    <div class="section-inner">
        <h2 class="heading">Work Experience</h2>
        <div class="content">
            <div class="item">
                <h3 class="title">PhD Student - <span class="place">Sorbonne Université, LIP6, INRIA</span> <span class="year">(Jan 2017 - Present)</span></h3>
                <p>
                    Cloud-scale services improve availability and latency by geo-replicating data in several data center across the world. Nevertheless, the closest data center is often still too far away for an optimal user experience. To remain available at all times, client-side applications need to cache data at client machines. This approach is used in many recent cloud services, where developers implement caching and buffering at application level, but it doesn’t ensure system-wide consistency guarantees.
                </p>
                <p>
                    My research work is on the design of highly available distributed systems, principally consistency protocols in case of replication between Datacenters and Edge Computing devices.
                </p>
                <p>
                    My current work is part of EU project LightKone that aims to develop a scientifically sound and industrially validated model for doing general-purpose computation on edge networks. An edge network consists of a large set of heterogeneous, loosely coupled computing nodes situated at the logical extreme of a network. Common examples are community networks and Internet of Things networks, and networks including mobile devices, personal computers, and points of presence including Mobile Edge Computing. Internet applications are increasingly running on edge networks, to reduce latency, increase scalability, resilience, and security, and permit local decision making.
                </p>
            </div><!--//item-->
            <div class="item">
                <h3 class="title">Teaching Assistant - <span class="place">Sorbonne Université</span> <span class="year">(Jan 2017 - Present)</span></h3>
                <p>
                    I teach the following courses:<br/>
                    - <a href="http://www-master.ufr-info-p6.jussieu.fr:8080/ue/2014/description.php?code_ue=4I405" target="_blank"> Security and System Administration (master 1).</a>(2017, 2018, 2019)<br/>
                    - <a href="http://www-master.ufr-info-p6.jussieu.fr:8080/ue/2014/description.php?code_ue=5I453" target="_blank">Multicore Kernels and Virtualisation (master 2)</a>, memory garbage collection part. (2018, 2019)<br/>
                    - <a href="http://www-licence.ufr-info-p6.jussieu.fr/lmd/licence/2018/ue/2I010-2019fev/" target="_blank">Introduction to operating systems (licence 2).</a> (2019)<br/>
                    - <a href="http://www-connex.lip6.fr/~guigue/wikihomepage/pmwiki.php?n=Course.CourseLI230" target="_blank">Introduction to Java langage (licence 2).</a> (2018)
                </p>
            </div><!--//item-->

            <div class="item">
                <h3 class="title">Internship - <span class="place"><a href="http://www.lip6.fr/" target="_blank">LIP6, Regal Team </a></span> <span class="year">(Feb 2016 - August 2016)</span></h3>
                <p>
                    Fighting fragmentation due to virtualization in the Linux kernel: working-sets size estimating.
                    Provide mechanisms, within the Linux kernel, to properly and efficiently size the cache available in a container, by offering different heuristics to improve page age approximation, at an acceptable cost.
                </p>
            </div><!--//item-->

            <div class="item">
                <h3 class="title">Internship - <span class="place"><a href="http://www.lip6.fr/" target="_blank">LIP6, Whisper Team </a></span> <span class="year">(June 2015 - August 2015)</span></h3>
                <p>
                    Calculation and optimisation of software load distribution on an embedded automotive board.
                    Linux Real-Time patches and Yocto recipes for SabreLite MX6 Board.
                </p>
            </div><!--//item-->

            <div class="item">
                <h3 class="title">Internship - <span class="place">COM</span> <span class="year">(June 2014 - August 2014)</span></h3>
                <p>Automating forms processing of market studies, from a web based application.</p>
            </div><!--//item-->

            <p>
                <a class="btn btn-cta-secondary"
                   href="<?php echo URL_LINKEDIN; ?>"
                   target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    More on LinkedIn
                </a></p>

        </div><!--//content-->
    </div><!--//section-inner-->
    </section>
    <!-- ******************* END WORK EXPERIENCE ******************** -->

    <?php
    return ob_get_clean();
}

function HV_main_primary_layer() {
    ob_start();
    ?>
    <!-- ====================== MAIN PRIMARY LAYER ====================== -->
    <div class="primary col-md-8 col-sm-12 col-xs-12">
        <?php
        echo HV_main_pl_about_me();
        echo HV_main_pl_latest_projects();
        echo HV_main_pl_work_experience();
        echo HV_main_pl_my_github();
        echo HV_main_pl_lab_contact();
        ?>
    </div><!--//primary-->
    <!-- ====================== END MAIN PRIMARY LAYER ====================== -->
    <?php
    return ob_get_clean();
}