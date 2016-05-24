                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>Id</th>
                                     <th>Receta</th>
                                     <th>Sec</th>
                                     <th>Codigo</th>
                                     <th>Clave</th>
                                     <th>Sustancia Activa</th>
                                     <th>Descripcion</th>
                                     <th>Ped</th>
                                     <th>Sur</th>
                                     
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$tcans=0; $fol=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                $tot=0; $n=0;
                                $clave=$r->clave;
                               
                                
                                $sql="SELECT receta FROM almacen.salidas_ped_det where id_cc=$id_cc and clave='$clave';";
                                $query=$this->db->query($sql);
                                
                                
                                ?> 
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td>
                                        <?php foreach ($query->result() as $row){ ?>
                                         <?php  echo $row->receta . "<br />"?>
                                        <?php } ?> 
                                        </td>
                                        <td style="text-align: right; color: <?php echo $color ?>;"><?php echo $r->sec?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->codigo?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->clave?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->susa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->descri?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->ped?>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->surti?>
                                      </tr>
                                       <?php 
                                        $tcan=$tcan+$r->ped;
                                        $tcans=$tcans+$r->surti;
                                        $timp=$timp+$r->ped*$r->costo;
                                        }
                                        if($tcans>0 and $tcans<$tcan){$porce=100-(($tcans/$tcan)*100);}
                                        elseif($tcan==$tcans){$porce=100;}
                                        elseif($tcans>0 and $tcans>$tcan){$porce=($tcans/$tcan)*100;}
                                        $fol=$r->folio;
                                        ?>
                             </tbody>
                             <tfoot>
                             <tr>
                             <td style="color:blue;" colspan="5">Folio de farmacia <?php echo $fol ?></td>
                             <td style="color:black; text-align: left; "><strong>Total de productos  <?php echo number_format($num,0)?></strong></td>
                             <td><strong>Surtido % <?php echo number_format($porce,2)?></strong></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($tcan)?></strong></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($tcans)?></strong></td>
                                        
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
<script language=\"javascript\" type=\"text/javascript\">

$('input:text[name^=\"cansur_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
    //var pedido = $('#pedido').html();
    

    var id = nombre.split('_');
    id = id[1];
    //alert(id + \" \" + valor);
    actualiza_surtido(id, valor);

});

function actualiza_surtido(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/a_surtido/actualiza_cansur/\", data: ({ id: id, valor: valor }),
            success: function(data){
                
                

        },
        beforeSend: function(data){

        }
        });
}

</script>
 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>