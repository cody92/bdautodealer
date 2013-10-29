<!DOCTYPE html>
<html lang="en">
    <head>
        <!--
                Charisma v1.0.0

                Copyright 2012 Muhammad Usman
                Licensed under the Apache License v2.0
                http://www.apache.org/licenses/LICENSE-2.0

                http://usman.it
                http://twitter.com/halalit_usman
        -->
        <meta charset="utf-8">
        <title><?php echo $this->title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="BD Auto Dealer">
        <meta name="author" content="Ionut Codreanu">

        <!-- The styles -->
        <link id="bs-css" href="<?php echo $this->getBasePath();?>css/bootstrap-cerulean.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <link href="<?php echo $this->getBasePath();?>css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?php echo $this->getBasePath();?>css/charisma-app.css" rel="stylesheet">
        <link href="<?php echo $this->getBasePath();?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
        <link href='<?php echo $this->getBasePath();?>css/fullcalendar.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/fullcalendar.print.css' rel='stylesheet'  media='print'>
        <link href='<?php echo $this->getBasePath();?>css/chosen.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/uniform.default.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/colorbox.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/jquery.cleditor.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/jquery.noty.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/bootstrap-united.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/elfinder.min.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/elfinder.theme.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/jquery.iphone.toggle.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/opa-icons.css' rel='stylesheet'>
        <link href='<?php echo $this->getBasePath();?>css/uploadify.css' rel='stylesheet'>

        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="<?php echo $this->getBasePath();?>http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- The fav icon -->
        <link rel="shortcut icon" href="<?php echo $this->getBasePath();?>img/favicon.ico">

    </head>

    <body>
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
            <!-- topbar starts -->
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="brand" href="<?php echo $this->getBasePath();?>dashboard/index"> BD Auto Dealer</a>

                        
                    </div>
                </div>
            </div>
            <!-- topbar ends -->
        <?php } ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

                    <!-- left menu starts -->
                    <div class="span2 main-menu-span">
                        <div class="well nav-collapse sidebar-nav">
                            <ul class="nav nav-tabs nav-stacked main-menu">
                                <li class="nav-header hidden-tablet">Main</li>
                                <li><a class="ajax-link" href="index.html"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                                <li><a class="ajax-link" href="ui.html"><i class="icon-eye-open"></i><span class="hidden-tablet"> UI Features</span></a></li>
                                <li><a class="ajax-link" href="form.html"><i class="icon-edit"></i><span class="hidden-tablet"> Forms</span></a></li>
                                <li><a class="ajax-link" href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
                                <li><a class="ajax-link" href="typography.html"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
                                <li><a class="ajax-link" href="gallery.html"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
                                
                            </ul>
                        </div><!--/.well -->
                    </div><!--/span-->
                    <!-- left menu ends -->

                    

                    <div id="content" class="span10">
                        <!-- content starts -->
                    <?php } ?>
                    <?php 
                        echo $this->getViewFile();
                    ?>
                    <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
                        <!-- content ends -->
                    </div><!--/#content.span10-->
                <?php } ?>
            </div><!--/fluid-row-->
            <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

                <hr>

                <div class="modal hide fade" id="myModal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">Ã—</button>
                        <h3>Settings</h3>
                    </div>
                    <div class="modal-body">
                        <p>Here settings can be configured...</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                        <a href="#" class="btn btn-primary">Save changes</a>
                    </div>
                </div>

                <footer>
                    
                </footer>
            <?php } ?>

        </div><!--/.fluid-container-->

        <!-- external javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <!-- jQuery -->
        <script src="<?php echo $this->getBasePath();?>js/jquery-1.7.2.min.js"></script>
        <!-- jQuery UI -->
        <script src="<?php echo $this->getBasePath();?>js/jquery-ui-1.8.21.custom.min.js"></script>
        <!-- transition / effect library -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-transition.js"></script>
        <!-- alert enhancer library -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-alert.js"></script>
        <!-- modal / dialog library -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-modal.js"></script>
        <!-- custom dropdown library -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-dropdown.js"></script>
        <!-- scrolspy library -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-scrollspy.js"></script>
        <!-- library for creating tabs -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-tab.js"></script>
        <!-- library for advanced tooltip -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-tooltip.js"></script>
        <!-- popover effect library -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-popover.js"></script>
        <!-- button enhancer library -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-button.js"></script>
        <!-- accordion library (optional, not used in demo) -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-collapse.js"></script>
        <!-- carousel slideshow library (optional, not used in demo) -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-carousel.js"></script>
        <!-- autocomplete library -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-typeahead.js"></script>
        <!-- tour library -->
        <script src="<?php echo $this->getBasePath();?>js/bootstrap-tour.js"></script>
        <!-- library for cookie management -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.cookie.js"></script>
        <!-- calander plugin -->
        <script src='<?php echo $this->getBasePath();?>js/fullcalendar.min.js'></script>
        <!-- data table plugin -->
        <script src='<?php echo $this->getBasePath();?>js/jquery.dataTables.min.js'></script>

        <!-- chart libraries start -->
        <script src="<?php echo $this->getBasePath();?>js/excanvas.js"></script>
        <script src="<?php echo $this->getBasePath();?>js/jquery.flot.min.js"></script>
        <script src="<?php echo $this->getBasePath();?>js/jquery.flot.pie.min.js"></script>
        <script src="<?php echo $this->getBasePath();?>js/jquery.flot.stack.js"></script>
        <script src="<?php echo $this->getBasePath();?>js/jquery.flot.resize.min.js"></script>
        <!-- chart libraries end -->

        <!-- select or dropdown enhancer -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.chosen.min.js"></script>
        <!-- checkbox, radio, and file input styler -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.uniform.min.js"></script>
        <!-- plugin for gallery image view -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.colorbox.min.js"></script>
        <!-- rich text editor library -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.cleditor.min.js"></script>
        <!-- notification plugin -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.noty.js"></script>
        <!-- file manager library -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.elfinder.min.js"></script>
        <!-- star rating plugin -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.raty.min.js"></script>
        <!-- for iOS style toggle switch -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.iphone.toggle.js"></script>
        <!-- autogrowing textarea plugin -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.autogrow-textarea.js"></script>
        <!-- multiple file upload plugin -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.uploadify-3.1.min.js"></script>
        <!-- history.js for cross-browser state change on ajax -->
        <script src="<?php echo $this->getBasePath();?>js/jquery.history.js"></script>
        <!-- application script for Charisma demo -->
        <script src="<?php echo $this->getBasePath();?>js/charisma.js"></script>
    </body>
</html>
