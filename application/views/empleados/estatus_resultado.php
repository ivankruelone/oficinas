<div class="span12">
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
                                 <th style="text-align: right">Nomina</th>
                                 <th style="text-align: left">Nombre</th>
                                 <th style="text-align: left">Sucursal</th>
                                 <th style="text-align: left">Nom. Sucursal</th>
                                 <th style="text-align: left">Puesto</th>
                                 <th style="text-align: center">Fecha Alta</th>
                                 <th style="text-align: center">DETALLE</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                             
                                foreach ($query->result()as $row) {
                                $nomina=$row->nomina;    
                                $l1 = anchor('empleados/estatus_detalle/'.$nomina, '<img src="'.base_url().'img/tabla.jpg" border="0" width="60px" />', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                 $sucursal=$row->succ;
                                 $sql="select * from catalogo.sucursal where suc=$sucursal";
                                 $q = $this->db->query($sql);
                                 foreach ($q->result() as $r){
                                    
                                 
                                 ?>
                                
                                 <tr>
                                    <td style="color: gray;text-align: right;"><?php echo $nomina?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->completo?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->succ?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r->nombre?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->puestox?></td>
                                    <td style="color: gray;text-align: center;"><?php echo $row->fechahis?></td>
                                    <td style="color: gray;text-align: center;"><?php echo $l1?></td>                           
                                  </tr>
                               
                               <?php 
                               }
                               } 
                               
                               ?>
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>