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
                         
                         
                         foreach($query->result() as $row){
                         
                         ?>
                         
                         <p>
                            <h2 style="text-align: center;"><?php echo $row->examenID; ?> - <?php echo $row->examen; ?></h2>
                         </p>
                         
                         <?php
                         
                         
                         switch ($row->tipoID) {
                            case 1:
                                
                                
                                $query2 = $this->examen_model->getReactivoByExamenID($row->examenID);
                                
                                
                                foreach($query2->result() as $row2)
                                {
                                    echo '<p>'.$row2->reactivo;
                                    
                                    $query3 = $this->examen_model->getOpcionByReactivoID($row2->reactivoID);
                                    
                                    $opcionID = $this->examen_model->getOpcionByIDByReacivoID($id, $row2->reactivoID);
                                    
                                    foreach($query3->result() as $row3)
                                    {
                                        if($row3->correcta == 1)
                                        {
                                            $color = 'red';
                                        }else{
                                            $color = '';
                                        }
                                        
                                        if($opcionID == $row3->opcionID)
                                        {
                                            $resp = '( X ) ';
                                        }else{
                                            $resp = '( ) ';
                                        }
                                        
                                        echo '<div style="display: inline-block; width: 250px; color: '.$color.'">'.$resp.$row3->opcion.'</div>';
                                    }
                                    
                                    echo '</p>';
                                    echo '<br />';
                                    echo '<br />';
                                }
                                
                                
                                break;
                            case 2:
                                echo "i es igual a 1";
                                break;
                            case 3:
                                echo "i es igual a 2";
                                break;
                            case 4:
                                echo "i es igual a 2";
                                break;
                        }
                         
                         
                         
                         }
                         
                         ?>
                         
                         
                         </div>
                     </div>
                 </div>