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
                                     <th>Sec</th>
                                     <td>Cambios</td>
                                     <th>Clasificacion</th>
                                     <th>Sustancia Activa</th>
                                     <th>Descon</th>
                                     <th>Observacion</th>
                                     <th>Modificar</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                $l0=anchor('catalogos/clasifica/'.$r->id,'Cambiar</a>', array('title' => 'Haz Click aqui para modificar detalle!', 'class' => 'encabezado'));
                                if($r->descon=='N'){
                                $l1=anchor('catalogos/descontinuado/'.$r->id.'/S','<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar detalle!', 'class' => 'encabezado'));
                                $color='blue';    
                                }else{
                                $l1=anchor('catalogos/descontinuado/'.$r->id.'/N','<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar detalle!', 'class' => 'encabezado'));
                                $color='red';    
                                }
                                
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->sec?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l0?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->tipo?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->susa?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r->descon?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->obser?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $l1?></td>
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