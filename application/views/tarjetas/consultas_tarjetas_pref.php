       
                 <div class="span6" >
                     <!-- BEGIN SAMPLE FORMPORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body form">
                       
                         
                         
                       
                                                   <?php

    echo form_open('tarjetas/tarjetas_cliente_preferente',  array('class' => 'form-horizontal'));
  ?>
  
  <div class="control-group">
                                <label class="control-label">Inicio:</label>
                                <?php
                                    $perini= array(
                                  'name'        => 'perini',
                                  'id'          => 'perini',
                                  'required'    => 'required'
                                    );
                                     echo form_input($perini);?>
                                     <br />
                                    <label class="control-label">Fin:</label>
                                <?php
                                    $perfin= array(
                                  'name'        => 'perfin',
                                  'id'          => 'perfin',
                                  'required'    => 'required'
                                    );
                                     echo form_input($perfin);?>
                                
  </div>
  
  <div class="form-actions">
                                <button type="submit" class="btn btn-success">Submit</button>
                                
  </div>
 
  
  <?php
	echo form_close();
  ?>

                        
                             
                       
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                 
