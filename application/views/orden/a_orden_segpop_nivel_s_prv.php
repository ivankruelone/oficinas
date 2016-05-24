                 <div class="span9">
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
                                     <th>Prv</th>
                                     <th>Provedor</th>
                                     <th>Importe</th>
                                     <th>Solicitan</th>
                                     <th>Llegan</th>
                                     <th>Nivel de Surtido</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=1;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l1=anchor('orden/a_orden_segpop_nivel_s_prv_det/'.$r->prv,'Det');
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; "><?php echo $r->prv?></td>
                                        <td style="text-align: left; "><?php echo $r->razo?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->total,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->pedido,0)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->aplicado,0)?></td>
                                        <td style="text-align: right; color: orange;"><?php echo number_format($r->nuvel_surtido,2)?></td>
                                        <td><?php echo $l1?></td>
                                        </tr>
                                        <?php 
                                        $num=$num+1;
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