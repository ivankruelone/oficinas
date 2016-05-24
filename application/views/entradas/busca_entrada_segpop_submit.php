<div class="row-fluid">
<div class="span12">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget yellow">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i><?php echo $tit?> segpop</h4>
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
                                        <th>Tipo</th>
                                        <th>Fecha</th>
                                        <th>Folio</th>
                                        <th>Orden</th>
                                        <th>Factura</th>
                                        <th>Proveedor</th>
                                        <th>Clave</th>
                                        <th>Codigo</th>
                                        <th>Lote</th>
                                        <th>Caducidad</th>
                                        <th>Piezas</th>
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
                                        <td><?php echo $r->tipo?></td>
                                        <td><?php echo $r->aaae.'-'.$r->mese.'-'.$r->diae?></td>
                                        <td style="text-align: right;"><?php echo $r->nped?></td>
                                        <td style="text-align: right;"><?php echo $r->folprv?></td>
                                        <td style="text-align: right;"><?php echo $r->factura?></td>
                                        <td><?php echo $r->prv.' - '.$r->prvx?></td>
                                        <td><?php echo $r->claves.' - '.$r->susa?></td>
                                        <td style="text-align: right;"><?php echo $r->codigo?></td>
                                        <td><?php echo $r->lote?></td>
                                        <td><?php echo $r->caducidad?></td>
                                        <td style="text-align: right;"><?php echo $r->cans?></td>
                                        <td style="text-align: right;">$<?php echo number_format($r->costo, 2)?></td>
                                        <td style="text-align: right;">$<?php echo number_format($r->cans*$r->costo, 2)?></td>
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