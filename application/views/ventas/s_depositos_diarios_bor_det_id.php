                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Fecha Ficha</th>
                                     <th>Referencia</th>
                                     <th>Deposito<br /></th>
                                     <th>Reembolso</th>
                                     <th>Fecha<br />Venta</th>
                                     <th>Fecha<br />Captura</th>
                                     <th>Borrar</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                if($r->activo==5){
                                    $color='red';$color1='red';
                                    $l1='';
                                    }else{
                                        $color='green';$color1='gray';
                                        $l1=anchor('ventas/s_depositos_diarios_bor_sumit/'.$r->id.'/'.$r->suc,'Borrar</a>', array('title' => 'Haz Click aqui para Borrar!', 'class' => 'borrar'));
                                
                                        }
                                        ?>
                                        <tr>
                                        
                                        <td style="text-align: left;  color: <?php echo $color1?>;"><?php echo $r->suc?></td>
                                        <td style="text-align: left;  color: <?php echo $color1?>;"><?php echo $r->sucx?></td>
                                        <td style="text-align: left;  color: <?php echo $color1?>;"><?php echo $r->fecha_ficha?></td>
                                        <td style="text-align: left;  color: <?php echo $color1?>;"><?php echo $r->referencia?></td>
                                        <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->importe,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->reembolso,2)?></td>
                                        <td style="text-align: left;  color: <?php echo $color1?>;"><?php echo $r->fecha_venta?></td>
                                        <td style="text-align: right; "><?php echo $r->fecha_cap?></td>
                                        <td><?php echo $l1 ?></td>
                                        </tr>
                                        <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             </tr>
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>