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
                                     <th style="text-align: left;">Num</th>
                                     <th style="text-align: left;">Mes</th>
                                     <th style="text-align: right;">Importe</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;
                                foreach ($a->result() as $r) {
                                $l1= anchor('ventas/ventas_clientes_det/'.$r->num,$r->mesx.'</a>', array('title' => 'Haz Click aqui para detalle!', 'class' => 'encabezado'));
                                
                                  
                                ?>
                                        <tr>
                                        <td style="text-align: left; "><?php echo $r->num?></td>
                                        <td style="text-align: left; "><?php echo $l1?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp,2)?></td>
                                        </tr>
                                        <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             </tr>
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>