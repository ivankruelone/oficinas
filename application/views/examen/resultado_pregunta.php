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
                         
                         <?php
                         
                         if($correcta == 1)
                         {
                            $eti = '<br /><span style="color: green;">CORRECTOS: '.$query->num_rows().'</span>';
                         }else{
                            $eti = '<br /><span style="color: red;">INCORRECTOS: '.$query->num_rows().'</span>';
                         }
                         
                         ?>
                         
                         <table class="table">
                            <caption><?php echo $preguntaTxt . ' ' .$eti; ?></caption>
                            <thead>
                                <tr>
                                    <th># Suc</th>
                                    <th>Sucursal</th>
                                    <th>Nomina</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                ?>
                                <tr>
                                    <td><?php echo $row->succ; ?></td>
                                    <td><?php echo $row->nombre; ?></td>
                                    <td><?php echo $row->nomina; ?></td>
                                    <td><?php echo $row->pat; ?></td>
                                    <td><?php echo $row->mat; ?></td>
                                    <td><?php echo $row->nom; ?></td>
                                </tr>
                                
                                <?php 

                                }
                                
                                ?>
                            </tbody>
                         </table>


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
