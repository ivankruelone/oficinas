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


 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">Id</th>
                                 <th style="text-align: left">Fecha</th>
                                 <th style="text-align: left">Provedor</th>
                                 <th style="text-align: left">Factura</th>
                                 <th style="text-align: right">Importe</th>
                                 <th style="text-align: left"></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                $l0 = anchor('mercadotecnia/his_fac_det/'.$r->id,$r->factura.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                $l1 = anchor('mercadotecnia/sumit_imprimir/'.$r->id,'Imprimir</a>', array('title' => 'Haz Click aqui para imprimir factura!', 'class' => 'encabezado'));
                                ?> 
                                 <tr>
                                    <td style="text-align: left;"><?php echo $r->id?></td>
                                   <td style="text-align: left;"><?php echo $r->fecha?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->corto?></td>
                                   <td style="text-align: left;"><?php echo $l0?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->importe,2)?></td>
                                   <td style="text-align: left;"><?php echo $l1?></td>
                                  </tr>
                               <?php $timp_prv=0;$timp_suc=0;} ?>
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>