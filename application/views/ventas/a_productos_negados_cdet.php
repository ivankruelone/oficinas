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
                                 <th style="text-align: left">Nid</th>
                                 <th style="text-align: left">Sucursal</th>
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
                                 ?>
                                <tr>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->suc?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->sucx?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->codigo?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->descri?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->negado?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->obser?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->status?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->inv?></td>
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
                                 <th style="text-align: left">Nid</th>
                                 <th style="text-align: left">Sucursal</th>
                                 <th style="text-align: left">Exitencia</th>
                                 <th style="text-align: left">Venta<br />en 30 dias</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t1=0;$t2=0;$color='blue';
                                foreach ($q1->result()as $row1) {
                                if($row1->suc_sol==$row->suc){$color='red';}else{$color='blue';}
                                ?>
                                <tr>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row1->suc?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row1->nombre?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row1->cantidad?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo number_format($row1->vta,0)?></td>
                                  </tr>
                                 
                               
                               <?php 
                               $t1=$t1+$row1->cantidad;
                               $t2=$t2+$row1->vta;
                               } 
                               
                               ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>;text-align: left;"><?php echo number_format($t1,0)?></td>
                              <td style="color: <?php echo $color?>;text-align: left;"><?php echo number_format($t2,0)?></td>
                              </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                         

                 </div>