                 <div class="span12">
                  <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                 <tr> 
                                     <th>Nid</th>
                                     <th># suc</th>
                                     <th>Sucursal</th>
                                     <th>Folio</th>
                                     <th></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0;
                                     foreach ($q->result() as $r2) {
$l = anchor('insumos/devolucion_imp/'.$r2->suc.'/'.$r2->folio,'Imprime</a>', array('title' => 'Haz Click aqui para Imprimir !', 'class' => 'encabezado'));                                        
                                ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->sucx?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->folio?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                     
                         
 <!---->
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET--> 
 </div>