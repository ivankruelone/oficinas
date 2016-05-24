                <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-edit"></i> <?php echo $titulo; ?> </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body form">
                             <?php
                             
                             echo form_open('ventas/fecha1_submit', array('class' => 'form-horizontal'));
                             
                             $fecha1 = array(
                                  'name'        => 'fecha_venta1',
                                  'id'          => 'fecha_venta1',
                                  'required'    => 'required'
                                );
                             
                             $fecha2 = array(
                                  'name'        => 'fecha_venta2',
                                  'id'          => 'fecha_venta2',
                                  'required'    => 'required'
                                );

                             ?>
                             <div class="control-group">
                                
                                <label class="control-label">Elige una fecha inicial: </label>
                                <div class="controls">
                                    <?php echo form_input($fecha1);?>
                                </div>
                                
                             </div>
                             
                             <div class="control-group">
                                
                                <label class="control-label">Elige una fecha final: </label>
                                <div class="controls">
                                    <?php echo form_input($fecha2);?>
                                </div>
                                
                             </div>
                             
                             <div class="control-group">

                                <label class="control-label">Elige una sucursal</label>
                                <div class="controls">
                                    <?php echo form_dropdown('suc', $suc, 105, 'class="span6 chzn-select" data-placeholder="Escoge una sucursal" tabindex="1"');?>
                                </div>
                             
                             </div>
                             
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Aceptar</button>
                            </div>                             
                             <?php
                             echo form_close();
                             
                             ?>
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>