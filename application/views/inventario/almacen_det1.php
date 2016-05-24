
<div class="span12">
    <!-- BEGIN TAB PORTLET-->
        <div class="widget widget-tabs purple">
            <div class="widget-title">
                <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
            </div>
                    <div class="widget-body">
                        <div class="tabbable ">
                            <ul class="nav nav-tabs">
                                
                                <li><a href="#widget_tab3" data-toggle="tab">Septiembre-Diciembre</a></li>
                                <li><a href="#widget_tab2" data-toggle="tab">Mayo-Agosto</a></li>
                                <li class="active"><a href="#widget_tab1" data-toggle="tab">Enero-Abril</a></li>
                                
                            </ul>
                                    <div class="tab-content">
                                    
                                    <!-- ENERO-ABRIL-->                                   
                                        <div class="tab-pane active" id="widget_tab1">
                                        
                                            <?php $color3='green'; $color4='purple'; ?>
                                                <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                                                    <thead>
                                                        
                                                        <?php if($tipo=='fbo'){?>
                                                        <tr>
                                                            <th colspan="16" style="color:<?php echo $color4 ?>; text-align: center;">FARMABODEGA</th>
                                                        </tr>
                                                        <?php } ?>
                                                        
                                                        <?php if($tipo=='con'){?>
                                                        <tr>
                                                            <th colspan="16" style="color:<?php echo $color4 ?>; text-align: center;">CONTROLADOS Y ESPECIALIDAD</th>
                                                        </tr>
                                                        <?php } ?>
                                                        
                                                        <?php if($tipo=='agu'){?>
                                                        <tr>
                                                            <th colspan="16" style="color:<?php echo $color4 ?>; text-align: center;">AGUASCALIENTES</th>
                                                        </tr>
                                                        <?php } ?>
                                                        
                                                        <?php if($tipo=='tra'){?>
                                                        <tr>
                                                            <th colspan="16" style="color:<?php echo $color4 ?>; text-align: center;">TRASIMENO140</th>
                                                        </tr>
                                                        <?php } ?>
                                                        
                                                        <?php if($tipo=='alm'){?>
                                                        <tr>
                                                            <th colspan="16" style="color:<?php echo $color4 ?>; text-align: center;">CEDIS</th>
                                                        </tr>
                                                        <?php } ?>
                                                         
                                                         <tr>
                                                             <th colspan="4" style="color:<?php echo $color3 ?>; text-align: center">INVENTARIOS</th>
                                                             <th colspan="12" style="color:<?php echo $color3 ?>; text-align: center">DESPLAZAMIENTO</th>
                                                         </tr>
                                 
                                                         <tr>
                                                             <th colspan="4"></th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?>; text-align: center">Enero</th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?>; text-align: center">Febrero</th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?>; text-align: center">Marzo</th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?>; text-align: center">Abril</th>
                                                         </tr>
                                 
                                                         <tr>
                                                             <th style="text-align: left">Clave</th> 
                                                             <th style="color:gray; text-align: left">Sustancia Activa</th>
                                                             <th style="color:gray; text-align: left">Inv</th>
                                                             <th style="color:gray; text-align: right">A&ntilde;o</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                         </tr>
                                                    </thead>
                                                    <tbody>
                             
                                                         <?php
                                                        $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                                        
                                                        foreach ($a->result()as $r){
                                                        
                                                        ?>
                                                        <tr>
                                                            <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clabo?></td>
                                                            <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa1?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->inv,0)?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo (date('Y')-2).'<br />'.(date('Y')-1).'<br />'.date('Y')?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp012012,0).'<br />'.number_format($r->canp012013,0).'<br />'.number_format($r->canp012014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cans012012,0).'<br />'.number_format($r->cans012013,0).'<br />'.number_format($r->cans012014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cane012012,0).'<br />'.number_format($r->cane012013,0).'<br />'.number_format($r->cane012014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp022012,0).'<br />'.number_format($r->canp022013,0).'<br />'.number_format($r->canp022014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cans022012,0).'<br />'.number_format($r->cans022013,0).'<br />'.number_format($r->cans022014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cane022012,0).'<br />'.number_format($r->cane022013,0).'<br />'.number_format($r->cane022014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp032012,0).'<br />'.number_format($r->canp032013,0).'<br />'.number_format($r->canp032014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cans032012,0).'<br />'.number_format($r->cans032013,0).'<br />'.number_format($r->cans032014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cane032012,0).'<br />'.number_format($r->cane032013,0).'<br />'.number_format($r->cane032014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp042012,0).'<br />'.number_format($r->canp042013,0).'<br />'.number_format($r->canp042014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cans042012,0).'<br />'.number_format($r->cans042013,0).'<br />'.number_format($r->cans042014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cane042012,0).'<br />'.number_format($r->cane042013,0).'<br />'.number_format($r->cane042014,0) ?></td>
                                                        </tr>
                                                         <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                              
                                                    </tfoot>
                                                </table>     
                            
                                                     
                                        
                                        </div>
                                        
                                        <div class="tab-pane" id="widget_tab2">
                                        <!--MAYO-AGOSTO-->
                                            <?php $color3='green'; $color4='purple'; ?>
                                                <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="16" style="color:<?php echo $color4 ?>; text-align: center;">FARMABODEGA</th>
                                                        </tr>
                                                         <tr>
                                                             <th colspan="4" style="color:<?php echo $color3 ?>; text-align: center">INVENTARIOS</th>
                                                             <th colspan="12" style="color:<?php echo $color3 ?>; text-align: center">DESPLAZAMIENTO</th>
                                                         </tr>
                                 
                                                         <tr>
                                                             <th colspan="4"></th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?> text-align: center">Mayo</th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?> text-align: center">Junio</th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?> text-align: center">Julio</th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?> text-align: center">Agosto</th>
                                                         </tr>
                                 
                                                         <tr>
                                                             <th style="text-align: left">Clave</th> 
                                                             <th style="color:gray; text-align: left">Sustancia Activa</th>
                                                             <th style="color:gray; text-align: left">Inv</th>
                                                             <th style="color:gray; text-align: right">A&ntilde;o</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                         </tr>
                                                    </thead>
                                                    <tbody>
                             
                                                         <?php
                                                        $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                                        
                                                        foreach ($a->result()as $r){
                                                        
                                                        ?>
                                                            <tr>
                                                            <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clabo?></td>
                                                            <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa1?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->inv,0)?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo (date('Y')-2).'<br />'.(date('Y')-1).'<br />'.date('Y')?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp052012,0).'<br />'.number_format($r->canp052013,0).'<br />'.number_format($r->canp052014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cans052012,0).'<br />'.number_format($r->cans052013,0).'<br />'.number_format($r->cans052014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cane052012,0).'<br />'.number_format($r->cane052013,0).'<br />'.number_format($r->cane052014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp062012,0).'<br />'.number_format($r->canp062013,0).'<br />'.number_format($r->canp062014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cans062012,0).'<br />'.number_format($r->cans062013,0).'<br />'.number_format($r->cans062014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cane062012,0).'<br />'.number_format($r->cane062013,0).'<br />'.number_format($r->cane062014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp072012,0).'<br />'.number_format($r->canp072013,0).'<br />'.number_format($r->canp072014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cans072012,0).'<br />'.number_format($r->cans072013,0).'<br />'.number_format($r->cans072014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cane072012,0).'<br />'.number_format($r->cane072013,0).'<br />'.number_format($r->cane072014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp082012,0).'<br />'.number_format($r->canp082013,0).'<br />'.number_format($r->canp082014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cans082012,0).'<br />'.number_format($r->cans082013,0).'<br />'.number_format($r->cans082014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cane082012,0).'<br />'.number_format($r->cane082013,0).'<br />'.number_format($r->cane082014,0) ?></td>
                                                        </tr>
                                                        <?php  } ?>
                                                    </tbody>
                                                      <tfoot>
                                                      
                                                     </tfoot>
                                                </table>     
                            
                                                   
                                        
                                        
                                        </div>
                                        
                                        
                                        <div class="tab-pane" id="widget_tab3">
                                        
                                        <!--MAYO-AGOSTO-->
                                        
                                            <?php $color3='green'; $color4='purple'; ?>
                                                <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="16" style="color:<?php echo $color4 ?>; text-align: center;">FARMABODEGA</th>
                                                        </tr>
                                                         <tr>
                                                             <th colspan="4" style="color:<?php echo $color3 ?>; text-align: center">INVENTARIOS</th>
                                                             <th colspan="12" style="color:<?php echo $color3 ?>; text-align: center">DESPLAZAMIENTO</th>
                                                         </tr>
                                 
                                                         <tr>
                                                             <th colspan="4"></th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?> text-align: center">Septiembre</th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?> text-align: center">Octubre</th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?> text-align: center">Noviembre</th>
                                                             <th colspan="3" style="color:<?php echo $color3 ?> text-align: center">Diciembre</th>
                                                         </tr>
                                 
                                                         <tr>
                                                             <th style="text-align: left">Clave</th> 
                                                             <th style="color:gray; text-align: left">Sustancia Activa</th>
                                                             <th style="color:gray; text-align: left">Inv</th>
                                                             <th style="color:gray; text-align: right">A&ntilde;o</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                             <th style="color:gray; text-align: right">Ped</th>
                                                             <th style="color:gray; text-align: right">Sur</th>
                                                             <th style="color:gray; text-align: right">Ent</th>
                                                         </tr>
                                                     </thead>
                                                     <tbody>
                             
                                                         <?php
                                                        $color='gray'; $color1='black'; $color2='blue'; $aaa=date('Y');
                                                        
                                                        foreach ($a->result()as $r){
                                                        
                                                        ?>
                                                        <tr>
                                                            <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clabo?></td>
                                                            <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa1?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->inv,0)?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo (date('Y')-2).'<br />'.(date('Y')-1).'<br />'.date('Y')?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp092012,0).'<br />'.number_format($r->canp092013,0).'<br />'.number_format($r->canp092014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp092012,0).'<br />'.number_format($r->cans092013,0).'<br />'.number_format($r->cans092014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp092012,0).'<br />'.number_format($r->cane092013,0).'<br />'.number_format($r->cane092014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp102012,0).'<br />'.number_format($r->canp102013,0).'<br />'.number_format($r->canp102014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp102012,0).'<br />'.number_format($r->cans102013,0).'<br />'.number_format($r->cans102014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp102012,0).'<br />'.number_format($r->cane102013,0).'<br />'.number_format($r->cane102014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp112012,0).'<br />'.number_format($r->canp112013,0).'<br />'.number_format($r->canp112014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp112012,0).'<br />'.number_format($r->cans112013,0).'<br />'.number_format($r->cans112014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp112012,0).'<br />'.number_format($r->cane112013,0).'<br />'.number_format($r->cane112014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp122012,0).'<br />'.number_format($r->canp122013,0).'<br />'.number_format($r->canp122014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp122012,0).'<br />'.number_format($r->cans122013,0).'<br />'.number_format($r->cans122014,0) ?></td>
                                                            <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->canp122012,0).'<br />'.number_format($r->cane122013,0).'<br />'.number_format($r->cane122014,0) ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                      </tbody>
                                                      <tfoot>
                                                      
                                                     </tfoot>
                                                 </table>     
                            
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TAB PORTLET-->
                </div>
                 
                 
