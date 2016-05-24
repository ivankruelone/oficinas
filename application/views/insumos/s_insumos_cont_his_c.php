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
                                     <th>Id</th>
                                     <th>Folio</th>
                                     <th>Sub Folio</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Fecha Pedido</th>
                                     <th>Fecha Surtido</th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0;
                                     foreach ($q->result() as $r2) {
  $l1 = anchor('insumos/insumos_cont_imp/'.$r2->id.'/'.$r2->fol,'Imprime</a>', array('title' => 'Haz Click aqui para Imprimir !', 'class' => 'encabezado'));                                        
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->id?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fol?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->sucx?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha_sur?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
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