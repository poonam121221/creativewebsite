<?php 
$siteDetails = getSiteDetails();
?>
 <header>
            <div class="container-fix">
                <div class="container">
                    <div class="logo-container pull-left">
                        <div id="logo">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>assets/img/logo.png" title="Handart 4" alt="Handart 4" class="img-responsive" /></a>
                        </div>
                    </div>
                    <div class="block-left pull-left">
                        <ul class="list-unstyled">
                            <li>
                                <form action="#" method="post" enctype="multipart/form-data" id="form-language">
                                    <div>
                                        <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                            <span class="text-ex">Lang</span><i class="ion-chevron-down"></i></button>
                                        <ul class="dropdown-menu">
                                        <?php if($this->session->has_userdata('site_lang')==FALSE || $this->session->userdata('site_lang') == 'english'): ?>
                                            <li>
                                                <button class="btn btn-link btn-block language-select item-selected"
                                                    type="button" name="en-gb">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets/img/en-gb.png" alt="English"
                                                        title="English" /> Hindi
                                                </button>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($this->session->userdata('site_lang') == 'hindi'): ?>
                                            <li>
                                                <button class="btn btn-link btn-block language-select item-selected"
                                                    type="button" name="en-gb">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets/img/en-gb.png" alt="English"
                                                        title="English" /> English
                                                </button>
                                            </li>
                                        <?php endif; ?>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="code" value="" />
                                    <input type="hidden" name="redirect"
                                        value="" />
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="block-right pull-right">
                        <div class="setting pull-right">
                            <button data-toggle="dropdown" type="button"><i class="ion-drag"></i></button>
                            <nav id="top" class="dropdown-menu">
                                <ul class="list-unstyled top-links">
                                    <li>
                                        <div>
                                            <span class="text-ex">My Account</span>
                                            <div id="top-links">
                                                <ul class="ul-account list-unstyled">
                                                    <li>
                                                        <a id="a-register-link"
                                                            href="">Register</a>
                                                    </li>
                                                    <li>
                                                        <a id="a-login-link"
                                                            href="">Admin Login</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                            
                    <div class="main-menu">
                        <div class="hozmenu-container">
                            <div class="ma-nav-mobile-container">
                                <div class="hozmenu">
                                    <div class="navbar">
                                        <div id="navbar-inner" class="navbar-inner navbar-inactive">
                                            <div class="menu-mobile">
                                                <a class="btn btn-navbar navbar-toggle">
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </a>
                                                <span class="brand navbar-brand">Menu</span>
                                            </div>

                                            <?php echo buildMobileTopMenu(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nav-container visible-lg visible-md">
                                <div id="pt_custommenu" class="pt_custommenu">
                                    <?php echo buildTopMenu(); ?>
                                </div>
                            </div>
                        </div>
                        <div id="sticky-menu" data-sticky="1"></div>
                     

                    </div>
                </div>
            </div>
        </header>

