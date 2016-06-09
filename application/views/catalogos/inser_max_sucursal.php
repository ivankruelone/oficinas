
<div class="panel panel-default">
    </div>
    <div class="span4">

     <!-- BEGIN BLANK PAGE PORTLET-->
        <div class="widget blue">
            <div class="widget-title">
                <h4><i class="icon-reorder"></i> Maximo Sucursal</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
                <div class="widget-body">
                 
                  <?php
                    echo form_open('catalogos/inser_max_sucursal');
                    echo "<br />";   

                    $sec = array(
                        'name' => 'sec',
                        'id' => 'sec',
                        'size' => '30',              
                        'value' => set_value('sec') 
                    );

                    $cant = array(
                        'name' => 'cant',
                        'id' => 'cant',
                        'size' => '30',              
                        'value' => set_value('cant') 
                    );


                  ?>  

                   <table> 

                     <tr>
                      
                        <td align="left" ><font size="+0.5"><strong>Secuencia</strong></font></td>
                        <td align="left" ><?php echo form_input($sec,"", 'required'); ?></td>
                   
                    </tr>

                      <tr>
                        <td align="left" ><font size="+0.5"><strong>Cantidad</strong></font></td>
                        <td>
                        <?php echo form_input($cant,"", 'required'); ?>
                        </td>
                     
                    </tr>
 
                   </table>
              
                    <center>
                    <div class="row">
                       <input type="submit" class="btn btn-primary dropdown-toggle" value="Agregar" />
                        <?php  
                            echo "<br />";
                            echo "<br />";
                            echo form_close();
                        ?>
                    </center>
                   
                          
        </div>
    </div>
    <!-- END BLANK PAGE PORTLET-->
</div>


<?php
//$valor= 1;
if($q !=null){

 ?>
    
<div class="panel panel-default">
    </div>
    <div class="span8">

     <!-- BEGIN BLANK PAGE PORTLET-->
        <div class="widget blue">
            <div class="widget-title">
                <h4><i class="icon-reorder"></i> Sucursales aplicadas</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
                </div>
                <div class="widget-body">
                 
                     <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">


                        <caption></caption> 
                            <thead>
                                <tr>
                                    <th>SECUENCIA</th>
                                    <th>SUCURSAL</th>
                                    <th>DESCRIPCION</th>
                                    <th>CANTIDAD</th>
                                                                       
                                 </tr>
                             </thead>
                             <tbody>
                                <?php
                                $num=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                ?>
                                <tr>
                                    <td style="text-align: center; color: <?php echo $color='orange' ?>;"><?php echo $r->sec?></td>
                                    <td style="text-align: center; color: <?php echo $color='black' ?>;"><?php echo $r->suc?></td>
                                    <td style="text-align: left; color: <?php echo $color='black' ?>;"><?php echo $r->susa?></td>
                                    <td style="text-align: center; color: <?php echo $color ='orange'?>;"><?php echo $r->final?></td>
                                    
                                                                       
                                </tr>
                                <?php
                                }
                                ?>
                             </tbody>


                     
                   </table>
              
                    <center>
                    <div class="row">
                       
                       
                    </center>
                   
                          
        </div>
    </div>
    <!-- END BLANK PAGE PORTLET-->
</div>





<?php }else{ ?>
<div class="span11">

</div>
<div class="span4">
<div class="alert alert-danger"> NO SE ENCONTRO NINGUNA ACTUALIZACION CON EL NUMERO DE SECUENCIA</div>
</div>


<?php
}
?>