

<div class="panel panel-default">
</div>
  
<div class="span5">

 <!-- BEGIN BLANK PAGE PORTLET-->
    <div class="widget blue">
        <div class="widget-title">
        <h4><i class="icon-reorder"></i>Genera Pedido</h4>
        <span class="tools">
            <a href="javascript:;" class="icon-chevron-down"></a>
        </span>
            </div>
             <div class="widget-body">
                 
                 <?php
                    echo form_open('pedido/sumit_pedido_dema');
                    echo "<br />";   
                    
                     $dias = array(
                        'name' => 'dias',
                        'id' => 'dias',
                        'size' => '2',
                        'style' => 'width:50%',
                        'value' => ''
                    );

                     $minimo = array(
                        'name' => 'min',
                        'id' => 'min',
                        'size' => '2',
                        'style' => 'width:50%',
                        'value' => '' 
                    );

                  ?>  

                    <table> 

                     


                        <tr>
                        <td align="left" ><font size="+0"><strong>DIAS DE VENTA</strong></font></td>
                        <td><?php echo form_input($dias,"", 'required'); ?></td>
                        </tr>
                            

                        <tr>
                        <td align="left" ><font size="+0"><strong>Piezas Minimo:</strong></font></td>
                        <td><?php echo form_input($minimo,"", 'required'); ?></td>
                        <td colspan="8"> </td>
                    </tr>





                    
                    </table>
                    <center>
                    <?php  

                        echo form_submit('mysubmit', 'Generar');

                        echo "<br />";
                        echo "<br />";
                        echo form_close();
                    ?>

                    </center>
                   
                          
        </div>
    </div>
    <!-- END BLANK PAGE PORTLET-->
</div>



<div class="span10">
    <!-- BEGIN BLANK PAGE PORTLET-->
        <div class="widget orange">
                <div class="widget-title">
                        <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        </span>
                      </div>
                    <div class="widget-body">
<?php 
$l0=anchor('pedido/guarda_pedido_dema','GUARDA PEDIDO FORMULADO');
?>
                    <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                        <thead>
                        <tr bgcolor="orange">
                        <th colspan="8" style="text-align:center;"><?php echo $l0?></th>
                        </tr>
                        <tr>
                        <th>Parmacy 1</th>
                        <th>Parmacy 2</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Piezas</th>
                        <th>Importe</th>
                        <th>Iva</th>
                        <th>Total</th>
                        </tr>
                        </thead>

                              <tbody>
                                <?php
                                $num=0;$t1=0;$t2=0;$t3=0;$t4=0;$color ='black';
                                foreach ($q->result()as $r) {
                                
                                $l1=anchor('pedido/a_pedido_dema_det/'.$r->codigo,$r->codigo);
                                $num=$num+1;
                                ?>
                                <tr>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->rel1?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->rel2?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $l1?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->descri?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r->ped,0)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r->imp,2)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r->iva,2)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r->total,2)?></td>
                                                                                                
                                    <?php ?>

                                                                                       
                                </tr>
                                <?php
                                $t1=$t1+$r->ped;
                                $t2=$t2+$r->imp;
                                $t3=$t3+$r->iva;
                                $t4=$t4+$r->total;
                                }
                                $l2=anchor('pedido/a_excel_pedido_dema','GENERAR ARCHIVO DE EXCEL PARA DEMA');
                                ?>
                             </tbody>

                            <tfoot>
                            <tr>
                            <td colspan="4">Total</td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t1,0)?></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t2,2)?></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t3,2)?></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t4,2)?></td>
                            </tr>
                            </tr>
                            <tr bgcolor="#CFE3B3">
                            <td style="text-align: center;" colspan="8"><?php echo $l2 ?></td>
                            </tr>
                            </tfoot>

                    </table>                        

                          
                </div>
        </div>
    <!-- END BLANK PAGE PORTLET-->
</div>

<div class="span10">
    <!-- BEGIN BLANK PAGE PORTLET-->
        <div class="widget orange">
                <div class="widget-title">
                        <h4><i class="icon-reorder"></i><?php echo $titulo1 ?></h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        </span>
                      </div>
                    <div class="widget-body">
                    <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                        <thead>
                        <tr>
                        <th></th>
                        <th>Folio</th>
                        <th>Fecha</th>
                        <th>Fecha inicial de Bloqueo</th>
                        <th>Fecha final de Bloqueo</th>
                        <th>Piezas</th>
                        <th>Importe</th>
                        <th>Iva</th>
                        <th>Total</th>
                        <th></th>
                        </tr>
                        </thead>

                              <tbody>
                                <?php
                                $num=0;$t1=0;$t2=0;$t3=0;$t4=0;$color ='black';
                                foreach ($q1->result()as $r1) {
                                $l1=anchor('pedido/a_pedido_dema_bloqueo/'.$r1->id,'Bloqueo de C&oacute;digos');
                                if($r1->id_orden==0){
                                $l0=anchor('pedido/sumit_pedido_dema_orden/'.$r1->id,'Generar Orden');
                                $color='gray';
                                }else{
                                $l0=anchor('pedido/a_excel_pedido_dema_suc/'.$r1->id,'Distribucion de pedido');
                                $color='blue';
                                }
                                $num=$num+1;
                                ?>
                                <tr>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $l0?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r1->id?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r1->fecha?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r1->fecha1?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r1->fecha2?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r1->ped,0)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r1->imp,2)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r1->iva,2)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r1->total,2)?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $l1?></td>                                                                
                                    <?php ?>

                                                                                       
                                </tr>
                                <?php
                                $t1=$t1+$r1->ped;
                                $t2=$t2+$r1->imp;
                                $t3=$t3+$r1->iva;
                                $t4=$t4+$r1->total;
                                }
                               ?>
                             </tbody>

                            <tfoot>
                            <tr>
                            <td colspan="4">Total</td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t1,0)?></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t2,2)?></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t3,2)?></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t4,2)?></td>
                            
                            </tfoot>

                    </table>                            

                          
                </div>
        </div>
    <!-- END BLANK PAGE PORTLET-->
</div>


