
<div class="span6">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget yellow">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-striped table-bordered" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th>Fecha</th>
                                        <th>Sucursal</th>
                                        <th style="text-align: center;">Tickets</th>
                                        <th style="text-align: center;">Importe</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    
                                    <?php
                                    $color='red';
                                    $num=0;
                                    $total=0;
                                    $totaltick=0;
                                    
                                    
                                    
                                    
	                                   foreach ($a->result()as $r){
                                        
                                        $suc = $r->suc;
                                        //$l1 = anchor('ventas/tickets_detalle/'.$suc.'/'.$mes.'/'.$aaa, '<i class="icon-folder-open"></i>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));  
                                        $num=$num+1;
                                        
                                   ?>
                                    <tr>
                                        <td style="text-align: right;"><?php echo $num?></td>
                                        <td><?php echo $r->fecha?></td>
                                        <td><?php echo $suc.'-'.$r->nombre?></td>
                                        <td style="text-align: right;"><?php echo number_format($r->tickets,0)?></td>
                                        <td style="text-align: right;">$<?php echo number_format($r->importe, 2)?></td>
                                        
                                    </tr>
                                    
                                    <?php
                                    $totaltick=$totaltick+($r->tickets);
                                    $total=$total+($r->importe);
                                    
                                    	}
                                    ?>
                                     
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align: right;">Total</td>
                                            <td style="color: <?php echo $color?>; text-align: right;">$<?php echo number_format($total, 2)?></td>
                                        </tr>
                                    
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                        
                    </div>
                    
                    

    