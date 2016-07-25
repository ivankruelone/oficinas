                 <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Folio</th>
                                     <th>Pedido</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Fecha</th>
                                     <th>Importe</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l2= anchor('pedido/s_val_pedido_uni_det/'.$r->id,$r->id.'</a>', array('title' => 'Haz Click aqui para detalle!', 'class' => 'encabezado'));
                                $l1= anchor('pedido/s_val_pedido_ins_regreso/'.$r->id,'Regresar Pedido para que el encargado agregue articulos');
                                $num=$num+1;
                                  
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td><?php echo $l2?></td>
                                        <td style="text-align: left; "><?php echo $r->descri?></td>
                                        <td style="text-align: right; "><?php echo $r->suc?></td>
                                        <td style="text-align: left; "><?php echo $r->sucx?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha_cap?></td>
                                        <td style="text-align: right; "><?php echo $r->imp?></td>
                                        <td><?php echo $l1?></td>
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
<div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1 ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Folio</th>
                                     <th>Pedido</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Fecha</th>
                                     <th>Importe</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;$final=0;$final1=0;
                                foreach ($q1->result() as $r1) {
                                $l2= anchor('pedido/s_val_pedido_det_uni_validar/'.$r1->id,$r1->id.'</a>', array('title' => 'Haz Click aqui para detalle!', 'class' => 'encabezado'));
                                $num=$num+1;
                                  
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td><?php echo $l2?></td>
                                        <td style="text-align: left; "><?php echo $r1->descri?></td>
                                        <td style="text-align: right; "><?php echo $r1->suc?></td>
                                        <td style="text-align: left; "><?php echo $r1->sucx?></td>
                                        <td style="text-align: left; "><?php echo $r1->fecha_cap?></td>
                                        <td style="text-align: right; "><?php echo $r1->imp?></td>
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