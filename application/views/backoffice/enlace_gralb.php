                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Procesos Generales de backoffice a servidor de desarrollo</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php 
 $l1= anchor('backoffice/enlace_may/','Extraer</a>', array('title' => 'Extrae!', 'class' => 'encabezado'));
 $l2= anchor('backoffice/proceso_may/','Procesa</a>', array('title' => 'Procesa!', 'class' => 'encabezado'));
 $l3= anchor('backoffice/enlace_tod/','Extraer Central</a>', array('title' => 'Extrae!', 'class' => 'encabezado'));
 $l3_1= anchor('backoffice/enlace_ven/','SOLOVENTAS</a>', array('title' => 'Extrae!', 'class' => 'encabezado'));
 $l4= anchor('backoffice/enlace_tod01/','Extraer Central01</a>', array('title' => 'Extrae!', 'class' => 'encabezado'));
 $l5= anchor('backoffice/proceso_tod/','Procesa</a>', array('title' => 'Procesa!', 'class' => 'encabezado'));
 $v1= anchor('backoffice/rev_ven_back/','<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Ventas Back!', 'class' => 'encabezado'));
 $v2= anchor('backoffice/pro_ven/','<img src="'.base_url().'img/product5.png" border="0" width="20px" /></a>', array('title' => 'Todas las Ventas!', 'class' => 'encabezado'));
 $i1= anchor('backoffice/rev_inv_back/','<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Inventario back!', 'class' => 'encabezado'));
 $i2= anchor('backoffice/pro_inv/','<img src="'.base_url().'img/product5.png" border="0" width="20px" /></a>', array('title' => 'todos los Inventario!', 'class' => 'encabezado'));
 $e1= anchor('backoffice/genera_archivos_back/','<img src="'.base_url().'img/product5.png" border="0" width="20px" /></a>', array('title' => 'Genera envio de precios!', 'class' => 'encabezado'));
 ?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th colspan="2" style="text-align: center;">Enlace a Servidor</th>
                               <th style="text-align: center;">Actualiza en desarrollo</th>
                               <th style="text-align: center;">Archivos</th>
                               <th style="text-align: center;">Ventas</th>
                               <th style="text-align: center;">Inventario</th>
                               <th style="text-align: center;">Compras</th>
                               <th style="text-align: center;">Movimientos</th>
                               </tr> 

                               <tr>
                               <th colspan="2" style="text-align: center;"><?php echo $l1?></th>
                               <th style="text-align: center;"><?php echo $l2?></th>
                               <th style="text-align: center;">Saba<br />Farmacos<br />Nadro</th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               </tr>
                                <tr>
                               <th colspan="8" style="text-align: left;"><?php echo $l3_1?></th>
                                </tr>
                                <tr>
                               <th style="text-align: center;"><?php echo $l3?></th>
                               <th style="text-align: center;"><?php echo $l4?></th>
                               <th style="text-align: center;"><?php echo $l5?></th>
                               <th style="text-align: center;">Ventas<br />Inventario<br />Movimientos</th>
                               <th style="text-align: center;"><?php echo $v1?><br /><br /><?php echo $v2?></th>
                               <th style="text-align: center;"><?php echo $i1?><br /><br /><?php echo $i2?></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               </tr>
                               <tr>
                               <th style="text-align: center;">Genera precios</th>
                               <th style="text-align: center;"><?php echo $e1?></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               </tr> 
                             </thead>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->

                 </div>