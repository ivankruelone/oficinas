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
                                     <th>#</th>
                                     <th>Area</th>
                                     <th>Nomina</th>
                                     <th>Nombre</th>
                                     <th>Puesto</th>
                                     <th>F.Ingreso</th>
                                     <th>Antiguedad</th>
                                     <th>Entrada</th>
                                     <th>Salida</th>
                                     <th>Observacion</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                //$l2= anchor('pedido/com_pedido_borrado/'.$r->id,'Borrar </a>', array('title' => 'Haz Click aqui para detalle!', 'class' => 'encabezado'));
                                $num=$num+1;
                                $tot=0; $n=0; 
                                 
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: left; "><?php echo $r->deptox?></td>
                                        <td style="text-align: right; "><?php echo $r->nomina?></td>
                                        <td style="text-align: left; "><?php echo $r->completo?></td>
                                        <td style="text-align: left; "><?php echo $r->puestox?></td>
                                        <td style="text-align: center; "><?php echo $r->fechahis?></td>
                                        <td style="text-align: center; "><?php echo $r->antiguedad?></td>
                                        <td style="text-align: center; "><?php echo $r->entrada?></td>
                                        <td style="text-align: center; "><?php echo $r->salida?></td>
                                        <td style="text-align: center; "><?php echo $r->mot?></td>
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