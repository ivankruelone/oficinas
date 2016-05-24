<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8" />
       <title>SISTEMA DE OFICINAS</title>
       <meta content="width=device-width, initial-scale=1.0" name="viewport" />
<?php $lx='<img src="'.base_url().'img/logo.png" border="0" width="190px" />';?>
       <table>
                            
                            <tr>
                                     <th style="text-align: left;" colspan="11"><?php echo $lx?><br /><br /></th>
                            </tr>
                            <tr>
                                     <th colspan="11"><?php echo $titulo1?><br /><br /></th>
                            </tr>
                            <tr>
                                     <th class="critical"># Suc</th>
                                     <th style="text-align: center;">A&ntilde;o</th>
                                     <th style="text-align: center;">Mes</th>
                                     <th style="text-align: center;">Venta</th>
                                     <th style="text-align: center;">Costo de la Venta</th>
                                     <th style="text-align: center;">Renta</th>
                                     <th style="text-align: center;">Nomina</th>
                                     <th style="text-align: center;">Isr_Nomina</th>
                                     <th style="text-align: center;">Insumos</th>
                                     <th style="text-align: center;">Devolucion</th>
                                     <th style="text-align: center;">Luz</th>
                                     <th style="text-align: center;">Tel</th>
                                     <th style="text-align: center;">Otros</th>
                                     <th style="text-align: center;">Utilidad</th>
                            </tr>
    </head>
    <body>
    
    
    
    <p>
    
    <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$utilidad_40=0;
                                     foreach ($q1->result() as $r1) {
                                       $mas_gasto=(($r1->gas_x_suc)*($r1->num_suc))+$r1->gastos;
                                       $utilidad_40=$r1->venta-(+$r1->costo_venta+$mas_gasto);
                                        ?>
                                        <tr style="border: 1px solid #000;">
                                        <td style="width: auto; text-align: left; color: <?php echo $color ?>"><?php echo $r1->num_suc?></td>
                                        <td style="width: auto; text-align: left; color: <?php echo $color ?>"><?php echo $r1->aaa?></td>
                                        <td style="width: auto; text-align: left; color: <?php echo $color ?>"><?php echo $r1->mesx?></td>
                                        <td style="width: auto; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->venta,2)?></td>
                                        <td style="width: 100px; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->costo_venta,2)?></td>
                                        <td style="width: 100px; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->renta,2)?></td>
                                        <td style="width: 100px; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->nomina,2)?></td>
                                        <td style="width: 100px; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->isr_nomina,2)?></td>
                                        <td style="width: 100px; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->insumos,2)?></td>
                                        <td style="width: 100px; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->dev,2)?></td>
                                        <td style="width: 100px; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->luz,2)?></td>
                                        <td style="width: 100px; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->tel,2)?></td>
                                        <td style="width: 100px; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->otros,2)?></td>
                                        <td style="width: 100px; text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->utilidad,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r1->venta;
                                        $tot2=$tot2+$r1->costo_venta;
                                        $tot3=$tot3+$r1->gastos;
                                        $tot4=$tot4+$r1->utilidad;
                                        $tot5=$tot5+$utilidad_40;
                                        }?>
                                        
                                
                             
                         </table>
    </p>    
    
    <div id="chart"></div>

    <script src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>fs/js/fusioncharts.js"></script>
    <script type="text/javascript">
    FusionCharts.ready(function () {
  var chart = new FusionCharts(<?php echo $json; ?>);
   chart.render();
});
    
    </script>
    <p>Programa elaborado por: Lidia Velazquez e Ivan Zu&ntilde;iga</p>
    </body>
</html>