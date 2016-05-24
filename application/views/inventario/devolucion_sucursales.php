                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <?php echo form_open('inventario/buscaClavesDevolucion', array('class' => 'form-horizontal', 'id' => 'forma'));?>
                         
                                <div class="control-group">
                                    <label class="control-label">Secuencia</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'sec', 'name' => 'sec', 'type' => 'number', 'class' => 'input-medium', 'required' => 'requiered')); ?>
                                        <span class="help-inline">Que secuencia buscas, esta busqueda la hace en la compra de CEDIS.</span>
                                    </div>
                                </div>

                                <div class="control-group">
                         
                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Busca</button>
                                </div>
                                
                         
                         <?php echo form_close(); ?>
                         
                         
                         <div id="busqueda">
                         
                         </div>






                         </div>
                     </div>
                 </div>

                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Lotes Permitidos para devolucion en sucursal</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="permitidos">
                         
                         </div>
                         
                     </div>

            </div>