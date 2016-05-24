                 <div class="span10">
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
                                     <td>Zona</td>
                                     <th>Supervisor</th>
                                     <th>Numero de sucursales</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                        $l1=anchor('ventas/s_descuentos_mes_sup_excel/'.$aaa.'/'.$mes.'/'.$r->superv,'Archivo en Excel Descuentos');
                                        $l2=anchor('ventas/s_optimo_excel_ger/'.$aaa.'/'.$r->superv,'Archivo en Excel Desplazamiento y Optimos');
                                        $l3=anchor('ventas/s_estadistica_ventas_sup/'.$aaa.'/'.$mes.'/'.$r->superv,'Archivo en Excel Ventas capturadas');
                                        $l4=anchor('ventas/s_optimo_excel_ger/'.($aaa-1).'/'.$r->superv,'Archivo en Excel Desplazamiento y Optimos del a&ntilde;o anterior');
                                        //$l3=' ';
                                $num=$num+1;
                                
                                
                                ?> 
                                        <tr>
                                        
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->superv?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->supervx?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->num_suc?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $l2?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $l3?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $l4?></td>
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