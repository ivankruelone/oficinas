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
                                     <th>Fecha Captura</th>
                                     <th>Fecha Mov</th>
                                     <th>Motivo</th>
                                     <th>Causa</th>
                                     <th>Nomina</th>
                                     <th>Empleado</th>
                                     <th>Dias</th>
                                     <th>Aplicar</th>
                                     <th>Respuesta</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                if($r->motivo==1){$aplica=$r->aplica;}else{$aplica='';}
                                ?>
                                        <tr>
                                        
                                        <td style="text-align: left; "><?php echo $r->fecha_c?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha_mov?></td>
                                        <td style="text-align: left; "><?php echo $r->motivox?></td>
                                        <td style="text-align: left; "><?php echo $r->causax?></td>
                                        <td style="text-align: left; "><?php echo $r->nomina?></td>
                                        <td style="text-align: left; "><?php echo $r->nombre?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->dias)?></td>
                                        <td style="text-align: right; "><?php echo $aplica?></td>
                                        <td style="text-align: right; "><?php echo $r->fecha_rh?></td>
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