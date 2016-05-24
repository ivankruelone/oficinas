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

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                 <tr> 
                                     <th style="text-align: center;">Codigo</th>
                                     <th style="text-align: center;">Secuencia</th>
                                     <th style="text-align: center;">Clave</th>
                                     <th style="text-align: center;">Sustancia Activa</th>
                                     <th style="text-align: center;">Descripcion</th>
                                     <th style="text-align: center;">Cantidad</th>
                                     <th style="text-align: center;">Costo</th>
                                     <th style="text-align: center;">Descuento</th>
                                     </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;
                                $mismo='';
                                     foreach ($q->result() as $r2) {
                                      $l1 = anchor('orden/s_orden_cambia_det_id/'.$r2->id_orden.'/'.$r2->id_detalle,$r2->susa1.'</a>', array('title' => 'Haz Click aqui para cambiar costo,descuento,clave y cantidad!', 'class' => 'encabezado'));
                                      $l2 = anchor('orden/s_orden_cambia_det_id2/'.$r2->id_orden.'/'.$r2->id_detalle,$r2->canp.'</a>', array('title' => 'Haz Click aqui para cambiar costo,descuento y cantidad!', 'class' => 'encabezado'));
                                      if($r2->fecha_modi == '0000-00-00 00:00:00'){$color='blue';}else{$color='red';}
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->id_detalle?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->sec?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->clagob?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->susa2?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l2?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->costo?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->descuento?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                        

<!---->
                  
<!--------------
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                 </div>
