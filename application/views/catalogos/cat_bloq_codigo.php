
<div class="panel panel-default">
</div>
  
<div class="span5">

 <!-- BEGIN BLANK PAGE PORTLET-->
    <div class="widget blue">
        <div class="widget-title">
        <h4><i class="icon-reorder"></i> Agregar Codigo </h4>
        <span class="tools">
            <a href="javascript:;" class="icon-chevron-down"></a>
        </span>
            </div>
             <div class="widget-body">
                 
                 <?php
                    echo form_open('catalogos/ins_bloq_codigo');
                    echo "<br />";   
                    
                     $codigo = array(
                        'name' => 'codigo',
                        'id' => 'codigo',
                        'size' => '50',
                        'style' => 'width:50%',
                        'value' => set_value('codigo') 
                    );

                  ?>  

                    <table> 

                     <tr>
                        <td align="left" ><font size="+1"><strong>Codigo</strong></font></td>
                        <td>
                        <?php echo form_input($codigo,"", 'required'); ?>
                        </td>
                        <td colspan="6"> </td>
                    </tr>
                    
                    <tr>
                        <td align="left" ><font size="+1"><strong>Sucursal</strong></font></td>
                        <td><?php echo form_dropdown('suc', $suc, '', 'id="suc"') ;?></td>
                        <td colspan="6"></td>
                    </tr>

                    </table>
                    <center>
                    <?php  

                        echo form_submit('mysubmit', 'Agregar');

                        echo "<br />";
                        echo "<br />";
                        echo form_close();
                    ?>

                    </center>
                   
                          
        </div>
    </div>
    <!-- END BLANK PAGE PORTLET-->
</div>

<!-- PENDIENTES POR VALIDAR-->

<div class="span10">
    <!-- BEGIN BLANK PAGE PORTLET-->
        <div class="widget orange">
                <div class="widget-title">
                        <h4><i class="icon-reorder"></i>Codigos Pendientes a validar</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        </span>
                      </div>
                    <div class="widget-body">

                    <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                        <thead>
                        <tr>
                        <th>NID</th>
                        <th>SUCURSAL</th>
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th style="color:#FF9770;"><CENTER>VALIDAR</CENTER></th>
                        
                        </tr>
                        </thead>

                         <tbody>
                                 <?php
                                $num=0;
                                foreach ($q->result()as $r) {
                                $color ='black';
                                $num=$num+1;
                                ?>
                                <tr>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->suc?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->nombre?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->codigo?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->descripcion?></td>
                                                                                                
                                <?php $id=$r->id_cod;
                                                                    ?>
                                <td><?php echo anchor('catalogos/aplic_bloq_codigo/'.$id, 'Aplicar'); ?></a></td>
                                <td><?php echo anchor('catalogos/del_bloq_codigo/'.$id, 'Borrar'); ?></a></td>
                                                                                      
                                </tr>
                                <?php
                                }
                                ?>
                             </tbody>

                    </table>                        

                          
                </div>
        </div>
    <!-- END BLANK PAGE PORTLET-->
</div>

<!-- VALIDADOS -->

<div class="span10">
    <!-- BEGIN BLANK PAGE PORTLET-->
        <div class="widget green">
                <div class="widget-title">
                        <h4><i class="icon-reorder"></i>Codigos Validados </h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        </span>
                      </div>
                    <div class="widget-body">

                    <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                        <thead>
                        <tr>
                        <th>NID</th>
                        <th>SUCURSAL</th>
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th>FECHA DE VALIDACION</th>
                        </tr>
                        </thead>

                         <tbody>
                                 <?php
                                $num=0;
                                foreach ($q1->result()as $r) {
                                $color ='black';
                                $num=$num+1;
                                ?>
                                <tr>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->suc?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->nombre?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->codigo?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->descripcion?>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->fecha_mov?></td>
                                                                                     
                                </tr>
                                <?php
                                }
                                ?>
                             </tbody>

                    </table>                        

                          
                </div>
        </div>
    <!-- END BLANK PAGE PORTLET-->
</div>
