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
                                    <th colspan="10" style="color: blue; text-align: center;">DEP&Oacute;SITOS ASOCIACI&Oacute;N SALUD PARA TODOS</th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Sucursal</th>
                                        <th>Asociaci&oacute;n</th>
                                        <th>Dep&oacute;sito</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $num=0;
                               
                               $fundacion = 0;
                               $deposito = 0;
                               
                               foreach ($s->result()as $r){
                                $num=$num+1;
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: center"><?php echo $r->sucursal.' '.$r->nombre?></td>
                                <td style="text-align: left"><?php echo number_format($r->fundacion, 2)?></td>
                                <td style="text-align: left"><?php echo number_format($r->deposito, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $fundacion= $fundacion+$r->fundacion;
                               $deposito= $deposito+$r->deposito;
                               
                              
                                 } 
                                 
                              
                               
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: right" >TOTALES</td>
                              <td style="text-align: left"><?php echo number_format($fundacion, 2)?></td>
                              <td style="text-align: left"><?php echo number_format($deposito, 2)?></td>
                              </tr>
                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>