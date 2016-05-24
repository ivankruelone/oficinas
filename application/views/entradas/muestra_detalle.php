           <div class="span12">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget red">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> <?php echo $tit?></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">

                         
                         <table class="table table-striped" id="tabla1">
                             
                             <thead>
                                <tr>
                                <th>NUM</th>
                                <th>CANTIDAD</th>
                                <th>UNIDAD</th>
                                <th>#IDENTIFICACI&Oacute;N</th>
                                <th>DESCRIPCI&Oacute;N</th>
                                <th>VALOR UNITARIO</th>
                                <th>IMPORTE</th>
                                </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                $imp=null;
                                
                                foreach ($q->result()as $r) {
                                ?> 
                                
                                <?php
                                
                                
                                $num=$num+1;
                                
                                
                                
                                
                                ?> 
                                <tr>
                                    <td style="text-align: right;"><?php echo $num?></td>
                                    <td style="text-align: right;"><?php echo $r->cantidad?></td>
                                    <td><?php echo $r->unidad?></td>
                                    <td style="text-align: right;"><?php echo $r->noIdentificacion?></td>
                                    <td><?php echo $r->descripcion?></td>
                                    <td style="text-align: right;">$<?php echo $r->valorUnitario?></td>
                                    <td style="text-align: right;">$<?php echo $r->importe?></td>
                                 </tr>   
                                 
                                 
                                 <?php
                                 
                                 $imp= $imp+$r->importe;
                                 }
                                 
                                 
                                
                                ?>
                                
                                
                                 
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="6" style="color: maroon;text-align: right;">TOTAL GASTOS</td>
                              <td style="text-align: right;">$<?php echo number_format($imp, 4)?></td>                                  
                              </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>