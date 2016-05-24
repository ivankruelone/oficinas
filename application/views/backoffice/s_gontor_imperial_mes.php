                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
<?php 
$l0 = anchor('backoffice/genera_gontor_imperial/'.$fec,'Genera comisiones</a>', array('title' => 'Haz Click aqui para generar comisiones!', 'class' => 'encabezado'));
$l2 = anchor('backoffice/envia_gontor_imperial/'.$fec,'Envia archivo a nominas</a>', array('title' => 'Haz Click aqui para enviar comisiones!', 'class' => 'encabezado'));
?>
                             <thead>
                             <tr>
                             <th colspan="3"><?php echo $l0 ?></th>
                             <th colspan="3"><?php echo $l2 ?></th>
                             </tr>   
                                 <tr> 
                                     <th>Id</th>
                                     <th>Imagen</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Dias</th>
                                     <th>Venta</th>
                                  </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                ?> 
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->tipo2?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->sucx.' '.$r->fecha_act?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->dias,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->venta,2)?></td>
                                      </tr>
                                       <?php $timp=$timp+$r->venta;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4"></td>
                             <td style="color:black; text-align: left; "><strong>Total de productos <?php echo number_format($num,0)?></strong></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($timp,2)?></strong></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>