           <div class="span12">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget red">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> <?php echo $tit?></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">

                         
                         <table class="table table-striped" id="tabla1">
                             
                             <thead>
                                 <tr>
                                 <th style="text-align: right">#</th>
                                 <th style="text-align: right">Fecha</th>
                                 <th style="text-align: right">#Certificado</th>
                                 <th style="text-align: right">Total</th>
                                 <th style="text-align: right">rfcEmisor</th>
                                 <th style="text-align: right">nombreEmisor</th>
                                 <th style="text-align: right">Receptor</th>
                                 <th style="text-align: right">Tipo de Gasto</th>
                                 <th style="text-align: right">Detalle</th>
                                 <th style="text-align: right">RfcReceptor</th>
                                 <th style="text-align: right">Validar</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                
                                foreach ($q->result()as $r) {
                                ?> 
                                
                                <?php
                                
                                
                                $num=$num+1;
                                //$l0 = anchor('entradas/gastos_suc/'.$r->suc,$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver los gastos!', 'class' => 'encabezado'));
                                //$l2 = anchor('entradas/descarga_gasto/'.$r->id, '<img src="'.base_url().'img/xml2.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para descargar el archivo!', 'class' => 'encabezado'));   
                                $l1 = anchor('entradas/muestra_detalle/'.$r->suc_id.'/'.$r->id, '<img src="'.base_url().'img/the_documents_icon.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver el o los conceptos!', 'class' => 'encabezado'));
                                //$l3 = anchor('entradas/valida_gasto/'.$r->id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar el Gasto!', 'class' => 'encabezado'));
                                //$l4 = anchor('facturas/elimina_gasto1/'.$r->id, '<img src="'.base_url().'img/close.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para CANCELAR la factura!', 'class' => 'encabezado'));
                                
                                $fa = $this->load->database('facturacion', true);
                                
                                
                                $s= "select g.*, a.cia_id from facturacion.gastos_c g
                                left join facturacion.cia a on g.rfcReceptor=a.rfc
                                where g.id=$r->id";
                                
                                $q1 = $fa->query($s);
                                
                                foreach($q1->result() as $row1)
                                {
                                if($row1->cia_id > 0){
                                    $val_cia_id = '<img src="'.base_url().'img/good.png" border="0" width="20px" />';
                                    $l3 = anchor('entradas/valida_gasto/'.$r->id.'/'.$r->suc_id, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para VALIDAR el Gasto!', 'class' => 'encabezado'));
                                    
                                    
                                }elseif($row1->cia_id == null){
                                    $val_cia_id = '<img src="'.base_url().'img/error.png" border="0" width="20px" />';
                                    $l3 = 'No se puede validar RFC Erroneo';
                                }
                                
                                
                                
                                ?> 
                                    <tr>
                                    <td><?php echo $num?></td>
                                    <td><?php echo $r->fecha?></td>
                                    <td><?php echo $r->n_certificado?></td>
                                    <td>$<?php echo $r->total?></td>
                                    <td><?php echo $r->rfcEmisor?></td>
                                    <td><?php echo $r->nombreEmisor?></td>
                                    <td><?php echo $r->nombreReceptor?></td>
                                    <td><?php echo $r->descri?></td>
                                    <td><?php echo $l1?></td>
                                    <td><?php echo $val_cia_id?></td>
                                    <td><?php echo $l3?></td>
                                 </tr>   
                                 <?php
                                 }
                                 
                                }
                                ?>
                                
                                
                                 
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
              
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget blue">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> <?php echo $tit?></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                            </div>
                            <div class="widget-body">

                         
                         <table class="table table-striped" id="tabla2">
                             
                             <thead>
                                 <tr>
                                 <th style="text-align: center">#</th>
                                 <th style="text-align: center">Sucursal</th>
                                 <th style="text-align: center">Concepto</th>
                                 <th style="text-align: center">Fecha</th>
                                 <th style="text-align: center">Importe</th>
                                 <th style="text-align: center">Validar</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                
                                foreach ($q2->result()as $r1) {
                               
                                $num=$num+1;
                                
                                    $l3 = anchor('entradas/valida_gasto1/'.$r1->id.'/'.$r1->suc, '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para VALIDAR el Gasto!', 'class' => 'encabezado'));
                                
                                ?> 
                                    <tr>
                                    <td style="text-align: right"><?php echo $num?></td>
                                    <td style="text-align: right"><?php echo $r1->suc?></td>
                                    <td style="text-align: left"><?php echo $r1->concepto?></td>
                                    <td style="text-align: center"><?php echo $r1->fecha_gasto?></td>
                                    <td style="text-align: right">$<?php echo $r1->importe?></td>
                                    <td style="text-align: center"><?php echo $l3?></td>
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