

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
                                <th style="text-align: center;">Salida</th>
                                <th style="text-align: center;">Sucursal</th>
                                <th style="text-align: center;">Nombre</th>
                                <th style="text-align: center;">Fec. Entrada</th>
                                <th style="text-align: center;">Fec. Salida</th>
                                <th style="text-align: center;">Equipo</th>
                                <th style="text-align: center;">Marca</th>
                                <th style="text-align: center;">Modelo</th>
                                <th style="text-align: center;">Serie</th>
                                <th style="text-align: center;">Soluci&oacute;n</th>
                                <th style="text-align: center;">Persona</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            
                            <?php
                                    
                            $num=0;
                            
                            foreach ($a->result()as $r){
                            $num=$num+1;
                            $suc = $r->suc;
                            //$l1 = anchor('ventas/tarjetas_detalle/'.$suc.'/'.$mes.'/'.$aaa, '<i class="icon-folder-open"></i>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                            
                            ?>
                            
                            <tr>
                                <td style="text-align: right;"><?php echo $num?></td>
                                <td style="text-align: right;"><?php echo $r->id?></td>
                                <td style="text-align: right;"><?php echo $suc?></td>
                                <td><?php echo $r->nombre?></td>
                                <td style="text-align: center;"><?php echo $r->fece?></td>
                                <td style="text-align: center;"><?php echo $r->fecha?></td>
                                <td><?php echo $r->equipo?></td>
                                <td><?php echo $r->marca?></td>
                                <td><?php echo $r->modelo?></td>
                                <td><?php echo $r->serie?></td>
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
         