                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: center">A&ntilde;o</th>
                                    <th style="text-align: center">Mes</th> 
                                     <th style="text-align: right">$ Venta</th>
                                    
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;       
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
                                $l0=anchor('ventas/s_ventas_capturadas_sec_det/'.$r->aaa.'/'.$r->mes,$r->mesx.'</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));    
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r->aaa?></td>
                                <td style="color: maroon;"><?php echo $l0?></td>
                                <td style="text-align: right;"><?php echo number_format($r->venta,2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r->venta;
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t01,2)?></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>