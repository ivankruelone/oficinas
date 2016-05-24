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
                                     <th>Id</th>
                                     <th style="text-align: center;">A&ntilde;o</th>
                                     <th style="text-align: center;">Mes</th>
                                     <th style="text-align: center;">Importe</th>
                                     <th></th>
                                     <th></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;
                                     foreach ($q->result() as $r2) {
                                      $l1 = anchor('backoffice/s_factura_central_prov/'.$r2->aaa.'/'.$r2->mes,'Provedor</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));  
                                      $l2 = anchor('backoffice/s_factura_central_pro/'.$r2->aaa.'/'.$r2->mes,'Producto</a>', array('title' => 'Haz Click aqui para Ver Productos!', 'class' => 'encabezado'));
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->aaa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->mes.' - '.$r2->mesx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->imp_prv,2)?></td>
                                        <td><?php echo $l1?></td>
                                        <td><?php echo $l2?></td>
                                        </tr>
                                        <?php $num=$num+1; $tot=$tot+$r2->imp_prv;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot,2)?></strong></td>
                             <td colspan="3"></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>