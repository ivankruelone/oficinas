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
                                     <th>Fecha</th>
                                     <th>Folio</th>
                                     <th>Clave</th>
                                     <th>Sustancia Activa</th>
                                     <th>Descripcion</th>
                                     <th>Pedido</th>
                                     <th>surtido</th>
                                     <th>Receta</th>
                                     <th>Inv.Act</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                ?>
                                        <tr>
                                        <td><?php echo $r->fecha?></td>
                                        <td><?php echo $r->folio?></td>
                                        <td style="text-align: left; "><?php echo $r->clave?></td>
                                        <td style="text-align: left; "><?php echo $r->susa?></td>
                                        <td style="text-align: left; "><?php echo $r->descri?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->ped,0)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->sur,0)?></td>
                                        <td style="text-align: left; "><?php echo $r->receta?></td>
                                        <td style="text-align: left; "><?php echo $r->exis?></td>
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