<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title><?php echo TITULO_SITIO_WEB; ?></title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>css/style-default.css" rel="stylesheet" id="style_color" />

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN HEADER -->
   
   <?php $this->load->view('header'); ?>

   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
      
      <?php $this->load->view('sidebar'); ?>

      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
               <div class="span12">
                   <!-- BEGIN THEME CUSTOMIZER-->
                   <div id="theme-change" class="hidden-phone">
                       <i class="icon-cogs"></i>
                        <span class="settings">
                            <span class="text">Theme Color:</span>
                            <span class="colors">
                                <span class="color-default" data-style="default"></span>
                                <span class="color-green" data-style="green"></span>
                                <span class="color-gray" data-style="gray"></span>
                                <span class="color-purple" data-style="purple"></span>
                                <span class="color-red" data-style="red"></span>
                            </span>
                        </span>
                   </div>
                   <!-- END THEME CUSTOMIZER-->
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                     <?php echo $titulo; ?>
                   </h3>
                   
                   <?php if (BREADCRUMB == 1) $this->load->view('breadcrumb'); ?>

                   <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
             <div class="row-fluid">
             
                <?php
                
                $controlador = $this->uri->segment(1, 'welcome');
                $vista = $this->uri->segment(2, 'default');
                
                $this->load->view($controlador."/".$vista);
                
                ?>

             </div>
            <!-- END PAGE CONTENT-->
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->

   <!-- BEGIN FOOTER -->
   
   <?php $this->load->view('footer'); ?>
   
   <!-- END FOOTER -->

   <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script>
   <script src="<?php echo base_url(); ?>js/jquery.nicescroll.js" type="text/javascript"></script>
   <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>js/jquery.scrollTo.min.js"></script>


   <script type="text/javascript" src="<?php echo base_url(); ?>assets/uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/FixedColumns.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/DT_bootstrap.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <!--common script for all pages-->
   <script src="<?php echo base_url(); ?>js/common-scripts.js"></script>

   <!-- END JAVASCRIPTS -->   
   
        <script>
        
        var $controller = '<?php echo $this->uri->segment(1, null); ?>';
        var $method = '<?php echo $this->uri->segment(2, "default"); ?>';
        
        $( "#menu_" + $controller ).addClass( "active" );
        $( "#menu_" + $controller + "_" + $method ).addClass( "active" );
        
        
        </script>
        
        <?php 
            if(isset($js)){
                
                $this->load->view($js);
                
            }
        ?>

</body>
<!-- END BODY -->
</html>