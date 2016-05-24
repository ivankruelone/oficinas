<?php
	$row = $query->row();
?>
                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <?php
                         
                         echo '<span id="enunciadoID">'.$enunciadoID.'</span>.- ';
                         
                         echo $row->enunciado . "<br />";

                         $palabras = explode(' ', $row->enunciado);
                         
                         ?>
                         
                         <table class="table">
                             <tbody>
                                 <tr>
                                 
                                 <?php
                                 
                                 $i = 1;
                                 foreach($palabras as $palabra)
                                 {
                                    
                                    
                                    
                                    $data = array(
                                        'name'        => 'palabra_'.$i,
                                        'id'          => 'palabra_'.$i,
                                        'value'       => $palabra,
                                        'checked'     => $this->examen_model->getPalabraExist($enunciadoID, $palabra),
                                        'style'       => 'margin:10px',
                                    );


                                    echo '<td style="text-align: center;">';
                                    echo $palabra;
                                    echo "<br />";
                                    echo form_checkbox($data);
                                    echo "</td>";
                                    
                                    $i++;
                                 }
                                 
                                 
                                 
                                 ?>
                                 </tr>
                             </tbody>
                         </table>

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
