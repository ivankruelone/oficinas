                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1" style="color: black;">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">CAPTURA P&L SUCURSAL <br />A&Ntilde;O: <?php echo $aaa; ?>, MES: <?php echo getMesNombre($mes)?><br />Nid: <?php echo $suc; ?> - <?php echo $sucursal; ?></th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Concepto</th>
                                        <th>Observaci&oacute;n</th>
                                        <th>Importe</th>
                                        <th>Input</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $num=0;
                               $observaciones = null;
                               
                               foreach ($s->result()as $r){
                                
                                $data = array(
                                  'name'        => 'importe_' . $r->idPl,
                                  'id'          => $r->idPl,
                                  'value'       => $r->importe,
                                  'maxlength'   => '10',
                                  'size'        => '10'
                                );

                                
                                $num=$num+1;
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $r->idPl; ?></td>
                                <td style="text-align: left"><?php echo $r->concepto; ?></td>
                                <td style="text-align: left"><?php echo $observaciones ?></td>
                                <td style="text-align: left"><?php echo form_input($data); ?><span id="confirma_<?php echo $r->idPl;?>" style="color: blue; font-weight: bolder;"></span></td>
                                <td style="text-align: left"><?php echo number_format($r->input, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                              
                                 } 
                                 
                              
                               
                                 ?>
                              </tbody>
                              <tfoot>
                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>