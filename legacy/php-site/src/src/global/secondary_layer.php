<?php

$PATH_TO_BASE = "../../";

$ABS_PATH_TO_BASE = dirname(__FILE__) . "/" . $PATH_TO_BASE;
require_once $ABS_PATH_TO_BASE . "include/global_env.php";

function htmlview_sl_basic_information()
{
    ob_start();
?>
    <!-- ******************* SL BASIC INFORMATION ******************** -->
    <aside class="info aside section">
        <div class="section-inner">
            <h2 class="heading sr-only">Lab Contact</h2>
            <div class="content">
                <ul class="list-unstyled">
                    <li><i class="fas fa-envelope"></i><span class="sr-only">Email:</span><a href="mailto:<?php echo EMAIL_DEFAULT; ?>">ilyas (at) toumlilt.com</a></li>
                    <li><i class="fas fa-phone"></i><span class="sr-only">Phone:</span>+33 (0)1 44 27 88 17</li>
                    <li>
                        <i class="fas fa-map-marker"></i><span class="sr-only">Location:</span>
                        Ilyas Toumlilt<br />
                        <span style="display:inline-block; width: 26px;"></span>Campus Pierre et Marie Curie<br />
                        <span style="display:inline-block; width: 26px;"></span>Sorbonne Université - LIP6<br />
                        <span style="display:inline-block; width: 26px;"></span>Case Courrier 169<br />
                        <span style="display:inline-block; width: 26px;"></span>Tower 26-00, Floor 2, Office 234<br />
                        <span style="display:inline-block; width: 26px;"></span>4 Place Jussieu<br />
                        <span style="display:inline-block; width: 26px;"></span>75252 PARIS CEDEX 05<br />
                        <span style="display:inline-block; width: 26px;"></span>FRANCE<br />
                    </li>
                    <li><i class="fas fa-link"></i><span class="sr-only">Website:</span><a href="<?php echo BASE_URL; ?>"><?php echo BASE_URL; ?></a></li>
                </ul>
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </aside>
    <!--//aside-->
    <!-- ******************* END SL BASIC INFORMATION ******************** -->
<?php
    return ob_get_clean();
}

function htmlview_sl_education()
{
    ob_start();
?>
    <!-- ******************* SL EDUCATION ******************** -->
    <aside class="education aside section">
        <div class="section-inner">
            <h2 class="heading">Education</h2>
            <div class="content">
                <div class="item">
                    <!-- PhD -->
                    <h3 class="title"><i class="fas fa-graduation-cap"></i> PhD - Distributed and Operating Systems</h3>
                    <h4 class="university">Sorbonne University, LIP6, INRIA <span class="year">(2017 - 2021)</span></h4>
                    <!-- Master -->
                    <h3 class="title"><i class="fas fa-graduation-cap"></i> Master - Distributed Systems and Applications</h3>
                    <h4 class="university">Sorbonne University (previously UPMC) <span class="year">(2014-2016)</span></h4>
                    <!-- Licence -->
                    <h3 class="title"><i class="fas fa-graduation-cap"></i> Licence - Computer Science</h3>
                    <h4 class="university">Sorbonne University (previously UPMC) <span class="year">(2011-2014)</span></h4>
                </div>
                <!--//item-->
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </aside>
    <!--//section-->
    <!-- ******************* END SL EDUCATION ******************** -->
<?php
    return ob_get_clean();
}

