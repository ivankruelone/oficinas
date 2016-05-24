                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <?php $l1 = anchor('fiscal/s_carga_datos','carga datos');?>
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
                                 <th colspan="5" style="color:gray;text-align: center"><?php echo $l1?></th>
                                 
                                 </tr>
                                 <tr>
                                     <th style="color:gray; text-align: right">Iva</th>
                                     <th style="color:gray; text-align: right">Importe Cheques</th>
                                     <th style="color:gray; text-align: right">Imp. Banco</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $total=0;$tiva=0;$total_con=0;
                                foreach ($a->result()as $r){
                                ?>
                                <tr>
                                
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->iva,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->total,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->total_con,2)?></td>
                                </tr>
                               <?php 
                               $tiva=$tiva+$r->iva;
                               $total=$total+$r->total;
                               $total_con=$total_con+$r->total_con;
                                } ?>
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>