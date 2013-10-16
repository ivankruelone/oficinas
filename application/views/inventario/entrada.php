                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
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
                                     <th style="text-align: right">Entradas</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $tentrada=0;
                                $color='gray';
                                foreach ($a->result()as $r){
                                    $l0 = anchor('inventario/entrada_suc/'.$r->suc.'/'.$r->mes,$r->sucx.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->suc?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->importe_prvocosto,2)?></td>
                                <td></td>
                                <td></td>
                                </tr>
                               <?php  $tentrada=$tentrada+$r->importe_prvocosto;} ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                    <td></td>
                                    <td style="color: maroon;text-align: right;">TOTAL </td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($tentrada,2)?> </td>                                  
                                   
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>