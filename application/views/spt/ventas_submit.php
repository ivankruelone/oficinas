                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                          <h4></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">COMPARATIVO DE VENTAS DEL MES <?php echo getMesNombre($mes)?></th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Sucursal</th>
                                        <th>2010</th>
                                        <th>2011</th>
                                        <th>2012</th>
                                        <th>2013</th>
                                        <th>2014</th>
                                        <th>2015</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $num=0;
                               $numero = $s->num_rows();
                               
                               $a2010 = 0;
                               $a2011 = 0;
                               $a2012 = 0;
                               $a2013 = 0;
                               $a2014 = 0;
                               $a2015 = 0;
                     
                               
                               foreach ($s->result()as $r){
                                $num=$num+1;
                                $consul=$s->num_rows($r);
                                
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: center"><?php echo $r->suc.' '.$r->nombre?></td>
                                <td style="text-align: right"><?php echo number_format($r->a2010, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->a2011, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->a2012, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->a2013, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->a2014, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->a2015, 2)?></td>
                                </tr>
                               <?php 
                               
                              
                               
                               $a2010= $a2010+$r->a2010;
                               $a2011= $a2011+$r->a2011;
                               $a2012= $a2012+$r->a2012;
                               $a2013= $a2013+$r->a2013;
                               $a2014= $a2014+$r->a2014;
                               $a2015= $a2015+$r->a2015;
                               
                              
                                 } 
                                 
                              
                               
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: right" >TOTAL </td>
                              <td style="text-align: right"><?php echo number_format($a2010, 2)?></td>
                              <td style="text-align: right"><?php echo number_format($a2011, 2)?></td>
                              <td style="text-align: right"><?php echo number_format($a2012, 2)?></td>
                              <td style="text-align: right"><?php echo number_format($a2013, 2)?></td>
                              <td style="text-align: right"><?php echo number_format($a2014, 2)?></td>
                              <td style="text-align: right"><?php echo number_format($a2015, 2)?></td>
                              </tr>
                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>