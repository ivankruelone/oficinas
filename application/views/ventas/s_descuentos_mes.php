                 <div class="span5">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <td>Mes</td>
                                     <th>Mes</th>
                                     <th>Imp.Descuento</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                    if($r->num<=date('m')){
                                        $l1=anchor('ventas/s_descuentos_mes_sup/'.$r->aaa.'/'.$r->num,'Detalle del mes');
                                    }else{
                                        $l1='';
                                    }
                                $num=$num+1;
                                
                                
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->aaa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->mes?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $l1?></td>
                                       </tr>
                                       <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             </tfoot>
                         </table>                        

<!---->
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                 </div>