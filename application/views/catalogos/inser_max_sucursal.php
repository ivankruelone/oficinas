 <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                     <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">


                        <caption></caption> 
                            <thead>
                                <tr>
                                <th colspan="6" style="color: blue; font:+3;">EL MAXIMO DE CEDIS ES DE  <?php echo $op_cedis?></th>
                                </tr>
                                <tr>
                                    
                                    <th>#</th>
                                    <th>NID</th>
                                    <th>SUCURSAL</th>
                                    <th>SECUENCIA</th>
                                    <th>DESCRIPCION</th>
                                    <th>CANTIDAD</th>
                                                                       
                                 </tr>
                             </thead>
                             <tbody>
                                <?php
                                $num=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                ?>
                                <tr>
                                    <td style="text-align: center; color: <?php echo $color='orange' ?>;"><?php echo $num?></td>
                                    <td style="text-align: left; color: <?php echo $color='orange' ?>;"><?php echo $r->suc?></td>
                                    <td style="text-align: left; color: <?php echo $color='black' ?>;"><?php echo $r->nombre?></td>
                                    <td style="text-align: left; color: <?php echo $color='black' ?>;"><?php echo $r->sec?></td>
                                    <td style="text-align: left; color: <?php echo $color='black' ?>;"><?php echo $r->susa?></td>
                                    <td style="text-align: right; color: <?php echo $color ='orange'?>;"><?php echo $r->final?></td>
                                    
                                                                       
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