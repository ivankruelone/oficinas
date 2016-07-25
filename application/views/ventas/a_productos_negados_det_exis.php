<div class="span10">
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
                                 <th style="text-align: left">Nid</th>
                                 <th style="text-align: left">Sucursal</th>
                                 <th style="text-align: left">Exitencia</th>
                                 <th style="text-align: left">Venta<br />en 30 dias</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t1=0;$t2=0;$color='blue';
                                foreach ($q->result()as $row) {
                                if($row->suc_sol==$row->suc){$color='red';}else{$color='blue';}
                                ?>
                                <tr>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->suc?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->nombre?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->cantidad?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo number_format($row->vta,0)?></td>
                                  </tr>
                                 
                               
                               <?php 
                               $t1=$t1+$row->cantidad;
                               $t2=$t2+$row->vta;
                               } 
                               
                               ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>;text-align: left;"><?php echo number_format($t1,0)?></td>
                              <td style="color: <?php echo $color?>;text-align: left;"><?php echo number_format($t2,0)?></td>
                              </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                         

                 </div>