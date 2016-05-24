


<div class="panel panel-default">
</div>
  
<div class="span5">

 <!-- BEGIN BLANK PAGE PORTLET-->
    <div class="widget blue">
        <div class="widget-title">
        <h4><i class="icon-reorder"></i> Agregar al pedido</h4>
        <span class="tools">
            <a href="javascript:;" class="icon-chevron-down"></a>
        </span>
            </div>
             <div class="widget-body">
                 
                 <?php
                    echo form_open('pedido/ins_pre_pedido_fenix');
                    echo "<br />";   
                    
                     $codigo = array(
                        'name' => 'codigo',
                        'id' => 'codigo',
                        'size' => '50',
                        'style' => 'width:50%',
                        'value' => set_value('codigo') 
                    );

                     $piezas = array(
                        'name' => 'piezas',
                        'id' => 'piezas',
                        'size' => '50',
                        'style' => 'width:50%',
                        'value' => set_value('piezas') 
                    );

                  
                     $attributes = array(
                    'id' => 'descripcion',
                    'size' => '40',
                    'style' => 'color:  #097164;',
                    );



                       

                  ?>  

                    <table> 

                     


                           <tr>
                        <td align="left" ><font size="+0"><strong>Codigo</strong></font></td>
                        <td>
                                    <?php echo form_input($codigo,"", 'required'); ?>
                             </td>
                        <td colspan="8"> </td>
                    </tr>
                            

                        <tr>
                        <td align="left" ><font size="+0"><strong>Descripcion:</strong></font></td>
                        <td>
                        <?php echo form_label('', 'descripcion', $attributes); ?>
                        </td>
                        <td colspan="8"> </td>
                    </tr>





                    <tr>
                        <td align="left" ><font size="+0"><strong>Piezas</strong></font></td>
                        <td>
                        <?php echo form_input($piezas,"", 'required'); ?>
                        </td>
                        <td colspan="8"> </td>
                    </tr>



                    <tr>
                        <td align="left" ><font size="+0"><strong>Sucursal</strong></font></td>
                        <td><?php echo form_dropdown('suc', $suc, '', 'id="suc"') ;?></td>
                        <td colspan="8"></td>
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
                        <th>PIEZAS</th>
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

                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->cod?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->descri?></td>
                               
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->piezas?></td>
                                                                                                
                                    <?php $suc=$r->suc; $cod=$r->cod; ?>

                                <td><?php echo anchor('pedido/aplic_cod_pre_pedido/'.$suc.'/'.$cod, 'Aplicar'); ?></a></td>
                                <td><?php echo anchor('pedido/del_codi_pre_pedido/'.$suc.'/'.$cod, 'Borrar'); ?></a></td>
                                                                                      
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

<div class="span10">
    <!-- BEGIN BLANK PAGE PORTLET-->
        <div class="widget green">
                <div class="widget-title">
                        <h4><i class="icon-reorder"></i>Pedido especial de hoy </h4>
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
                        <th>PIEZAS</th>
                        <th>FECHA</th>
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
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->cod?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->descri?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->piezas?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->fecha?></td>                                                 
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


