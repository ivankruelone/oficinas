<div class="span5">
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
                                 <th>#</th>
                                 <th></th>
                                 <th style="text-align: left">A&ntilde;o</th>
                                 <th style="text-align: left">Mes</th>
                                 <th style="text-align: left">Ordenes</th>
                                 
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $num=0;
                                foreach ($a->result()as $row) {
                                $l1 = anchor('orden/a_orden_mes_glo_det/'.$row->aaa.'/'.$row->mes, '<img src="'.base_url().'img/good.jpg" border="0" width="60px" />', array('title' => 'Haz Click aqui para ver ordenes!', 'class' => 'encabezado'));
                                $num=$num+1; 
                                 
                                 ?>
                                
                                 <tr>
                                    <td style="color: gray;text-align: left;"><?php echo $num?></td>
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