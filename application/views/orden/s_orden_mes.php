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
                                 <th></th>
                                 <th style="text-align: left">A&ntilde;o</th>
                                 <th style="text-align: left">Mes</th>
                                 <th style="text-align: left">Ordenes</th>
                                 
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                             
                                foreach ($a->result()as $row) {
                                $l1 = anchor('orden/s_orden_cambia/'.$row->aaa.'/'.$row->mes, '<img src="'.base_url().'img/good.jpg" border="0" width="60px" />', array('title' => 'Haz Click aqui para ver ordenes!', 'class' => 'encabezado'));
                                 
                                 
                                 ?>
                                
                                 <tr>
                                    <td style="color: gray;text-align: left;"><?php echo $l1?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->aaa?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->mes?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->ordenes?></td>
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
                         

                 </div>