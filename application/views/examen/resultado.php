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
                         
                         <table class="table">
                            <thead>
                                <tr>
                                    <th>Master</th>
                                    <th>Status</th>
                                    <th colspan="2" style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                ?>
                                <tr>
                                    <td><?php echo $row->x; ?></td>
                                    <td><?php echo $row->liberarDescripcion; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('examen/resultado_master/'.$row->x, 'Resultados'); ?></td>
                                    <td style="text-align: center;"><?php echo anchor('examen/resultado_concentrado/'.$row->x, 'Concentrado'); ?></td>
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
                 