function htmlview_sl_langages()
{
    ob_start();
?>
    <!-- ******************* SL LANGUAGES ******************** -->
    <aside class="languages aside section">
        <div class="section-inner">
            <h2 class="heading">Languages</h2>
            <div class="content">
                <ul class="list-unstyled">
                    <li class="item">
                        <span class="title"><strong>French:</strong></span>
                        <span class="level">Native Speaker <br class="visible-xs" /><i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> </span>
                    </li>
                    <!--//item-->
                    <li class="item">
                        <span class="title"><strong>Arabic:</strong></span>
                        <span class="level">Native Speaker <br class="visible-xs" /><i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> </span>
                    </li>
                    <!--//item-->
                    <li class="item">
                        <span class="title"><strong>English:</strong></span>
                        <span class="level">Professional Proficiency <br class="visible-xs" /><i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star-half"></i> </span>
                    </li>
                    <!--//item-->
                    <li class="item">
                        <span class="title"><strong>Spanish:</strong></span>
                        <span class="level">Beginner <br class="visible-sm visible-xs" /><i class="fas fa-star"></i> <i class="fas fa-star-half"></i></span>
                    </li>
                    <!--//item-->
                </ul>
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </aside>
    <!--//section-->
    <!-- ******************* END SL LANGUAGES ******************** -->
<?php
    return ob_get_clean();
}

function htmlview_sl_profils()
{
    ob_start();
?>
    <!-- ******************* SL PROFILS ******************** -->
    <aside class="credits aside section">
        <div class="section-inner">
            <h2 class="heading">Web Profils</h2>
            <div class="content">
                <ul class="list-unstyled">
                    <!-- Github -->
                    <li>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="fa-brands fa-github"></i>
                            </div>
                            <div class="col-md-10">
                                <a href="https://github.com/itoumlilt" target="_blank">
                                    Github
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- Gitlab -->
                    <li>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="fa-brands fa-gitlab"></i>
                            </div>
                            <div class="col-md-10">
                                <a href="https://gitlab.com/itoumlilt" target="_blank">
                                    Gitlab
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- Google Scholar -->
                    <li>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="fa-brands fa-google"></i>
                            </div>
                            <div class="col-md-10">
                                <a href="https://scholar.google.fr/citations?user=067J9hgAAAAJ&hl=en" target="_blank">
                                    Google Scholar
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- Instagram -->
                    <li>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="fa-brands fa-instagram"></i>
                            </div>
                            <div class="col-md-10">
                                <a href="https://www.instagram.com/ilyas.tw/" target="_blank">
                                    Instagram
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- LinkedIn -->
                    <li>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="fa-brands fa-linkedin"></i>
                            </div>
                            <div class="col-md-10">
                                <a href="https://www.linkedin.com/in/ilyastoumlilt/" target="_blank">
                                    LinkedIn
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- Medium -->
                    <li>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="fa-brands fa-medium"></i>
                            </div>
                            <div class="col-md-10">
                                <a href="https://itoumlilt.medium.com/" target="_blank">
                                    Medium
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- ReasearchGate -->
                    <li>
                        <div class="row">
                            <div class="col-md-1">
                            <i class="fa-brands fa-researchgate"></i>
                            </div>
                            <div class="col-md-10">
                                <a href="https://www.researchgate.net/profile/Ilyas-Toumlilt" target="_blank">
                                    Research Gate
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- Strava -->
                    <li>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="fa-brands fa-strava"></i>
                            </div>
                            <div class="col-md-10">
                                <a href="https://www.strava.com/athletes/22914252" target="_blank">
                                    Strava
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- Twitter -->
                    <li>
                        <div class="row">
                            <div class="col-md-1">
                                <i class="fa-brands fa-twitter"></i>
                            </div>
                            <div class="col-md-10">
                                <a href="https://twitter.com/ilyasToumlilt" target="_blank">
                                    Twitter
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </aside>
    <!--//section-->
    <!-- ******************* END SL PROFILS ******************** -->
<?php
    return ob_get_clean();
}

