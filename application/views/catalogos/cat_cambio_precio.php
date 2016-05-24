                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Cambio de precios</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                          <caption></caption> 
                             <thead>
                                 <tr>
                                     <th>FECHA</th>
                                     <th>CODIGO</th>
                                     <th>DESCRIPCION</th>
                                     <th>PRECIO ANTERIOR</th>
                                     <th>PRECIO ACTUAL</th>
                                                                         
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;
                                foreach ($q->result()as $r) {
                                $color ='black';
                                $num=$num+1;
                                ?>
                                <tr>
                                    <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->fecha?></td>
                                    <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->codigo?></td>
                                    <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->descripcion?></td>
                                    <td style="text-align: left; color: <?php echo $color ='orange'?>;"><?php echo $r->pub_ant?></td>
                                    <td style="text-align: left; color: <?php echo $color ='blue'?>;"><?php echo $r->pub_act?></td>
                                                                       
                                </tr>
                                <?php
                                }
                                ?>
                             </tbody>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>