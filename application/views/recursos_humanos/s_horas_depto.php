                 <div class="span7">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">



<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: right">Empleado</th>
                                 <th style="color:black; text-align: right">Checan</th>
                             </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                                 $tmn=0;$tusd=0;
                                foreach ($q->result()as $r) {
                                $l1 = anchor('recursos_humanos/s_horas_trabajadas/'.$r->suc, 'Empleado con menos horas</a>', array('title' => 'Haz Click aqui para ver horas!', 'class' => 'encabezado'));
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->suc?></td>
                                   <td style="text-align: left;"><?php echo $r->nombre?></td>
                                   <td style="text-align: left;"><?php echo $r->empleados?></td>
                                   <td style="text-align: left;"><?php echo $r->checa?></td>
                                   <td style="text-align: left;"><?php echo $l1?></td>
                                  </tr>
                               <?php  
                              
                               } ?>
                              </tbody>
                              <tfoot>
                               
                              <tr>
                              <td colspan="3"><strong>TOTAL</strong></td>
                              </tr>
                              </tfoot>
                         </table>



                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>