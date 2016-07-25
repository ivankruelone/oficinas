<div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">Codigo</th>
                                 <th style="text-align: left">Descripcion</th>
                                 <th style="text-align: left">Negados</th>
                                 <th style="text-align: left">Comentario</th>
                                 <th style="text-align: left">Estatus</th>
                                 <th style="text-align: left">Existencia<br />en Farmacias</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $fec_actual=date('Y-m-d');$color='blue';
                                foreach ($q->result()as $row) {
                                if($row->inv>0){
                                 $l1=anchor('ventas/a_productos_negados_det_exis/'.$row->fec.'/'.$row->suc.'/'.$row->codigo,$row->inv);
                                 }else{$l1='';}
                                 ?>
                                <tr>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->codigo?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->descri?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->negado?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->obser?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->status?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $l1?></td>
                                  </tr>
                                 
                               
                               <?php 
                               
                               } 
                               
                               ?>
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                         

                 </div>