function htmlview_sl_credits()
{
    ob_start();
?>
    <!-- ******************* SL CREDITS ******************** -->
    <aside class="credits aside section">
        <div class="section-inner">
            <h2 class="heading">Credits</h2>
            <div class="content">
                <ul class="list-unstyled">
                    <li><a href="http://getbootstrap.com/" target="_blank"><i class="fas fa-external-link-alt"></i> Bootstrap 3.2</a></li>
                    <li><a href="https://fontawesome.com/" target="_blank"><i class="fas fa-external-link-alt"></i> FontAwesome 6.1.2</a></li>
                    <li><a href="http://jquery.com/" target="_blank"><i class="fas fa-external-link-alt"></i> jQuery</a></li>
                    <li><a href="http://caseyscarborough.com/projects/github-activity/" target="_blank"><i class="fas fa-external-link-alt"></i> GitHub Activity Stream</a></li>
                    <li><a href="https://github.com/sdepold/jquery-rss" target="_blank"><i class="fas fa-external-link-alt"></i> jQuery RSS</a></li>

                    <li>iPad and iPhone mocks: <a href="https://dribbble.com/perlerar" target="_blank">Regy Perlera</a></li>

                </ul>

                <hr />

                <p>This responsive HTML5 CSS3 site template is handcrafted by 3rdwavemedia and edited by Ilyas Toumlilt, free under the Creative Commons Attribution 3.0 License.</p>
                <a class="btn btn-cta-secondary btn-follow" href="https://twitter.com/ilyasToumlilt" target="_blank"><i class="fab fa-twitter"></i> Follow me</a>
                <a class="btn btn-cta-primary btn-download" href="http://themes.3rdwavemedia.com/website-templates/free-responsive-website-template-for-developers/" target="_blank"><i class="fas fa-download"></i> Download Template</a>
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </aside>
    <!--//section-->
    <!-- ******************* END SL CREDITS ******************** -->
<?php
    return ob_get_clean();
}

function HV_sl_skills()
{
    ob_start();
?>
    <!-- ******************* SL SKILLS ******************** -->
    <aside class="skills aside section">
        <div class="section-inner">
            <h2 class="heading">Skills</h2>
            <div class="content">
                <div class="skillset">

                    <div class="item">
                        <h3 class="level-title">Distributed Systems<span class="level-label" data-toggle="tooltip" data-placement="left" data-animation="true" title="" data-original-title="">Expert</span></h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="90%" style="width: 90%;">
                            </div>
                        </div>
                        <!--//level-bar-->
                    </div>
                    <!--//item-->

                    <div class="item">
                        <h3 class="level-title">C, Bash & Erlang<span class="level-label" data-original-title="" title="">Pro</span></h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="80%" style="width: 80%;">
                            </div>
                        </div>
                        <!--//level-bar-->
                    </div>
                    <!--//item-->

                    <div class="item">
                        <h3 class="level-title">Operating Systems, Linux Kernel
                            <span class="level-label" data-toggle="tooltip" data-placement="left" data-animation="true" title="" data-original-title="I used to be good at these but I haven't used them for while."><i class="fas fa-info-circle"></i></span>
                        </h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="65%" style="width: 55%;">
                            </div>
                        </div>
                        <!--//level-bar-->
                    </div>
                    <!--//item-->

                    <div class="item">
                        <h3 class="level-title">PHP, Typescript &amp; Javascript<span class="level-label" data-original-title="" title="">Guru</span></h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="96%" style="width: 96%;">
                            </div>
                        </div>
                        <!--//level-bar-->
                    </div>
                    <!--//item-->

                    <div class="item">
                        <h3 class="level-title">Java, Perl, Python, C++ &amp; Objective-C
                            <span class="level-label" data-toggle="tooltip" data-placement="left" data-animation="true" title="" data-original-title="I used to be good at these but I haven't used them for while."><i class="fas fa-info-circle"></i></span>
                        </h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="60%" style="width: 30%;">
                            </div>
                        </div>
                        <!--//level-bar-->
                    </div>
                    <!--//item-->

                    <p><a class="more-link" href="<?php echo URL_CODERWALL; ?>" target="_blank"><i class="fas fa-external-link-alt"></i> More on Coderwall</a></p>
                </div>
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </aside>
    <!--//section-->
    <!-- ******************* END SL SKILLS ******************** -->
<?php
    return ob_get_clean();
}

