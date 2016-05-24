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
<?php
$l1 = anchor('backoffice/s_falta_datos','Sucursales Faltantes</a>', array('title' => 'Haz Click aqui para procesar sucursales faltantes!', 'class' => 'encabezado'));
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                <tr>
                                <th colspan="7"><?php echo $l1 ?></th>
                                </tr>
                                 <tr> 
                                     <th>Id</th>
                                     <th>Fecha</th>
                                     <th>Pharm</th>
                                     <th>Nid</th>
                                     <th>Sucurusal</th>
                                     <th>Telefono</th>
                                     <th>Piezas</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;
                                     foreach ($q->result() as $r2) {
                                        if($r2->piezas==0){$color='red';}else{$color='blue';}

                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha_hoy?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->back?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->sucx.'<br /><strong>'.$r2->fecha_act.'</strong>'?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->tel.'<br />'.$r2->tel1?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->piezas,0)?></td>
                                        </tr>
                                        <?php $num=$num+1;
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