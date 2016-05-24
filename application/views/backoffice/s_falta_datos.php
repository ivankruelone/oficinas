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
<?php
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                 <tr> 
                                     <th>Id</th>
                                     <th>Fecha</th>
                                     <th>Informacion</th>
                                     <th>Pharm</th>
                                     <th>Nid</th>
                                     <th>Sucurusal</th>
                                     <th>Observacion</th>
                                     <th></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;
                                     foreach ($q->result() as $r2) {
             $l1 = anchor('backoffice/s_falta_datos_observacion/'.$r2->id,'Obser</a>', array('title' => 'Haz Click aqui para Ver observacion!', 'class' => 'encabezado'));                           

                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->procesos?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->back?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->nombre ?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->observacion ?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
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