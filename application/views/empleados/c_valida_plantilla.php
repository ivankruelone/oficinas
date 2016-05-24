                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $Titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla0">
                          <caption></caption> 
                             <thead>
                                 <tr>
                                     <th>#Suc</th>
                                     <th>Nombre Suc</th>
                                     <th>Nomina</th>
                                     <th>Nombre Empleado</th>
                                     <th>Puesto</th>
                                     <th>Activo</th>
                                     <th>Observacion</th>
                                     <td></td>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                foreach ($query->result() as $row)
                                {
                                ?>    
                                
                                <tr>
                                 <td><?php echo $row->suc?></a> </td>
                                 <td><?php echo $row->nombre?></a> </td>
                                 <td><?php echo $row->nomina?></a> </td>
                                 <td><?php echo $row->completo?></a> </td>
                                 <td><?php echo $row->puestox?></a> </td>
                                 <td><?php echo $row->status?></a> </td>
                                 <td><?php echo $row->observ?></a> </td>
                                 <?php $suc=$row->nomina;?>
                                 
                                <td><?php echo anchor('empleados/c_observ_empleado/'.$suc, 'observacion'); ?></a></td>
                                                                                 
                                <?php     
                                }
                                ?>
                             </tbody>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                </div>