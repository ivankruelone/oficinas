       
                 <div class="span6" >
                     <!-- BEGIN SAMPLE FORMPORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         
                       
                                                   <?php

    echo form_open('ventas/ventas_tcp_mes_excel',  array('class' => 'form-horizontal'));
  ?>
  
  <div class="control-group">
                                <label class="control-label"> A&ntilde;o</label>
                                <div class="controls">
                                    
                                      <?php echo form_dropdown('aaa', $aaax, '', 'id="aaa" class="span6 chzn-select" data-placeholder="Choose a Category" tabindex="1" ') ;?>  
                                        
                                </div>
                                
                                <label class="control-label"> Mes</label>
                                <div class="controls">
                                    
                                      <?php echo form_dropdown('mes', $mesx, '', 'id="mes" class="span6 chzn-select" data-placeholder="Choose a Category" tabindex="1" ') ;?>  
                                        
                                </div>
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
 