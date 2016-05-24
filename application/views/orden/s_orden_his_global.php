                 <div class="span8">
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
                                 <th>A&ntilde;o</th>
                                 <th>Mes</th>
                                 <th style="text-align: left">Mes</th>
                                 <th style="text-align: left;">Ordenes</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $num=1;$compra=0;$importe=0;$descuento=0;$iva=0;
                                foreach ($q->result() as $r) {
                                $l1 = anchor('orden/s_orden_his_global_det/'.$r->aaa.'/'.$r->mes,'Detalle</a>', array('title' => 'Haz Click aqui para ver Ordenes!', 'class' => 'encabezado'));
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r->aaa?></td>
                                <td style="color: maroon;"><?php echo $r->mes?></td>
                                <td style="color: maroon;"><?php echo $r->mesx?></td>
                                <td style="color: maroon; text-align: right;"><?php echo $r->ordenes?></td>
                                <td style="color: maroon; text-align: right;"><?php echo $l1?></td>
                                </tr>
                                <?php 
                                $num=$num+1;
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                            </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>