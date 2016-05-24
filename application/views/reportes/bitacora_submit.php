

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
                                <th style="text-align: center;">Solicita</th>
                                <th style="text-align: center;">Departamento</th>
                                <th style="text-align: center;">Fec. Reporte</th>
                                <th style="text-align: center;">Fec. Libera</th>
                                <th style="text-align: center;">Problema</th>
                                <th style="text-align: center;">Soluci&oacute;n</th>
                                <th style="text-align: center;">Persona</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            
                            <?php
                                    
                            $num=0;
                            
                            foreach ($q->result()as $r){
                            $num=$num+1;
                            
                            //$l1 = anchor('ventas/tarjetas_detalle/'.$suc.'/'.$mes.'/'.$aaa, '<i class="icon-folder-open"></i>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                            
                            ?>
                            
                            <tr>
                                <td style="text-align: right;"><?php echo $num?></td>
                                <td style="text-align: left;"><?php echo $r->solicita?></td>
                                <td style="text-align: left;"><?php echo $r->departamento?></td>
                                <td style="text-align: center;"><?php echo $r->created_at?></td>
                                <td style="text-align: center;"><?php echo $r->updated_at?></td>
                                <td><?php echo $r->proble?></td>
                                <td><?php echo $r->solucion?></td>
                                <td><?php echo $r->empleado?></td>
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
         