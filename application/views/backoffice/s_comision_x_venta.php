                 <div class="span8">
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
                                     <th>Id</th>
                                     <th>A&ntilde;o</th>
                                     <th>Mes</th>
                                     <th></th>
                                     <th>Dias</th>
                                  </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                //if($r->mes==(date('m')-1)){
                                $l0 = anchor('comision/s_calculo_comisiones/'.$r->aaa.'/'.str_pad($r->mes,2,"0",STR_PAD_LEFT).'/'.$r->dias,$r->mesx.'</a>', array('title' => 'Haz Click aqui para ver sucursales!', 'class' => 'encabezado'));
                                //}else{
                                //$l0=$r->mesx;    
                                //}
                                ?> 
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->aaa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->mes?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l0?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->dias,0)?></td>
                                      </tr>
                                       <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             
                             <td colspan="4" style="color:black; text-align: left; "><strong>Total <?php echo number_format($num,0).' meses'?></strong></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>