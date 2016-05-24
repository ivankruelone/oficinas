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
                                     <th>Fecha</th>
                                     <th>Folio</th>
                                     <th>Id.Insumos</th>
                                     <th>Insumos</th>
                                     <th>Cantidad</th>
                                     <td></td>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                 $l1= anchor('insumos/cerrar_val_esp_bord/'.$r->id.'/'.$id_cc.'/'.$suc,'BORRAR'); 
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha_cap?></td>
                                        <td style="text-align: left; "><?php echo $r->id_cc?></td>
                                        <td style="text-align: left; "><?php echo $r->id_insumos?></td>
                                        <td style="text-align: left; "><?php echo $r->descripcion?></td>
                                        <td style="text-align: right; "><?php echo $r->canp_sup?></td>
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
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>