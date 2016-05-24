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

                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Fecha</th>
                                     <th style="text-align: center;">Contrato</th>
                                     <th style="text-align: center;">Productos</th>
                                     <th style="text-align: center;">Encontrados</th>
                                     <th></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;
                                     foreach ($q->result() as $r2) {
                                    $l1  = anchor('licita/s_licita_historico_det/'.$r2->fecha.'/'.$r2->contrato,'Detalle</a>', array('title' => 'Aplica coincidencias!', 'class' => 'encabezado'));    
                                       ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r2->fecha?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo trim($r2->contrato)?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo number_format($r2->productos,0)?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo number_format($r2->encontrado,0)?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                        

<!---->
                  
<!--------------
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                 </div>
