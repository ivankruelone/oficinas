
<div class="panel panel-default">
</div>
  
<div class="span6">

 <!-- BEGIN BLANK PAGE PORTLET-->
    <div class="widget red">
        <div class="widget-title">
        <h4><i class="icon-reorder"></i>SOLICITUD DE PEDIDOS POR SUPERVISOR</h4>
        <span class="tools">
     <!--  <a href="javascript:;" class="icon-chevron-down"></a> -->
        </span>
            </div>
             <div class="widget-body">
                 
              
                    <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                        <thead>
                        <tr>
                        <th>NID</th>
                        <th>SUCURSAL</th>
                        <th>SUPERVISOR</th>
                        <th style="color:#FF9770;"><CENTER>PEDIDO</CENTER></th>
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
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->nom_sup?></td>
                                <?php $suc=$r->suc; ?>
                                                                                               
                                <td><?php echo anchor('pedido/ver_pedido_sup/'.$suc, 'Ver pedido'); ?></a></td>
                                  
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


<div class="panel panel-default">
</div>
  
<div class="span6">

 <!-- BEGIN BLANK PAGE PORTLET-->
    <div class="widget green">
        <div class="widget-title">
        <h4><i class="icon-reorder"></i>PEDIDOS AUTORIZADOS POR COMPRAS</h4>
        <span class="tools">
     <!--  <a href="javascript:;" class="icon-chevron-down"></a> -->
        </span>
            </div>
             <div class="widget-body">
                 
              
                    <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                        <thead>
                        <tr>
                        <th>NID</th>
                        <th>SUCURSAL</th>
                        <th>SUPERVISOR</th>
                        <th style="color:#239012;"><CENTER>PEDIDOS</CENTER></th>
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
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->nom_sup?></td>
                                  <?php $suc=$r->suc; ?>                                                             
                                <td><CENTER><?php echo anchor('pedido/ver_pedido_a_com/'.$suc, 'Ver pedido'); ?></a></CENTER></td>
                                 
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