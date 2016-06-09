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
                                 <th style="text-align: left">Almacen</th>
                                 <th style="text-align: left">Cia</th>
                                 <th style="text-align: left">Compa&ntilde;ia</th>
                                 <th style="text-align: left">Prv</th>
                                 <th style="text-align: left">Orden</th>
                                 <th style="text-align: left">Proveedor</th>
                                 <th style="text-align: left">Fecha<br />Orden</th>
                                 <th style="text-align: left">Fecha<br />Limite</th>
                                 <th style="text-align: left">Fecha<br />Modificado</th>
                                 <th style="text-align: left">Piezas<br />Recibidas</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $fec_actual=date('Y-m-d');
                                foreach ($a->result()as $row) {
                                if($row->estatus==1 and $row->aplica==0 ){
                                $color='gray';
                                }else{
                                    $color='red';
                                }
                                $l3 = anchor('orden/com_orden_imp/'.$row->id_orden.'/'.$row->estatus, 'Imprime', array('title' => 'Haz Click aqui para Cambiar productos!', 'class' => 'encabezado')); 
                                 ?>
                                
                                 <tr>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->estado?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->cia?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->ciax?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->folprv?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->prv?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->prvx?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->fecha_envio?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->fecha_limite?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->fecha_modi?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->aplica?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $l3?></td>                          
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