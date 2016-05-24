

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
                                <th style="text-align: center;">Nid</th>
                                <th style="text-align: center;">Sucursal</th>
                                <th style="text-align: center;">Nomina</th>
                                <th style="text-align: center;">Empleado</th>
                                <th style="text-align: center;">Tipo</th>
                                <th style="text-align: center;">D&iacute;a</th>
                                <th style="text-align: center;">Fecha</th>
                                <th style="text-align: center;">Eventos</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            
                            <?php
                                    
                            $num=0;
                            
                            foreach ($q->result()as $r){
                            $num=$num+1;
                            
                            //$l1 = anchor('ventas/tarjetas_detalle/'.$suc.'/'.$mes.'/'.$aaa, '<i class="icon-folder-open"></i>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
//suc, nombre, nomina, empleado, tipoEvento, diaSemana, dianombre, fecha, eventos                            
                            ?>
                            
                            <tr>
                                <td style="text-align: right;"><?php echo $num?></td>
                                <td style="text-align: left;"><?php echo $r->suc?></td>
                                <td style="text-align: left;"><?php echo $r->nombre?></td>
                                <td style="text-align: center;"><?php echo $r->nomina?></td>
                                <td style="text-align: center;"><?php echo $r->empleado?></td>
                                <td><?php echo $r->tipoEvento?></td>
                                <td><?php echo $r->dianombre?></td>
                                <td><?php echo $r->fecha?></td>
                                <td><?php echo $r->eventos?></td>
                            </tr>
                            
                            <?php
                                    
                           	}
                            
                            ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE widget-->
                </div>
         