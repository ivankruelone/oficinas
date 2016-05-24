                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr> 
                                     <th>Id</th>
                                     <th>Partida</th>
                                     <th style="text-align: center;">Sustancia principal</th>
                                     <th style="text-align: center;">Sustacia Activa</th>
                                     <th style="text-align: center;">codigo</th>
                                     <th style="text-align: center;">Sustancia Encontrada</th>
                                     <th style="text-align: center;">Nombre comercial</th>
                                     <th style="text-align: center;">Costo</th>
                                     <th>lab</th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='black';$num=1;$tot=0;$mismo='';$color1='blue';
                                     foreach ($q->result() as $r2) {
                                            $clave_p=$r2->clave_p;
                                            $susa=$r2->susa;
                                            $presenta=$r2->presenta;
                                            
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: orange"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $clave_p?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo trim($susa)?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo trim($presenta)?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo trim($r2->codigo)?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo trim($r2->susa1)?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo trim($r2->susa2)?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo $r2->costo?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->lab?></td>
                                        </tr>
                                        <?php $num=$num+1; $mismo=trim($r2->presenta);
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                        

<!---->
  </div>

                 </div>                
<!--------------
  
 <!-- END BLANK PAGE PORTLET-->
 </div>
 