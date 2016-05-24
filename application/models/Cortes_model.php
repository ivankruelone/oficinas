<?php
class Cortes_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->library('unzip');
    }
 function inserta_archivos($archivo, $size, $string)
    {
        
        
        $validacion = explode('.', $archivo);
        $this->load->library('unzip');
        $this->load->helper('directory');
        $this->load->helper('file');

        $data = array(
                'suc' => $this->session->userdata('suc'),
                'archivo' => $archivo,
                'fecha' => date('Y-m-d H:s:i'),
                'size' => $size
                );
                
        $this->db->insert('desarrollo.cortes_archivo', $data);
        $id = $this->db->insert_id();
        
        if($id > 0)
        {

            if(!is_dir('../cortes/'.$validacion[0].'/'))
            {
                mkdir('../cortes/'.$validacion[0].'/');
            }
            
            $this->unzip->extract('../cortes/'.$archivo, '../cortes/'.$validacion[0].'/');
            $map = directory_map('../cortes/'.$validacion[0].'/');
            $string = null;
            foreach($map as $row){
                
                
                    $string = file('../cortes/'.$validacion[0].'/'.$row, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $linea = array_map('rtrim', $string);
                    $id_cc=0;
                    $turno1_pesos=0;  
                    $turno1_dolar=0;  
                    $turno1_cambio=0;
                    $turno1_ta60=0;
                    $turno1_ta61=0;
                    $turno1_ta62=0;
                    $turno1_ta63=0;
                    $turno1_ta64=0;
                    $turno1_ta65=0;
                    $turno1_ta66=0;
                    $turno1_v70=0;
                    $turno1_v71=0;
                    $turno1_v72=0;
                    $turno1_v73=0;
                    $turno1_v74=0;
                    $turno1_v75=0;
                    $turno1_v76=0;
                    $turno1_mn=0;
                    $turno1_asalto=0;
                    $turno1_cajera=0;
                    $turno1_folio1=0;
                    $turno1_folio2=0;
                    $turno1_corte=0;
                    $turno1_sobrante=0;
                    $turno1_faltante=0;
                    
                    $turno2_pesos=0;  
                    $turno2_dolar=0;  
                    $turno2_cambio=0;
                    $turno2_ta60=0;
                    $turno2_ta61=0;
                    $turno2_ta62=0;
                    $turno2_ta63=0;
                    $turno2_ta64=0;
                    $turno2_ta65=0;
                    $turno2_ta66=0;
                    $turno2_v70=0;
                    $turno2_v71=0;
                    $turno2_v72=0;
                    $turno2_v73=0;
                    $turno2_v74=0;
                    $turno2_v75=0;
                    $turno2_v76=0;
                    $turno2_mn=0;
                    $turno2_asalto=0;
                    $turno2_cajera=0;
                    $turno2_folio1=0;
                    $turno2_folio2=0;
                    $turno2_corte=0;
                    $turno2_sobrante=0;
                    $turno2_faltante=0;
                    
                    $turno3_pesos=0;  
                    $turno3_dolar=0;  
                    $turno3_cambio=0;
                    $turno3_ta60=0;
                    $turno3_ta61=0;
                    $turno3_ta62=0;
                    $turno3_ta63=0;
                    $turno3_ta64=0;
                    $turno3_ta65=0;
                    $turno3_ta66=0;
                    $turno3_v70=0;
                    $turno3_v71=0;
                    $turno3_v72=0;
                    $turno3_v73=0;
                    $turno3_v74=0;
                    $turno3_v75=0;
                    $turno3_v76=0;
                    $turno3_mn=0;
                    $turno3_asalto=0;
                    $turno3_cajera=0;
                    $turno3_folio1=0;
                    $turno3_folio2=0;
                    $turno3_corte=0;
                    $turno3_sobrante=0;
                    $turno3_faltante=0;
                    $venta1=0;
                    $venta2=0;
                    $venta3=0;
                    $venta4=0;
                    $venta5=0;
                    $venta6=0;
                    $venta7=0;
                    $venta8=0;
                    $venta9=0;
                    $venta10=0;
                    $venta11=0;
                    $venta12=0;
                    $venta13=0;
                    $venta14=0;
                    $venta15=0;
                    $venta16=0;
                    $venta17=0;
                    $venta18=0;
                    $venta19=0;
                    $venta20=0;
                    $venta21=0;
                    $venta22=0;
                    $venta23=0;
                    $venta24=0;
                    $venta25=0;
                    $venta26=0;
                    $venta28=0;
                    $venta29=0;
                    $venta30=0;
                    $venta32=0;
                    $venta40=0;
                    $venta49=0;
                    $cance1=0;
                    $clave1=0;
                    $cance2=0;
                    $clave2=0;
                    $cance3=0;
                    $clave3=0;
                    $cance4=0;
                    $clave4=0;
                    $cance5=0;
                    $clave5=0;
                    $cance6=0;
                    $clave6=0;
                    $cance7=0;
                    $clave7=0;
                    $cance8=0;
                    $clave8=0;
                    $cance9=0;
                    $clave9=0;
                    $cance10=0;
                    $clave10=0;
                    $cance11=0;
                    $clave11=0;
                    $cance12=0;
                    $clave12=0;
                    $cance13=0;
                    $clave13=0;
                    $cance14=0;
                    $clave14=0;
                    $cance15=0;
                    $clave15=0;
                    $cance16=0;
                    $clave16=0;
                    $cance17=0;
                    $clave17=0;
                    $cance18=0;
                    $clave18=0;
                    $cance19=0;
                    $clave19=0;
                    $cance20=0;
                    $clave20=0;
                    $cance21=0;
                    $clave21=0;
                    $cance22=0;
                    $clave22=0;
                    $cance23=0;
                    $clave23=0;
                    $cance24=0;
                    $clave24=0;
                    $cance25=0;
                    $clave25=0;
                    $cance26=0;
                    $clave26=0;
                    $cance28=0;
                    $clave28=0;
                    $cance29=0;
                    $clave29=0;
                    $cance30=0;
                    $clave30=0;
                    $cance32=0;
                    $clave32=0;
                    $cance40=0;
                    $clave40=0;
                    $cance48=0;
                    $clave48=0;
                    $cance49=0;
                    $clave49=0;
                    //$linea = explode('\r\n', $string);
                    $cl= null;
                    $turnox= null;
                    $ver= null;
                    $tsuc= null;
                    $b = null;
                    $x = null;
                    $xx = null;
                    $suc = null;
                    $dia = null;
                    $mes = null;
                    $aaa = null;
                    $turno = null;
                    $turno1_folio1 = null;
                    $turno1_folio2 = null;
                    $turno1_cajera = null;
                    $cia = null;
                    $plaza = null;
                    $succ = null;
                    $id_user = null;
                    $fechac = null;
                    foreach($linea as $lin)
                    {
                        $b= $lin."<br />";
                         
                        $x=substr($lin,0,2);
                        $xx=substr($lin,3,1);
                        $clave=substr($lin,4,2);
                        
                         
                        if($x=='SU'){$suc=substr($lin,3,4);
                        $sql = "SELECT  * FROM  catalogo.sucursal where suc=?";
                        $query = $this->db->query($sql,array($suc));
                        $row= $query->row();
                        $cia=$row->cia;
                        $plaza=$row->plaza;
                        $succ=$row->suc_contable;
                        $id_user_cor=$row->gere;
                        $id_user=$row->user_id;
                        $tsuc=$row->tipo2;
                        $iva=$row->iva+1;
                        $id_plaza=$row->id_plaza;
                        
                       
                        }
                        if($x=='FE'){$dia=substr($lin,3,2);$mes=substr($lin,5,2);$aaa=substr($lin,7,2)+2000; $fechac=$aaa."-".$mes."-".$dia;}
                        if($x=='CA'){$turno=substr($lin,4,1);}
                        if($x=='CA'){$turnox=substr($lin,3,2);}
                       
                        
                        if($x=='RI' && $turno==0 || $x=='RI' && $turnox==01 || $x=='RI' && $turnox==92){$turno1_folio1=substr($lin,3,12);}
                        if($x=='RF' && $turno==0 || $x=='RF' && $turnox==01 || $x=='RF' && $turnox==92){$turno1_folio2=substr($lin,3,12);}
                        if($x=='CL' && $turno==0 || $x=='CL' && $turnox==01 || $x=='CL' && $turnox==92){$cl=substr($lin,3,1);}
                        if($x=='EM' && $turno==0 || $x=='EM' && $turnox==01 || $x=='EM' && $turnox==92){$turno1_cajera=substr($lin,3,7);}
                        
                        if($x=='CL' && $turno==0 && $clave==1 || $x=='CL' && $turnox==01 && $clave==1 || $x=='CL' && $turnox==92 && $clave==1){
                            if($cl==1){$venta1=substr($lin,9,8);$clave1=$clave;}
                            if($cl==2){$cance1=substr($lin,9,8);$clave1=$clave;}
                         }
                        if($x=='CL' && $turno==0 && $clave==2 || $x=='CL' && $turnox==01 && $clave==2 || $x=='CL' && $turnox==92 && $clave==2){
                            if($cl==1){$venta2=substr($lin,9,8);$clave2=$clave;}
                            if($cl==2){$cance2=substr($lin,9,8);$clave2=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==3 || $x=='CL' && $turnox==01 && $clave==3 || $x=='CL' && $turnox==92 && $clave==3){
                            if($cl==1){$venta3=substr($lin,9,8);$clave3=$clave;}
                            if($cl==2){$cance3=substr($lin,9,8);$clave3=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==4 || $x=='CL' && $turnox==01 && $clave==4 || $x=='CL' && $turnox==92 && $clave==4){
                            if($cl==1){$venta4=substr($lin,9,8);$clave4=$clave;}
                            if($cl==2){$cance4=substr($lin,9,8);$clave4=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==5 || $x=='CL' && $turnox==01 && $clave==5 || $x=='CL' && $turnox==92 && $clave==5){
                            if($cl==1){$venta5=substr($lin,9,8);$clave5=$clave;}
                            if($cl==2){$cance5=substr($lin,9,8);$clave5=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==6 || $x=='CL' && $turnox==01 && $clave==6 || $x=='CL' && $turnox==92 && $clave==6){
                            if($cl==1){$venta6=substr($lin,9,8);$clave6=$clave;}
                            if($cl==2){$cance6=substr($lin,9,8);$clave6=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==7 || $x=='CL' && $turnox==01 && $clave==7 || $x=='CL' && $turnox==92 && $clave==7){
                            if($cl==1){$venta7=substr($lin,9,8);$clave7=$clave;}
                            if($cl==2){$cance7=substr($lin,9,8);$clave7=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==8 || $x=='CL' && $turnox==01 && $clave==8 || $x=='CL' && $turnox==92 && $clave==8){
                            if($cl==1){$venta8=substr($lin,9,8);$clave8=$clave;}
                            if($cl==2){$cance8=substr($lin,9,8);$clave8=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==9 || $x=='CL' && $turnox==01 && $clave==9 || $x=='CL' && $turnox==92 && $clave==9){
                            if($cl==1){$venta9=substr($lin,9,8);$clave9=$clave;}
                            if($cl==2){$cance9=substr($lin,9,8);$clave9=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==10 || $x=='CL' && $turnox==01 && $clave==10 || $x=='CL' && $turnox==92 && $clave==10){
                            if($cl==1){$venta10=substr($lin,9,8);$clave10=$clave;}
                            if($cl==2){$cance10=substr($lin,9,8);$clave10=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==11 || $x=='CL' && $turnox==01 && $clave==11 || $x=='CL' && $turnox==92 && $clave==11){
                            if($cl==1){$venta11=substr($lin,9,8);$clave11=$clave;}
                            if($cl==2){$cance11=substr($lin,9,8);$clave11=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==12 || $x=='CL' && $turnox==01 && $clave==12 || $x=='CL' && $turnox==92 && $clave==12){
                            if($cl==1){$venta12=substr($lin,9,8);$clave12=$clave;}
                            if($cl==2){$cance12=substr($lin,9,8);$clave12=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==13 || $x=='CL' && $turnox==01 && $clave==13 || $x=='CL' && $turnox==92 && $clave==13){
                            if($cl==1){$venta13=substr($lin,9,8);$clave13=$clave;}
                            if($cl==2){$cance13=substr($lin,9,8);$clave13=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==14 || $x=='CL' && $turnox==01 && $clave==14 || $x=='CL' && $turnox==92 && $clave==14){
                            if($cl==1){$venta14=substr($lin,9,8);$clave14=$clave;}
                            if($cl==2){$cance14=substr($lin,9,8);$clave14=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==15 || $x=='CL' && $turnox==01 && $clave==15 || $x=='CL' && $turnox==92 && $clave==15){
                            if($cl==1){$venta15=substr($lin,9,8);$clave15=$clave;}
                            if($cl==2){$cance15=substr($lin,9,8);$clave15=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==16 || $x=='CL' && $turnox==01 && $clave==16 || $x=='CL' && $turnox==92 && $clave==16){
                            if($cl==1){$venta16=substr($lin,9,8);$clave16=$clave;}
                            if($cl==2){$cance16=substr($lin,9,8);$clave16=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==17 || $x=='CL' && $turnox==01 && $clave==17 || $x=='CL' && $turnox==92 && $clave==17){
                            if($cl==1){$venta17=substr($lin,9,8);$clave17=$clave;}
                            if($cl==2){$cance17=substr($lin,9,8);$clave17=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==18 || $x=='CL' && $turnox==01 && $clave==18 || $x=='CL' && $turnox==92 && $clave==18){
                            if($cl==1){$venta18=substr($lin,9,8);$clave18=$clave;}
                            if($cl==2){$cance18=substr($lin,9,8);$clave18=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==19 || $x=='CL' && $turnox==01 && $clave==19 || $x=='CL' && $turnox==92 && $clave==19){
                            if($cl==1){$venta19=substr($lin,9,8);$clave19=$clave;}
                            if($cl==2){$cance19=substr($lin,9,8);$clave19=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==20 || $x=='CL' && $turnox==01 && $clave==20 || $x=='CL' && $turnox==92 && $clave==20){
                            if($cl==1){$venta20=substr($lin,9,8);$clave20=$clave;}
                            if($cl==2){$cance20=substr($lin,9,8);$clave20=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==21 || $x=='CL' && $turnox==01 && $clave==21 || $x=='CL' && $turnox==92 && $clave==21){
                            if($cl==1){$venta21=substr($lin,9,8);$clave21=$clave;}
                            if($cl==2){$cance21=substr($lin,9,8);$clave21=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==22 || $x=='CL' && $turnox==01 && $clave==22 || $x=='CL' && $turnox==92 && $clave==22){
                            if($cl==1){$venta22=substr($lin,9,8);$clave22=$clave;}
                            if($cl==2){$cance22=substr($lin,9,8);$clave22=$clave;}
                             }
                        
                        if($x=='CL' && $turno==0 && $clave==23 || $x=='CL' && $turnox==01 && $clave==23 || $x=='CL' && $turnox==92 && $clave==23){
                            if($cl==1){$venta23=substr($lin,9,8);$clave23=$clave;}
                            if($cl==2){$cance23=substr($lin,9,8);$clave23=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==24 || $x=='CL' && $turnox==01 && $clave==24 || $x=='CL' && $turnox==92 && $clave==24){
                            if($cl==1){$venta24=substr($lin,9,8);$clave24=$clave;}
                            if($cl==2){$cance24=substr($lin,9,8);$clave24=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==25 || $x=='CL' && $turnox==01 && $clave==25 || $x=='CL' && $turnox==92 && $clave==25){
                            if($cl==1){$venta25=substr($lin,9,8);$clave25=$clave;}
                            if($cl==2){$cance25=substr($lin,9,8);$clave25=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==26 || $x=='CL' && $turnox==01 && $clave==26 || $x=='CL' && $turnox==92 && $clave==26){
                            if($cl==1){$venta26=substr($lin,9,8);$clave26=$clave;}
                            if($cl==2){$cance26=substr($lin,9,8);$clave26=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==28 || $x=='CL' && $turnox==01 && $clave==28 || $x=='CL' && $turnox==92 && $clave==28){
                            if($cl==1){$venta28=substr($lin,9,8);$clave28=$clave;}
                            if($cl==2){$cance28=substr($lin,9,8);$clave28=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==29 || $x=='CL' && $turnox==01 && $clave==29 || $x=='CL' && $turnox==92 && $clave==29){
                            if($cl==1){$venta29=substr($lin,9,8);$clave29=$clave;}
                            if($cl==2){$cance29=substr($lin,9,8);$clave29=$clave;}
                             }
                             
                        if($x=='CL' && $turno==0 && $clave==30 || $x=='CL' && $turnox==01 && $clave==30 || $x=='CL' && $turnox==92 && $clave==30){
                            if($cl==1){$venta30=substr($lin,9,8);$clave30=$clave;}
                            if($cl==2){$cance30=substr($lin,9,8);$clave30=$clave;}
                             }
                             
                        if($x=='CL' && $turno==0 && $clave==32 || $x=='CL' && $turnox==01 && $clave==32 || $x=='CL' && $turnox==92 && $clave==32){
                            if($cl==1){$venta32=substr($lin,9,8);$clave32=$clave;}
                            if($cl==2){$cance32=substr($lin,9,8);$clave32=$clave;}
                             }
                        if($x=='CL' && $turno==0 && $clave==40 || $x=='CL' && $turnox==01 && $clave==40 || $x=='CL' && $turnox==92 && $clave==40){
                            if($cl==1){$venta40=substr($lin,9,8);$clave40=$clave;}
                            if($cl==2){$cance40=substr($lin,9,8);$clave40=$clave;}
                             }
                             
                        if($x=='CL' && $turno==0 && $clave==48 || $x=='CL' && $turnox==01 && $clave==48 || $x=='CL' && $turnox==92 && $clave==48){
                            if($cl==1){$venta48=substr($lin,9,8);$clave48=$clave;}
                            if($cl==2){$cance48=substr($lin,9,8);$clave48=$clave;}
                             }
                         
                       if($x=='CL' && $turno==0 && $clave==49 || $x=='CL' && $turnox==01 && $clave==49 || $x=='CL' && $turnox==92 && $clave==49){
                            if($cl==1){$venta49=substr($lin,9,8);$clave49=$clave;}
                            if($cl==2){$cance49=substr($lin,9,8);$clave49=$clave;}
                             }      
                        
                        if($x=='CL' && $turno==1 && $clave==50 || $x=='CL' && $turnox==11 && $clave==50 || $x=='CL' && $turnox==21 && $clave==50){$turno1_pesos=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==60 || $x=='CL' && $turnox==11 && $clave==60 || $x=='CL' && $turnox==21 && $clave==60){$turno1_ta60=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==61 || $x=='CL' && $turnox==11 && $clave==61 || $x=='CL' && $turnox==21 && $clave==61){$turno1_ta61=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==62 || $x=='CL' && $turnox==11 && $clave==62 || $x=='CL' && $turnox==21 && $clave==62){$turno1_ta62=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==63 || $x=='CL' && $turnox==11 && $clave==63 || $x=='CL' && $turnox==21 && $clave==63){$turno1_ta63=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==64 || $x=='CL' && $turnox==11 && $clave==64 || $x=='CL' && $turnox==21 && $clave==64){$turno1_ta64=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==65 || $x=='CL' && $turnox==11 && $clave==65 || $x=='CL' && $turnox==21 && $clave==65){$turno1_ta65=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==66 || $x=='CL' && $turnox==11 && $clave==66 || $x=='CL' && $turnox==21 && $clave==66){$turno1_ta66=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==70 || $x=='CL' && $turnox==11 && $clave==70 || $x=='CL' && $turnox==21 && $clave==70){$turno1_v70=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==71 || $x=='CL' && $turnox==11 && $clave==71 || $x=='CL' && $turnox==21 && $clave==71){$turno1_v71=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==72 || $x=='CL' && $turnox==11 && $clave==72 || $x=='CL' && $turnox==21 && $clave==72){$turno1_v72=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==73 || $x=='CL' && $turnox==11 && $clave==73 || $x=='CL' && $turnox==21 && $clave==73){$turno1_v73=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==74 || $x=='CL' && $turnox==11 && $clave==74 || $x=='CL' && $turnox==21 && $clave==74){$turno1_v74=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==75 || $x=='CL' && $turnox==11 && $clave==75 || $x=='CL' && $turnox==21 && $clave==75){$turno1_v75=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==76 || $x=='CL' && $turnox==11 && $clave==76 || $x=='CL' && $turnox==21 && $clave==76){$turno1_v76=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==80 || $x=='CL' && $turnox==11 && $clave==80 || $x=='CL' && $turnox==21 && $clave==80){$turno1_dolar=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==81 || $x=='CL' && $turnox==11 && $clave==81 || $x=='CL' && $turnox==21 && $clave==81){$turno1_cambio=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==82 || $x=='CL' && $turnox==11 && $clave==82 || $x=='CL' && $turnox==21 && $clave==82){$turno1_mn=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==91 || $x=='CL' && $turnox==11 && $clave==91 || $x=='CL' && $turnox==21 && $clave==91){$turno1_corte=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==92 || $x=='CL' && $turnox==11 && $clave==92 || $x=='CL' && $turnox==21 && $clave==92){$turno1_sobrante=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==93 || $x=='CL' && $turnox==11 && $clave==93 || $x=='CL' && $turnox==21 && $clave==93){$turno1_faltante=substr($lin,9,8);}
                        if($x=='CL' && $turno==1 && $clave==94 || $x=='CL' && $turnox==11 && $clave==94 || $x=='CL' && $turnox==21 && $clave==94){$turno1_asalto=substr($lin,9,8);}
                        
                        if($x=='CL' && $turno==2 && $clave==50){$turno2_pesos=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==60){$turno2_ta60=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==61){$turno2_ta61=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==62){$turno2_ta62=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==63){$turno2_ta63=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==64){$turno2_ta64=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==65){$turno2_ta65=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==66){$turno2_ta66=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==70){$turno2_v70=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==71){$turno2_v71=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==72){$turno2_v72=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==73){$turno2_v73=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==74){$turno2_v74=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==75){$turno2_v75=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==76){$turno2_v76=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==80){$turno2_dolar=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==81){$turno2_cambio=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==82){$turno2_mn=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==91){$turno2_corte=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==92){$turno2_sobrante=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==93){$turno2_faltante=substr($lin,9,8);}
                        if($x=='CL' && $turno==2 && $clave==94){$turno2_asalto=substr($lin,9,8);}
                        //if($x=='CL' && $turno==2 && $clave==48){$cance48=substr($lin,9,8);}
                        
                        if($x=='RI' && $turno==2){$turno2_folio1=substr($lin,3,12);}
                        if($x=='RF' && $turno==2){$turno2_folio2=substr($lin,3,12);}
                        if($x=='EM' && $turno==2){$turno2_cajera=substr($lin,3,7);}

                        if($x=='CL' && $turno==3 && $clave==50){$turno3_pesos=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==60){$turno3_ta60=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==61){$turno3_ta61=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==62){$turno3_ta62=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==63){$turno3_ta63=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==64){$turno3_ta64=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==65){$turno3_ta65=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==66){$turno3_ta66=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==70){$turno3_v70=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==71){$turno3_v71=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==72){$turno3_v72=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==73){$turno3_v73=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==74){$turno3_v74=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==75){$turno3_v75=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==76){$turno3_v76=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==80){$turno3_dolar=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==81){$turno3_cambio=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==82){$turno3_mn=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==91){$turno3_corte=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==92){$turno3_sobrante=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==93){$turno3_faltante=substr($lin,9,8);}
                        if($x=='CL' && $turno==3 && $clave==94){$turno3_asalto=substr($lin,9,8);}
                        
                        if($x=='RI' && $turno==3){$turno3_folio1=substr($lin,3,12);}
                        if($x=='RF' && $turno==3){$turno3_folio2=substr($lin,3,12);}
                        if($x=='EM' && $turno==3){$turno3_cajera=substr($lin,3,7);}

                        
////////////////////graba concentrado////////////////////////////////////////////////////////
$caja=1;
// echo $fechac;
$sqlz = "SELECT * FROM desarrollo.cortes_c where suc=? and fechacorte =?";
                        $queryz = $this->db->query($sqlz,array($suc,$fechac));
/////////////////////////////////////////**********+++++++++++++++++++++++++++++++++++++++++++++++++
/////////////////////////////////////////**********+++++++++++++++++++++++++++++++++++++++++++++++++
$recarga=0;
if($x=='TM' &&  $queryz->num_rows()== 0){
                                
                                $new_member_insert_data = array(
        	                    'fechacorte' => $fechac,
                                'suc' => $suc,
                                'tipo' => 2,
                                'id_user' => $id_user,
                                'id_cor' => $id_user_cor,
                                'caja'=>$caja,
                                'cia'=>$cia,
                                'plaza'=>$plaza,
                                'succ'=>$succ,
                                'recarga'=>$recarga,
                                'vta_tot'=>$venta48-$cance48,
 		    'turno1_pesos'   =>$turno1_pesos,  
            'turno1_dolar'   =>$turno1_dolar,  
            'turno1_cambio'  =>$turno1_cambio,
            'turno1_bbv'     =>$turno1_ta64+$turno1_ta65,
            'turno1_exp'     =>$turno1_ta62+$turno1_ta63,
            'turno1_san'     =>$turno1_ta66+$turno1_ta60+$turno1_ta61,
            'turno1_vale'    =>$turno1_v70+$turno1_v71+$turno1_v72+$turno1_v73+$turno1_v74+$turno1_v75+$turno1_v76,
            'turno1_cajera'  =>$turno1_cajera,
            'turno1_folio1'  =>$turno1_folio1,
            'turno1_folio2'  =>$turno1_folio2,
            'turno1_corte'   =>$turno1_corte,
            'turno1_sob'     =>$turno1_sobrante,
            'turno1_fal'     =>$turno1_faltante,
            'turno1_asalto'  =>$turno1_asalto,
            
            'turno2_pesos'   =>$turno2_pesos,
            'turno2_dolar'   =>$turno2_dolar,
            'turno2_cambio'  =>$turno2_cambio,
            'turno2_bbv'     =>$turno2_ta64+$turno2_ta65,
            'turno2_exp'     =>$turno2_ta62+$turno2_ta63,
            'turno2_san'     =>$turno2_ta66+$turno2_ta60+$turno2_ta61,
            'turno2_vale'    =>$turno2_v70+$turno2_v71+$turno2_v72+$turno2_v73+$turno2_v74+$turno2_v75+$turno2_v76,
            'turno2_cajera'  =>$turno2_cajera,
            'turno2_folio1'  =>$turno2_folio1,
            'turno2_folio2'  =>$turno2_folio2,
            'turno2_corte'   =>$turno2_corte,
            'turno2_sob'     =>$turno2_sobrante,
            'turno2_fal'     =>$turno2_faltante,
            'turno2_asalto'  =>$turno2_asalto,
            
            'turno3_pesos'   =>$turno3_pesos,
            'turno3_dolar'   =>$turno3_dolar,
            'turno3_cambio'  =>$turno3_cambio,
            'turno3_bbv'     =>$turno3_ta64+$turno3_ta65,
            'turno3_exp'     =>$turno3_ta62+$turno3_ta63,
            'turno3_san'     =>$turno3_ta66+$turno3_ta60+$turno3_ta61,
            'turno3_vale'    =>$turno3_v70+$turno3_v71+$turno3_v72+$turno3_v73+$turno3_v74+$turno3_v75+$turno3_v76,
            'turno3_cajera'  =>$turno3_cajera,
            'turno3_folio1'  =>$turno3_folio1,
            'turno3_folio2'  =>$turno3_folio2,
            'turno3_corte'   =>$turno3_corte,
            'turno3_sob'     =>$turno3_sobrante,
            'turno3_fal'     =>$turno3_faltante,
            'turno3_asalto'  =>$turno3_asalto,
            'id_plaza'      =>$id_plaza, 
            'tsuc'     =>$tsuc
                                  
                                  
                                  );
		            $insert = $this->db->insert('desarrollo.cortes_c', $new_member_insert_data);
                    $id_cc= $this->db->insert_id();

///////////////////////////////////////////////////////////////////////////////////                    
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////fenix
                  if($venta1>0 || $venta25>0 || $venta28>0 || $venta29>0 ){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave1,
                            'venta'=>$venta1+$venta25+$venta28+$venta29,
                            'cancel'=>$cance1+$cance25+$cance28+$cance29,
                            'corregido' =>$venta1+$venta25+$venta28+$venta29-$cance1-$cance25-$cance28-$cance29,
                            'siniva' =>$venta1+$venta25+$venta28+$venta29-$cance1-$cance25-$cance28-$cance29,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                            
                    if($venta2>0  || $venta3>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave2,
                            'venta'=>$venta2+$venta3,
                            'cancel'=>$cance2+$cance3,
                            'corregido' =>$venta2+$venta3-$cance2-$cance3,
                            'siniva' =>($venta2+$venta3-$cance2-$cance3)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    
                    if($venta4>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave4,
                            'venta'=>$venta4,
                            'cancel'=>$cance4,
                            'corregido'=>$venta4-$cance4,
                            'siniva'=>$venta4-$cance4,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta5>0 || $venta6>0 || $venta17>0 || $venta18>0 || $venta26>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave5,
                            'venta'=>$venta5+$venta6+$venta17+$venta18+$venta26,
                            'cancel'=>$cance5+$cance6+$cance17+$cance18+$cance26,
                            'corregido'=>$venta5+$venta6+$venta17+$venta18+$venta26-$cance5-$cance6-$cance17-$cance18-$cance26,
                            'siniva'=>($venta5+$venta6+$venta17+$venta18+$venta26-$cance5-$cance6-$cance17-$cance18-$cance26)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                      if($venta7>0 || $venta8>0){
                            
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>8,
                            'venta'=>$venta8+$venta7,
                            'cancel'=>$cance8+$cance7,
                            'corregido'=>$venta8+$venta7-$cance8-$cance7,
                            'siniva'=>$venta8+$venta7-$cance8-$cance7,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta9>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave9,
                            'venta'=>$venta9,
                            'cancel'=>$cance9,
                            'corregido'=>$venta9-$cance9,
                            'siniva'=>($venta9-$cance9)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta10>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave10,
                            'venta'=>$venta10,
                            'cancel'=>$cance10,
                            'corregido'=>$venta10-$cance10,
                            'siniva'=>$venta10-$cance10,
                            'lin_g'=>3,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta11>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave11,
                            'venta'=>$venta11,
                            'cancel'=>$cance11,
                            'corregido'=>$venta11-$cance11,
                            'siniva'=>($venta11-$cance11)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta12>0 || $venta14>0 || $venta15>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave12,
                            'venta'=>$venta12+$venta14+$venta15,
                            'cancel'=>$cance12+$cance14+$cance15,
                            'corregido'=>$venta12+$venta14+$venta15-$cance12-$cance14-$cance15,
                            'siniva'=>$venta12+$venta14+$venta15-$cance12-$cance14-$cance15,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta13>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave13,
                            'venta'=>$venta13,
                            'cancel'=>$cance13,
                            'corregido'=>$venta13-$cance13,
                            'siniva'=>$venta13-$cance13,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta16>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave16,
                            'venta'=>$venta16,
                            'cancel'=>$cance16,
                            'corregido'=>$venta16-$cance16,
                            'siniva'=>$venta16-$cance16,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta19>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave19,
                            'venta'=>$venta19,
                            'cancel'=>$cance19,
                            'corregido'=>$venta19-$cance19,
                            'siniva'=>($venta19-$cance19)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }

                    if($venta20>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave20,
                            'venta'=>$venta20,
                            'cancel'=>$cance20,
                            'corregido'=>$venta20-$cance20,
                            'siniva'=>($venta20-$cance20)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    
                    if($venta21>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave21,
                            'venta'=>$venta21,
                            'cancel'=>$cance21,
                            'corregido'=>$venta21-$cance21,
                            'siniva'=>($venta21-$cance21)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta22>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave22,
                            'venta'=>$venta22,
                            'cancel'=>$cance22,
                            'corregido'=>$venta22-$cance22,
                            'siniva'=>$venta22-$cance22,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta23>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave23,
                            'venta'=>$venta23,
                            'cancel'=>$cance23,
                            'corregido'=>$venta23-$cance23,
                            'siniva'=>$venta23-$cance23,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                 if($venta24>0 ){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave1,
                            'venta'=>$venta24,
                            'cancel'=>$cance24,
                            'corregido' =>$venta24-$cance24,
                            'siniva' =>$venta24-$cance24,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }

                    if($venta30>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave30,
                            'venta'=>$venta30,
                            'cancel'=>$cance30,
                            'corregido'=>$venta30-$cance30,
                            'siniva'=>$venta30-$cance30,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                     if($venta32>0 ){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>17,
                            'venta'=>$venta32,
                            'cancel'=>$cance32,
                            'corregido'=>$venta32-$cance32,
                            'siniva'=>($venta32-$cance32)/$iva,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta40>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave40,
                            'venta'=>$venta40,
                            'cancel'=>$cance40,
                            'corregido'=>$venta40-$cance40,
                            'siniva'=>$venta40-$cance40,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
                    if($venta49>0){
                    $new_member_insert_datax = array(
                            'id_cc'=>$id_cc,
                            'clave1'=>$clave49,
                            'venta'=>$venta49-$cance49,
                            'cancel'=>0,
                            'corregido'=>$venta49-$cance49,
                            'fecha'=> date('Y-m-d'));
                            $insertx = $this->db->insert('desarrollo.cortes_d', $new_member_insert_datax);                    
                            }
///////////////////////////////////////////////////////////////////////////////////                    
///////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////                    
}
                    }
                
                
            }
            
            
            
            
            
            
        }
        
        
        
        $query = $this->db->get_where('desarrollo.cortes_archivo', array('id' => $id));
        
        $row = $query->row();
        
            $a = "
            <p class=\"message-box alert\">$row->archivo - Subido ".$row->fecha.", Tama&ntilde;o ".number_format($row->size, 0)." Bytes.<br />Recibido Satisfactoriamente.</p>
            ";
            
            if($validacion[1] == 'pge' || $validacion[1] == 'inv' || $validacion[1] == 'txt'){
                
            $a.="
            <pre>$string<pre>
            
            
            ";

            }else{
                foreach($map as $row){
                $a.= "Archivo: $row<br />";
                }
                
               
                
            }
            
            
        
        return $a;


    }
}

?>