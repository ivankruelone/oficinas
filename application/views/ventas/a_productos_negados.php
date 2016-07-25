<div class="span12">
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
                                 <th style="text-align: left">#</th>
                                 <th style="text-align: left">Fecha</th>
                                 <th style="text-align: left">Nid</th>
                                 <th style="text-align: left">Sucursal</th>
                                 <th style="text-align: right">Productos Negados</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $fec_actual=date('Y-m-d');$color='blue';$num=0;
                                foreach ($q->result()as $row) {
                                 $l1=anchor('ventas/a_productos_negados_det/'.$row->fec.'/'.$row->suc,$row->suc);
                                 $num=$num+1;
                                 ?>
                                
                                 <tr>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $num?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->fec?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $l1?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->sucx?></td>
                                    <td style="color: <?php echo $color?>;text-align: right;"><?php echo $row->negado?></td>
                                  </tr>
                               
                               <?php 
                               
                               } 
                               
                               ?>
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">#</th>
                                 <th style="text-align: left">Fecha</th>
                                 <th style="text-align: left">Codigo</th>
                                 <th style="text-align: left">Descripcion</th>
                                 <th style="text-align: right">Productos<br />Negados</th>
                                 <th style="text-align: right">Existencia<br />En otras Farmacias</th>
                                 <th style="text-align: left">Status</th>
                                 <th style="text-align: left">DEMA</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $fec_actual=date('Y-m-d');$color='blue';$num=0;
                                foreach ($q1->result()as $row1) {
                                 $l1=anchor('ventas/a_productos_negados_cdet/'.$row1->fec.'/'.$row1->codigo,$row1->codigo);
                                 $num=$num+1;
                                 ?>
                                
                                 <tr>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $num?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row1->fec?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $l1?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row1->descri?></td>
                                    <td style="color: <?php echo $color?>;text-align: right;"><?php echo $row1->negado?></td>
                                    <td style="color: <?php echo $color?>;text-align: right;"><?php echo $row1->inv?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row1->status?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row1->status_dema?></td>
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