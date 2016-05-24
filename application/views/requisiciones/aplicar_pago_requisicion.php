                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> <?php echo $tit; ?> </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <?php
                         
                         echo form_open('requisiciones/submit_aplicar_pago_requisicion');
                         
                         echo form_hidden('requisicion', $requisicion->requisicion);
                         
                         echo form_label('Anote sus observaciones:');
                         
                         $data = array(
                              'name'        => 'observaciones_pago',
                              'id'          => 'observaciones_pago',
                              'maxlength'   => '100',
                              'size'        => '50',
                            );

                         
                         echo form_textarea($data);
                         
                         echo "<br />";
                         
                         echo form_submit('mysubmit', 'Aceptar');
                         
                         echo form_close();
                         
                         ?>

                         </div>
                     </div>
                 </div>
                         