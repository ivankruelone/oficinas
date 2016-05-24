<div class="panel panel-default">
</div>
  
<div class="span10">

 <!-- BEGIN BLANK PAGE PORTLET-->
    <div class="widget green">
        <div class="widget-title">
        <h4><i class="icon-reorder"></i>SOLICITUD DE PEDIDOS AUTORIZADOS</h4>
        <span class="tools">
      <a href="javascript:;" class="icon-chevron-down"></a> 
        </span>
            </div>
             <div class="widget-body">
                 
              
                    <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                        <thead>
                        <tr>
                        <th>FECHA</th>
                        <th>SUCURSAL</th>
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th>PIEZAS</th>
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
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->fecha?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->suc?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->cod?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->descri?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->piezas?></td>
                                                                             
                                </tr>
                                <?php
                                }
                                ?>

                     </tbody>


                    </table>
                    <center>