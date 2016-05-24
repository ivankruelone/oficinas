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
                         
                     
 
<table class="editinplace table table-bordered table-condensed table-striped table-hover" id="tabla3">
                             <thead>
                               <tr>
                               <th style="text-align: left;">ID insumo</th>
                               <th style="text-align: left;">Nombre Insumo</th>
                               <th style="text-align: left;">Cantidad</th>
                               <th style="text-align: left;">Fecha de Captura</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $margen=0;$color ='blue';$num=0;
                                 foreach($query->result() as $row){
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->id_insumos?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->descripcion?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->cantidad?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->fecha_cap?></td>
                                 </tr> 
                               
                             <?php
                               }                                
                                ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>                          
                         </div>
                     </div>
                     
                      </div>    