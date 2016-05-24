<div class="row-fluid">
<div class="span8">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget yellow">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove" id="tabla1"></a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Orden</th>
                                        <th style="text-align: center;">Proveedor</th>
                                        <th style="text-align: center;">Factura</th>
                                        <th style="text-align: center;">Detalle</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    
                                    <?php
                                    $num=0;
	                                   foreach ($q->result()as $r){
                                        $num=$num+1;
                                        $l1 = anchor('entradas/detalle_en3/'.$r->id, '<i class="icon-folder-open"></i>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado')); 
                                   
                                   ?>
                                    <tr>
                                        <td style="text-align: right;"><?php echo $num?></td>
                                        <td style="text-align: right;"><?php echo $r->orden?></td>
                                        <td style="text-align: left;"><?php echo $r->razon?></td>
                                        <td style="text-align: right;"><?php echo $r->referencia?></td>
                                        <td style="text-align: right;"><?php echo $l1?></td>
                                    </tr>
                                    
                                    <?php
                                    
                                    	}
                                    ?>
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                        
                      
                    </div>
                </div>