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
                               <th style="text-align: left;">Codigo</th>
                               <th style="text-align: left;">Sustancia Activa</th>
                               <th style="text-align: left;">Marca comercial</th>
                               <th style="text-align: left;">Lab</th>
                               <th style="text-align: left;">Registro</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;
                                 foreach ($q->result()as $r){
                                 $l0=anchor('catalogos/mod_codigo/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para modificar detalle!', 'class' => 'encabezado'));   
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $l0?></td>
                                   <td style="text-align: left;"><?php echo trim($r->susa).' '.trim($r->gramaje).' '.trim($r->contenido).' '.trim($r->presenta)?></td>
                                   <td style="text-align: left;"><?php echo trim($r->marca_comercial)?></td>
                                   <td style="text-align: left;"><?php echo trim($r->lab)?></td>
                                   <td style="text-align: left;"><?php echo trim($r->registro)?></td>                                  
                                 </tr> 
                           
                             
                               
                              
                                 
                               <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>