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
                                     <th>Fecha</th>
                                     <th>Almacen</th>
                                     <th>Clasificacion</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;$final=0;$final1=0;
                                if($a<>0){
                                foreach ($a as $r) {

                                foreach ($r['segundo'] as $seg) {    
                                $num=$num+1;
                                ?>
                                    <tr>
                                    <td style="width: inherit;"><?php echo $r['fechag']?></td>
                                    <td style="width: inherit;"><?php echo $seg['almacenx']?></td>
                                    <td style="width: auto ;">
                                        <?php $tot=0; $n=0; 
                                        foreach($seg['tercero'] as $items){$n=$n+1;?> 
                                            <td style="text-align: right; "><strong><?php echo $items['clasi']?></strong></td>
                                            <td style="text-align: right;"><?php echo number_format($items['impo'],2)?></td>
                                        <?php $tot=$tot+$items['impo'];}
                                        $l1 = anchor('pedido/valida_ped/'.$r['fechag'].'/'.$r['xtipo'],'Validar pedido</a>', array('title' => 'Haz Click aqui para validar pedido!', 'class' => 'encabezado'));?>
                                        <td style="text-align: right; color:black"><?php echo '<strong>Total</strong> '.number_format($tot,2)?></td>
                                    </td>
                                    </tr>
                                    
                                <?php $final=$final+$tot;$final1=$final1+$tot;}?>
                                 <tr>
                             <td>TOTAL</td>
                             <td style="color: royalblue;"><?php echo number_format($final,2)?></td>
                             <td style="color: royalblue;"><?php echo $l1?></td>
                             </tr>
                                <?php $final=0;}}else{$l1='';}?>
                             </tbody>
                             <tfoot><tr>
                             <td>TOTAL GENERAL</td>
                             <td colspan="12" style="color: royalblue; text-align: right;"><?php echo number_format($final1,2)?></td>
                             </tr></tfoot>
                         </table>                        





                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>