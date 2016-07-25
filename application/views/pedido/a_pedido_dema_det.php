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
                    <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                        <thead>
                        <tr>
                        <th>Nid</th>
                        <th>Sucursal</th>
                        <th>Inv</th>
                        <th>Desplaza</th>
                        <th>Pedido</th>
                        <th></th>
                        <th>Costo</th>
                        <th>Imp</th>
                        <th>Iva</th>
                        <th>Total</th>
                        
                        </tr>
                        </thead>

                              <tbody>
                                <?php
                                $num=0;$t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;
                                foreach ($q->result()as $r) {
                                $data_ped = array(
                                       'name'        => 'pedi_'.$r->id,
                                       'id'          => $r->id,
                                       'size'        => '5',
                                       'maxlength'   => '5',
                                       'class'       => 'span3',
                                       'autofocus'   => 'autofocus',
                                       'value'       => $r->ped
                                        );
                                $data_imp= array(
                                'name'        => 'imp_',
                                'id'          => 'imp_',
                                'type'        => 'text',
                                'maxlength'   => '255',
                                'disabled'     => 'disabled'
            ); 
                    
                                $color ='black';
                                $num=$num+1;
                                ?>
                                <tr>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->suc?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->nombre?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r->inv,0)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r->venta,0)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><span id="pedidoact_<?php echo $r->id; ?>"><?php echo $r->ped?></span></td>
                                <td style="text-align: center;"><?php echo form_input($data_ped, "", 'required');?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r->cos,2)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r->imp,2)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r->iva,2)?></td>
                                <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($r->total,2)?></td>
                                <?php ?>

                                                                                       
                                </tr>
                                <?php
                                $t1=$t1+$r->inv;
                                $t2=$t2+$r->venta;
                                $t3=$t3+$r->ped;
                                $t4=$t4+$r->imp;
                                $t5=$t5+$r->iva;
                                $t6=$t6+$r->total;
                                }
                                ?>
                             </tbody>

                            <tfoot>
                            <tr>
                            <td colspan="2">Total</td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t1,0)?></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t2,0)?></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t3,0)?></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t4,2)?></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t5,2)?></td>
                            <td style="text-align: right; color: <?php echo $color ?>;"><?php echo number_format($t6,2)?></td>
                            </tr>
                            </tfoot>

                    </table>                        

                          
                </div>
        </div>
    <!-- END BLANK PAGE PORTLET-->
</div>



