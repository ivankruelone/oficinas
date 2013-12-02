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
                                     <th>Sec</th>
                                     <th>Codigo</th>
                                     <th>Clave</th>
                                     <th>Sustancia Activa</th>
                                     <th>Descripcion</th>
                                     <th>Cantidad</th>
                                     
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                $tot=0; $n=0; 
                                ?> 
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>;"><?php echo $r->sec?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->codigo?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->clave?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->susa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->descri?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->ped?>
                                      </tr>
                                       <?php 
                                        $tcan=$tcan+$r->ped;
                                        $timp=$timp+$r->ped*$r->costo;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4"></td>
                             <td style="color:black; text-align: left; "><strong>Total de productos  <?php echo number_format($num,0)?></strong></td>
                             <td></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($tcan)?></strong></td>
                                        
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