                 <div class="span12">
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
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Pedido</th>
                                     <th>Fecha de Captura<br />Sucursal</th>
                                     <th>Observacion</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                //$l2= anchor('pedido/s_val_pedido_ins_his_det/'.$r->id_cc.'/'.$r->fol,$r->id_cc.$r->fol.'</a>', array('title' => 'Haz Click aqui para detalle!', 'class' => 'encabezado'));
                                $num=$num+1;
                                  
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: left; "><?php echo $r->id_cc?></td>
                                        <td style="text-align: right; "><?php echo $r->suc?></td>
                                        <td style="text-align: left; "><?php echo $r->nombre?></td>
                                        <td style="text-align: left; "><?php echo $r->comprarx?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha_cap?></td>
                                        <td style="text-align: left; "><?php echo $r->obs?></td>
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