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
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             <tr>
                             <th colspan="2" style="text-align: center;"></th>
                             <th colspan="3" style="text-align: center;">Costos</th>
                             <th colspan="3" style="text-align: center;">Ofertas</th>
                             <th colspan="3" style="text-align: center;">Financiero</th>
                             </tr>
                               <tr>
                               <th style="text-align: left;">Codigo</th>
                               <th style="text-align: left;">Descripcion</th>
                               <th style="text-align: left;">Saba</th>
                               <th style="text-align: left;">Nadro</th>
                               <th style="text-align: left;">Fanasa</th>
                               <th style="text-align: left;">Saba</th>
                               <th style="text-align: left;">Nadro</th>
                               <th style="text-align: left;">Fanasa</th>
                               <th style="text-align: left;">Saba</th>
                               <th style="text-align: left;">Nadro</th>
                               <th style="text-align: left;">Fanasa</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;
                                 foreach ($q->result()as $r){
                                // $l0=anchor('catalogos/mod_codigo/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para modificar detalle!', 'class' => 'encabezado'));   
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->codigo?></td>
                                   <td style="text-align: left;"><?php echo trim($r->descripcion)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->cos_saba,2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->cos_nadro,2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->cos_fanasa,2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->ofe_saba,2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->ofe_nadro,2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->ofe_fanasa,2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->fin_saba,2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->fin_nadro,2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->fin_fanasa,2)?></td>
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