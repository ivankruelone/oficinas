                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
	echo $this->cxp_model->uploadCedis('cedis');
	echo $this->cxp_model->uploadSeguroPopular('seguro_popular');
    echo '<p>Listo.</p>';
?>

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
