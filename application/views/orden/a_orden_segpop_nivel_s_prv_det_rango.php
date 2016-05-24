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
                                     <th>#</th>
                                     <th>Fecha Envio</th>
                                     <th>Fecha Limite</th>
                                     <th>Id Orden</th>
                                     <th>Orden</th>
                                     <th>Clave</th>
                                     <th>Codigo</th>
                                     <th>Sustancia activa</th>
                                     <th>Solicitaron</th>
                                     <th>Importe</th>
                                     <th>llegaron</th>
                                     <th>Nivel de Surtido</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=1;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; "><?php echo $r->fecha_envio?></td>
                                        <td style="text-align: right; "><?php echo $r->fecha_limite?></td>
                                        <td style="text-align: right; "><?php echo $r->id_orden?></td>
                                        <td style="text-align: left; "><?php echo $r->folprv?></td>
                                        <td style="text-align: left; "><?php echo $r->clagob?></td>
                                        <td style="text-align: left; "><?php echo $r->codigo?></td>
                                        <td style="text-align: left; "><?php echo $r->susa1?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->pedido,0)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->total,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->aplicado,0)?></td>
                                        <td style="text-align: right; color: orange;"><?php echo number_format($r->nuvel_surtido,2)?></td>
                                        </tr>
                                        <?php 
                                        $num=$num+1;
                                        $tu1=$tu1+$r->pedido;
                                        $tu2=$tu2+$r->total;
                                        $tu3=$tu3+$r->aplicado;
                                        }
                                        $tu4=($tu3/$tu1)*100;
                                        ?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="8"><strong>TOTAL</strong></td>
                             <td style="text-align: right; "><strong><?php echo number_format($tu1,0)?></strong></td>
                             <td style="text-align: right; "><strong><?php echo number_format($tu2,2)?></strong></td>
                             <td style="text-align: right; "><strong><?php echo number_format($tu3,0)?></strong></td>
                             <td style="text-align: right; color: orange;"><strong><?php echo number_format($tu4,2)?></strong></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->     
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>