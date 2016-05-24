    <?php
    
	$productos = round(($productos_actuales / $productos_meta) * 100, 2);
    $sustancia = round(($productos_sin_sustancia / $productos_actuales) * 100, 2);
    $precioMaximo = round(($productos_sin_precioMaximoPublico / $productos_actuales) * 100, 2);
    $sinLaboratorio = round(($productos_sin_laboratorio / $productos_actuales) * 100, 2);
    $sinLinea = round(($productos_sin_linea / $productos_actuales) * 100, 2);
    $sinSublinea = round(($productos_sin_sublinea / $productos_actuales) * 100, 2);
    $formaFarmaceutica = round(($productos_sin_formaFarmaceutica / $productos_actuales) * 100, 2);
    $concentracion = round(($productos_sin_concentracion / $productos_actuales) * 100, 2);
    
    ?>
<div class="row-fluid">
     
     <div class="span7">
    <h3 class="page-title">
                     Indicadores
                   </h3>
                   
    </div>
</div>
    
    
     <div class="row-fluid">
                <div class="span12">
                    <!--BEGIN GENERAL STATISTICS-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> Indicadores de Productos </h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                         </span>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                                <div class="easy-pie-chart">
                                    <div class="percentage success" data-percent="<?php echo $productos; ?>"><span><?php echo $productos; ?></span>%</div>
                                    <div class="title">Meta</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $sustancia; ?>"><span><?php echo $sustancia; ?></span>%</div>
                                    <div class="title">Sin sustancia</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $precioMaximo; ?>"><span><?php echo $precioMaximo; ?></span>%</div>
                                    <div class="title">Sin precio maximo</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $sinLaboratorio; ?>"><span><?php echo $sinLaboratorio; ?></span>%</div>
                                    <div class="title">Sin laboratorio</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $sinLinea; ?>"><span><?php echo $sinLinea; ?></span>%</div>
                                    <div class="title">Sin linea</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $sinSublinea; ?>"><span><?php echo $sinSublinea; ?></span>%</div>
                                    <div class="title">Con linea y sin sublinea</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $formaFarmaceutica; ?>"><span><?php echo $formaFarmaceutica; ?></span>%</div>
                                    <div class="title">Sin forma farmaceutica</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $concentracion; ?>"><span><?php echo $concentracion; ?></span>%</div>
                                    <div class="title">Sin concentracion</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END GENERAL STATISTICS-->
                </div>


                
     </div>


     <div class="row-fluid">
                <div class="span12">
                    <!--BEGIN GENERAL STATISTICS-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-tasks"></i> Indicadores de Secuencias </h4>
                         <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                         </span>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                                <div class="easy-pie-chart">
                                    <div class="percentage success" data-percent="<?php echo $productos; ?>"><span><?php echo $productos; ?></span>%</div>
                                    <div class="title">Meta</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $sustancia; ?>"><span><?php echo $sustancia; ?></span>%</div>
                                    <div class="title">Sin sustancia</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $precioMaximo; ?>"><span><?php echo $precioMaximo; ?></span>%</div>
                                    <div class="title">Sin precio maximo</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $sinLaboratorio; ?>"><span><?php echo $sinLaboratorio; ?></span>%</div>
                                    <div class="title">Sin laboratorio</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $sinLinea; ?>"><span><?php echo $sinLinea; ?></span>%</div>
                                    <div class="title">Sin linea</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $sinSublinea; ?>"><span><?php echo $sinSublinea; ?></span>%</div>
                                    <div class="title">Con linea y sin sublinea</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $formaFarmaceutica; ?>"><span><?php echo $formaFarmaceutica; ?></span>%</div>
                                    <div class="title">Sin forma farmaceutica</div>
                                </div>
                                <div class="easy-pie-chart">
                                    <div class="percentage" data-percent="<?php echo $concentracion; ?>"><span><?php echo $concentracion; ?></span>%</div>
                                    <div class="title">Sin concentracion</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END GENERAL STATISTICS-->
                </div>


                
     </div>