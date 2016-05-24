                 <div class="span12">
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
                               <th colspan="7" style="text-align: center; color: red">SOLO CODIGOS ESPECIFICOS DE ESTA LISTA</th>
                               </tr>
                               <tr>
                               <th style="text-align: left;">Sec</th>
                               <th style="text-align: left;">Codigo</th>
                               <th style="text-align: left;">Descripcion</th>
                               <th style="text-align: left;">Precio Venta</th>
                               <th style="text-align: left;">Precio Oferta</th>
                               <th style="text-align: left;">Fecha inicial</th>
                               <th style="text-align: left;">Fecha Final</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;
                                 foreach ($q->result()as $r){
                                 if($r->fecha_fin < date('Y-m-d')){$color='red';}else{$color='blue';}
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                    <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->sec?></td>
                                    <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->codigo?></td>
                                    <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->descripcion?></td>
                                    <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->vtagen?></td>
                                    <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->precio_oferta?></td>
                                    <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->fecha_activos?></td>
                                    <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->fecha_fin?></td>
                                 </tr> 
                           
                             
                               
                              
                                 
                               <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>