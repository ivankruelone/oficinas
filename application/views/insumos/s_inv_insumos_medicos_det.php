                 <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                 <tr> 
                                     <th>#</th>
                                     <th>Fecha Captura</th>
                                     <th>Id</th>
                                     <th>Insumo</th>
                                     <th>Empaque</th>
                                     <th>Existencia</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='black';$num=0;$tot=0;$totc=0;$dif=0;
                                     foreach ($q1->result() as $r1) {
                                         $num=$num+1;?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->fecha_cap?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->id_insumos?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->descripcion?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->empaque?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->cantidad?></td>
                                        </tr>
                                        <?php
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="6" style="text-align: left; color: <?php echo $color ?>">Total de pedidos<?php echo number_format($num,0)?></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->   
                     
                 </div>