<div class="row-fluid">
<div class="span12">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget yellow">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i><?php echo $tit?> CEDIS</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove" id="tabla1"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Orden</th>
                                        <th>Proveedor</th>
                                        <th>Factura</th>
                                        <th>Clave</th>
                                        <th>Lote</th>
                                        <th>Caducidad</th>
                                        <th>Piezas</th>
                                        <th>Codigo</th>
                                        <th>Costo</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    
                                    <?php
                                    $num=0;
	                                   foreach ($query->result()as $r){
                                        $num=$num+1;
                                   ?>
                                    <tr>
                                        <td style="text-align: right;"><?php echo $num?></td>
                                        <td><?php echo $r->fechai?></td>
                                        <td style="text-align: right;"><?php echo $r->orden?></td>
                                        <td><?php echo $r->prv.' - '.$r->razo?></td>
                                        <td><?php echo $r->fac?></td>
                                        <td><?php echo $r->sec.' - '.$r->susa1?></td>
                                        <td><?php echo $r->lote?></td>
                                        <td><?php echo $r->cadu?></td>
                                        <td style="text-align: right;"><?php echo $r->can?></td>
                                        <td style="text-align: right;"><?php echo $r->codigo?></td>
                                        <td style="text-align: right;">$<?php echo number_format($r->costo, 2)?></td>
                                        <td style="text-align: right;">$<?php echo number_format($r->can*$r->costo, 2)?></td>
                                    </tr>
                                    
                                    <?php
                                    	}
                                    ?>
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                        
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget yellow">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i><?php echo $tit?> METRO</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove" id="tabla1"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Orden</th>
                                        <th>Proveedor</th>
                                        <th>Factura</th>
                                        <th>Clave</th>
                                        <th>Lote</th>
                                        <th>Caducidad</th>
                                        <th>Piezas</th>
                                        <th>Codigo</th>
                                        <th>Costo</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    
                                    <?php
                                    $num=0;
	                                   foreach ($q->result()as $r){
                                        $num=$num+1;
                                   ?>
                                    <tr>
                                        <td style="text-align: right;"><?php echo $num?></td>
                                        <td><?php echo $r->fecha?></td>
                                        <td style="text-align: right;"><?php echo $r->orden?></td>
                                        <td><?php echo $r->prv.' - '.$r->prvx?></td>
                                        <td><?php echo $r->factura?></td>
                                        <td><?php echo $r->clave.' - '.$r->susa1?></td>
                                        <td><?php echo $r->lote?></td>
                                        <td><?php echo $r->caducidad?></td>
                                        <td style="text-align: right;"><?php echo $r->can?></td>
                                        <td style="text-align: right;"><?php echo $r->codigo?></td>
                                        <td style="text-align: right;">$<?php echo number_format($r->costo, 2)?></td>
                                        <td style="text-align: right;">$<?php echo number_format($r->can*$r->costo, 2)?></td>
                                    </tr>
                                    
                                    <?php
                                    	}
                                    ?>
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                        
                         <!-- BEGIN BASIC PORTLET-->
                        <div class="widget yellow">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i><?php echo $tit?> FARMABODEGA</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove" id="tabla1"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Orden</th>
                                        <th>Proveedor</th>
                                        <th>Factura</th>
                                        <th>Clave</th>
                                        <th>Lote</th>
                                        <th>Caducidad</th>
                                        <th>Piezas</th>
                                        <th>Codigo</th>
                                        <th>Costo</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    
                                    <?php
                                    $num=0;
	                                   foreach ($q1->result()as $r){
                                        $num=$num+1;
                                        
                                   ?>
                                    <tr>
                                        <td style="text-align: right;"><?php echo $num?></td>
                                        <td><?php echo $r->fecha?></td>
                                        <td style="text-align: right;"><?php echo $r->orden?></td>
                                        <td><?php echo $r->prv.' - '.$r->prvx?></td>
                                        <td style="text-align: right;"><?php echo $r->factura?></td>
                                        <td><?php echo $r->clave.' - '.$r->susa1?></td>
                                        <td style="text-align: right;"><?php echo $r->lote?></td>
                                        <td><?php echo $r->caducidad?></td>
                                        <td style="text-align: right;"><?php echo $r->can?></td>
                                        <td style="text-align: right;"><?php echo $r->codigo?></td>
                                        <td style="text-align: right;">$<?php echo number_format($r->costo, 2)?></td>
                                        <td style="text-align: right;">$<?php echo number_format($r->can*$r->costo, 2)?></td>
                                    </tr>
                                    
                                    <?php
                                    	}
                                    ?>
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                    </div>
                </div>