function HV_sl_favourite_music()
{
    ob_start();
?>
    <!-- ******************* SL FAVOURITE CODING MUSIC ******************** -->
    <aside class="list music aside section">
        <div class="section-inner">
            <h2 class="heading">Favourite coding music</h2>
            <div class="content">
                <ul class="list-unstyled">
                    <li><i class="fas fa-headphones"></i> <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">Youtube Link</a></li>
                </ul>
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </aside>
    <!--//section-->
    <!-- ******************* END SL FAVOURITE CODING MUSIC ******************** -->
<?php
    return ob_get_clean();
}

function HV_sl_latest_blog_posts()
{
    ob_start();
?>
    <!-- ******************* SL LATEST BLOG POSTS ******************** -->
    <aside class="blog aside section">
        <div class="section-inner">
            <h2 class="heading">Latest Blog Posts</h2>
            <div id="rss-feeds" class="content">
                RSS Feed coming soon!
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->
    </aside>
    <!--//section-->
    <!-- ******************* END SL LATEST BLOG POSTS ******************** -->
<?php
    return ob_get_clean();
}

function HV_sl_conferences()
{
    ob_start();
?>
    <!-- ******************* SL CONFERENCES ******************** -->
    <aside class="list conferences aside section">
        <div class="section-inner">
            <h2 class="heading">Conferences & Workshops</h2>
            <div class="content">
                <ul class="list-unstyled">
                    <li><i class="fas fa-calendar"></i> <a href="https://middleware-conf.github.io/2021/" target="_blank">Middleware 2021</a> (Québec)</li>
                    <li><i class="fas fa-calendar"></i> <a href="https://http://eurosys2020.org/" target="_blank">Eurosys 2020</a> (Virtual)</li>
                    <li><i class="fas fa-calendar"></i> <a href="https://2019.compas-conference.fr/">Compas 2019</a> (Biarritz)</li>
                    <li><i class="fas fa-calendar"></i> <a href="https://http://eurosys2019.org/" target="_blank">Eurosys 2019</a> (Dresden)</li>
                    <li><i class="fas fa-calendar"></i> <a href="https://http://eurosys2018.org/" target="_blank">Eurosys 2018</a> (Porto)</li>
                    <li><i class="fas fa-calendar"></i> <a href="https://papoc-workshop.github.io/2018/">Papoc 2018</a> (Porto)</li>
                    <li><i class="fas fa-calendar"></i> <a href="http://compas2017.sciencesconf.org">Compas 2017</a> (Nice)</li>
                    <li><i class="fas fa-calendar"></i> <a href="https://sites.google.com/site/rsdwinterschool/home">GDR Winter School on Distributed Systems and Networks 2017</a> (Le Pleynet)</li>
                </ul>
            </div>
            <!--//content-->
        </div>
        <!--//section-inner-->

    </aside>
    <!--//section-->
    <!-- ******************* END SL CONFERENCES ******************** -->
<?php
    return ob_get_clean();
}

function htmlview_default_secondary_layer()
{
    ob_start();
?>

    <!-- ====================== SECONDARY LAYER ====================== -->
    <div class="secondary col-md-4 col-sm-12 col-xs-12">
        <?php
        echo htmlview_sl_basic_information();
        echo HV_sl_latest_blog_posts();
        echo htmlview_sl_profils();
        echo HV_sl_favourite_music();
        echo htmlview_sl_education();
        // echo HV_sl_skills();
        echo HV_sl_conferences();
        // echo htmlview_sl_langages();
        echo htmlview_sl_credits();
        ?>
    </div>
    <!--//secondary-->
    <!-- ====================== END SECONDARY LAYER ====================== -->
<?php
    return ob_get_clean();
}
