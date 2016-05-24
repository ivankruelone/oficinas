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
                                     <th style="text-align: center;">Letra</th>
                                     <th style="text-align: center;">Productos</th>
                                     <th style="text-align: center;">Aplicados</th>
                                     <th></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;
                                     foreach ($q->result() as $r2) {
                                     $l1 = anchor('licita/s_licita_det/'.$r2->fecha.'/'.$r2->contrato.'/'.$r2->letra,'Detalle</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo trim($r2->letra)?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r2->numero?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r2->num_encontra?></td>
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
