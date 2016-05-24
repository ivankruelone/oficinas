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
                        <td align="left" ><font size="+1"><strong>Piezas</strong></font></td>
                        <td>
                        <?php echo form_input($piezas,"", 'required'); ?>
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

<div class="panel panel-default">
</div>
  
<div class="span5">

 <!-- BEGIN BLANK PAGE PORTLET-->
    <div class="widget blue">
        <div class="widget-title">
        <h4><i class="icon-reorder"></i> Buscar codigo por descripcion</h4>
        <span class="tools">
            <a href="javascript:;" class="icon-chevron-down"></a>
        </span>
            </div>
             <div class="widget-body">

              <?php
                    echo form_open('pedido/bus_codi_fanasa/');
                    echo "<br />";   
                    
                        $descripcion = array(
                        'name' => 'descripcion',
                        'id' => 'descripcion',
                        'size' => '50',
                        'style' => 'width:50%',
                        'value' => set_value('descripcion') 
                    );

                         $demo = array(
                        'name' => 'cod',
                        'id' => 'cod',
                        'size' => '50',
                        'style' => 'width:50%',
                        'value' => set_value('cod') 
                    );

                  ?> 
<thead>
                     <tr>
                        <td align="left" ><font size="+1"><strong>Descripcion</strong></font></td>
                        <td>
                        <?php echo form_input($descripcion,""); ?> 
                        <?php echo form_submit('mysubmit', 'Buscar'); ?>
                        <?php echo form_input($demo,""); ?> 
                        </td>
                        <div>
          <ul id="demo"></ul>
    </div>
                        <td colspan="6"> </td>
                    </tr>
</thead>
                     <table class="table table-bordered table-condensed table-striped table-hover" id="tabla0">

                        <thead>
                        <tr>
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                       
                        </tr>
                        </thead>

                          <tbody>
                                 <?php
                                $num=0;
                                foreach ($q2->result()as $r) {
                                $color ='black';
                                $num=$num+1;
                                ?>
                                <tr>
                                                            

                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->codigo?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->descripcion?></td>
                               
                               
                                                                                                
                                   
                                                                                      
                                </tr>
                                <?php
                                }
                                ?>
                             </tbody>

                    


                    </table>
                    <center>
                   

                    </center>
                   
                          
        </div>
    </div>
    <!-- END BLANK PAGE PORTLET-->
</div>



