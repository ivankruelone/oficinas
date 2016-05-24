                 <div class="span5">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php 
?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">Descripcion</th>
                               <th style="text-align: left;"></th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color ='blue';
                                 foreach ($q->result()as $r){
                              $l1 = anchor(''.$r->controlador,'Generar</a>', array('title' => 'Haz Click aqui para Generar!', 'class' => 'encabezado'));
                                
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->descripcion?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $l1?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->fecha_gen?></td>
                                </tr>
                                <?php 
                                } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>