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
   <link href="<?php echo base_url(); ?>assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>css/style-default.css" rel="stylesheet" id="style_color" />
   
   <link href="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/uniform/css/uniform.default.css" /> 
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/chosen-bootstrap/chosen/chosen.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jquery-tags-input/jquery.tagsinput.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/clockface/css/clockface.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/nestable/jquery.nestable.css" />

   <link href="<?php echo base_url(); ?>assets/flipclock/flipclock.css" rel="stylesheet"/>

<!--    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />  -->

   <link href="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet"/>
   
    <link href="<?php echo base_url(); ?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
   
   

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
   <script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url(); ?>js/jquery.nicescroll.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
   <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-fileupload.js"></script>
   <script src="<?php echo base_url(); ?>js/jquery.blockui.js"></script>
   <script src="<?php echo base_url(); ?>js/jquery.scrollTo.min.js"></script>
   <script src="<?php echo base_url(); ?>js/jQuery.dualListBox-1.3.js" language="javascript" type="text/javascript"></script>
  

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/clockface/js/clockface.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-daterangepicker/daterangepicker.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/FixedColumns.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/DT_bootstrap.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-datepicker/js/es.js"></script>
   <script src="<?php echo base_url(); ?>assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.pack.js"></script>
   <script src="<?php echo base_url(); ?>assets/nestable/jquery.nestable.js"></script>
   <script src="<?php echo base_url(); ?>js/jquery.scrollTo.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
   <script src="<?php echo base_url(); ?>js/easy-pie-chart.js"></script>
  
  

   <script src="<?php echo base_url(); ?>assets/flipclock/flipclock.min.js"></script>

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
                
                if(isset($vistaJS))
                {
                    $dataVista['datos'] = $vistaJS;
                }else{
                    $dataVista['datos'] = null;
                }
                
                $this->load->view($js, $dataVista);
                
            }
        ?>

</body>
<!-- END BODY -->
</html>