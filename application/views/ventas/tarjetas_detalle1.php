

                <div class="span12">
                <!-- BEGIN EXAMPLE TABLE widget-->
                <div class="widget red">
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
                                <th style="text-align: center;">Sucursal</th>
                                <th style="text-align: center;">Nombre</th>
                                <th style="text-align: center;">Nomina</th>
                                <th style="text-align: center;">Completo</th>
                                <th style="text-align: center;">Tarjetas vendidas</th>
                                <th style="text-align: center;">Fechas</th>
                                <th style="text-align: center;">Tiket</th>
                                <th style="text-align: center;">Comision</th>
                                
                            </tr>
                            </thead>
                            
                            <tbody>
                            
                            <?php
                                    
                            $num=0;
                            $com = 10;
                            $color= 'red';
                            $tarjetas=0;
                            $comision=0;
                            
                            foreach ($a->result()as $r){
                            $num=$num+1;
                            $tarjetas=$tarjetas+$r->cantidad;
                            $comision=$comision+$com;
                            $suc = $r->suc;
                            
                            
                            ?>
                            
                            <tr>
                                <td style="text-align: right;"><?php echo $num?></td>
                                <td style="text-align: right;"><?php echo $suc?></td>
                                <td><?php echo $r->nombre?></td>
                                <td style="text-align: right;"><?php echo $r->nomina?></td>
                                <td><?php echo $r->completo?></td>
                                <td style="text-align: right;"><?php echo $r->cantidad?></td>
                                <td style="text-align: center;"><?php echo $r->fecha?></td>
                                <td style="text-align: right;"><?php echo $r->tiket?></td>
                                <td style="text-align: right;">$<?php echo $com?></td>
                            </tr>
                            
                            <?php
                                    
                           	}
                            
                            ?>
                            
                            </tbody>
                            <tfoot>
                                <tr>
                                <td colspan="5" style="color: maroon;text-align: right;">TOTAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($tarjetas,0)?></td>
                                <td></td>
                                <td></td>
                                <td style="color: maroon;text-align: right;">$<?php echo number_format($comision,2)?></td>
                                </tr>
                                
                                
                             </tfoot>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE widget-->
                </div>
         