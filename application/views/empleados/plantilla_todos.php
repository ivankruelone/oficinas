<div class="span9">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: right">Sucursal</th>
                                 <th style="text-align: left">Nombre</th>
                                 <th style="text-align: left">Nomina</th>
                                 <th style="text-align: left">Nombre</th>
                                 <th style="text-align: left">Puesto</th>
                                 <th style="text-align: left">Observacion</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                             
                                foreach ($query->result()as $row) {
                                //$l1 = anchor('empleados/estatus_detalle/'.$nomina, '<img src="'.base_url().'img/tabla.jpg" border="0" width="60px" />', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                 
                                    
                                 
                                 ?>
                                
                                 <tr>
                                    <td style="color: gray;text-align: right;"><?php echo $row->suc?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->nombre?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->nomina?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->completo?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->puestox?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->motivo?></td>                          
                                  </tr>
                               
                               <?php 
                               
                               } 
                               
                               ?>
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>