                 <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
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
                                     <th>#</th>
                                     <th>Folio</th>
                                     <th>Art&iacute;culo</th>
                                     <th>Cantidad</th>
                                     <th>Importe</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;$imp=0;
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                  
                                ?>
                                        <tr>
                                        <td style="text-align: left; "><?php echo $num?></td>
                                        <td style="text-align: left; "><?php echo $r->id_cc.$r->fol?></td>
                                        <td style="text-align: left; "><?php echo $r->descripcion?></td>
                                        <td style="text-align: right; "><?php echo $r->canr?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp,2)?></td>
                                        </tr>
                                        <?php 
                                        $imp=$imp+($r->imp);
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="5" style="text-align: right; "><?php echo number_format($imp,2)?></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>