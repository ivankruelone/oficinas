                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>Id</th>
                                     <th>Borrar</th>
                                     <th>Licitacion</th>
                                     <th>Folio</th>
                                     <th>Orden</th>
                                     <th>Fecha</th>
                                     <th>Almacen</th>
                                     <th>Provedor</th>
                                     <th>Importe</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                
                                $num=$num+1;
                                $tot=0; $n=0; 
                                  $l0 = anchor('pedido/com_pedido_det_his/'.$r->id,$r->id.'</a>', array('title' => 'Haz Click aqui para detalle!', 'class' => 'encabezado'));
                                  if($r->valida==0 and $r->importe>0){
                                  $l1 = anchor('pedido/com_pedido_imp/'.$r->id.'/'.$r->estatus,'Imprime</a>', array('title' => 'Haz Click aqui para cerrar!', 'class' => 'encabezado'));  
                                  }else{$l1='Autorizacion';}
                                  $l2=anchor('pedido/borrar_orden_cerrada/'.$r->id,'Borrar');
                                  if($r->estatus==0){$color='red';}else{$color='gray';}
                                  
                                ?>
                                        <tr>
                                        
                                        <td style="text-align: right; color:<?php echo $color?>;"><?php echo $num?></td>
                                        <td style="text-align: left; color:<?php echo $color?>;"><?php echo $l2?></td>
                                        <td style="text-align: left; color:<?php echo $color?>;"><?php echo $r->licita?></td>
                                        <td style="text-align: left; color:<?php echo $color?>;"><?php echo $l0?></td>
                                        <td style="text-align: left; color:<?php echo $color?>;"><?php echo $r->folprv?></td>
                                        <td style="text-align: right; color:<?php echo $color?>;"><?php echo $r->fecha?></td>
                                        <td style="text-align: left;  color:<?php echo $color?>"><?php echo $r->almacenx?></td>
                                        <td style="text-align: left;  color:<?php echo $color?>"><?php echo $r->prvx?></td>
                                        <td style="text-align: right;  color:<?php echo $color?>"><?php echo number_format($r->importe,2)?></td>
                                        <td style="text-align: right;  color:<?php echo $color?>"><?php echo $l1?></td>
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