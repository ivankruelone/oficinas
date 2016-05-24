          <div class="span6">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-striped" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">#</th>
                                 <th style="text-align: left">Nid</th>
                                 <th style="text-align: left">Sucursal</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                
                                foreach ($q->result()as $r) {
                                ?> 
                                
                                <?php
                                
                                
                                $num=$num+1;
                                $l0 = anchor('entradas/gastos_suc/'.$r->suc,$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver los gastos!', 'class' => 'encabezado'));
                                ?> 
                                    <tr>
                                    <td><?php echo $num?></td>
                                    <td><?php echo $r->suc?></td>
                                    <td><?php echo $l0?></td>
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