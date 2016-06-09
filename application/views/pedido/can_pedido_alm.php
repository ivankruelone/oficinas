

<div class="panel panel-default">
</div>
  
<div class="span10">

 <!-- BEGIN BLANK PAGE PORTLET-->
    <div class="widget blue">
        <div class="widget-title">
        <h4><i class="icon-reorder"></i> PEDIDOS ALMACEN <?php echo "DEL " . date("d") . " DE " . date("m") . " DE " . date("Y");
            ?> </h4>
        <span class="tools">
            <a href="javascript:;" class="icon-chevron-down"></a>
        </span>
            </div>
             <div class="widget-body">

              
            <thead>
                     <tr>

                        <div>
                        <ul id="demo"></ul>
                        </div>
                        <td colspan="6"> </td>
                    </tr>
            </thead>
                     <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                        <thead>
                        <tr>
                        <th>NIP</th>
                        <th>SUCURSAL</th>
                        <th>FECHA</th>
                        <th>FOLIO</th>
                        <th>CANTIDAD</th>
                        <th>MUEBLE</th>
                        <th>BORRAR</th>

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
                                                            

                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->suc ?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->sucx ?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->trasmitio?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->id?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->ped?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->mueble?></td>
                                <td><?php echo anchor('pedido/del_codi_pre_pedido/'.$r->suc.'/'.$r->id, 'Borrar'); ?></a></td>
                                
                                                          
                               
                                                                                                
                                   
                                                                                      
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

