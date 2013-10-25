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
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla">
                             
                                 <?php
                                 $num=0;
                                foreach ($q as $r) {
                                $num=$num+1;
                                $l0 = anchor('mercadotecnia/productos_letra/'.$r['letra'],$r['letra'].'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                 ?> 
                                   <td style="text-align: left;"><?php echo $l0?></td>                                  
                               <?php } ?>
                               </table>
                               
                                <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">LABORATORIOS</th>
                               </tr>  
                             </thead>
                             <tbody>
                             
                               
                               <?php foreach ($q1 as $r1) {
                                
                                $l1 = anchor('mercadotecnia/productos_labora/'.$r1['lab'],$r1['labor'].'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                 ?>
                                 <tr>
                                   <td style="text-align: left;"><?php echo $l1?></td>                                  
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