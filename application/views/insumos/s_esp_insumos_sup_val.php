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
                                     <th>Borrar</th>
                                     <th>#</th>
                                     <th>Folio</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Fecha</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                
                                $l0= anchor('insumos/cerrar_val_esp_borc/'.$r->id,'Borrar');
                                $l1= anchor('insumos/s_esp_insumos_sup_val_det/'.$r->id.'/'.$r->suc,$r->id);
                                $l2= anchor('insumos/cerrar_val_esp/'.$r->id,'Valida Pedido');
                                $num=$num+1;
                                  
                                ?>
                                        <tr>
                                        <td><?php echo $l0?></td>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; "><?php echo $l1?></td>
                                        <td style="text-align: right; "><?php echo $r->suc?></td>
                                        <td style="text-align: left; "><?php echo $r->sucx?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha?></td>
                                        <td style="text-align: left; "><?php echo $l2?></td>
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