<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Procesos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->library('unzip');
        $this->load->helper('file');
        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('Evaluacion_model');
        $this->load->model('procesos_model');
        $this->load->model('Procesos_model_pedido_f');
        $this->load->model('enlaces_model');
        $this->load->model('Catalogos_model');
        $this->load->model('backoffice_model_proceso');
        $this->load->model('archivos_externos_model');
        $this->load->model('Envio_model_as400_fin');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }

    function subir_estado_cuenta()
    {
        $data['titulo'] = "Subir estado de cuenta.";
        $this->load->view('main', $data);
    }
    
    function __changeFecha($fecha)
    {
        $f = explode('-', $fecha);
        
        $a = array(
            'ene' => '01',
            'feb' => '02',
            'mar' => '03',
            'abr' => '04',
            'may' => '05',
            'jun' => '06',
            'jul' => '07',
            'ago' => '08',
            'sep' => '09',
            'oct' => '10',
            'nov' => '11',
            'dic' => '12',
            );
            
        return date("Y-m-d", strtotime($a[strtolower($f[1])].'/'.$f[0].'/'.$f[2]));
    }
    
    function getFileContent($file)
    {
       

        $handle = fopen($file, "r");
        
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                
                $row1 = explode(',', $line);
                $row1[3] = str_replace(array('"', ','), array('', ''), $row1[3]);
                $row1[4] = str_replace(array('"', ','), array('', ''), $row1[4]);
                $row1[5] = str_replace(array(' ', ','), array('', ''), $row1[5]);
                $row1[6] = str_replace(array('"', ','), array('', ''), $row1[6]);
                $row1[8] = str_replace(array('"', ','), array('', ''), $row1[8]);
                $row1[9] = str_replace(array('"', ','), array('', ''), $row1[9]);
                
                $row = explode('	', $line);
                $row[4] = str_replace(array('"', ','), array('', ''), $row[4]);
                $row[5] = str_replace(array(' ', ','), array('', ''), $row[5]);
                
                
                if($row[0]>' ' & $row[1]<>''){
                $row[0] = $this->__changeFecha($row[0]);
                $data = array(
                    'fecha' => $row[0], 'cheque' => $row[1], 'motivo' => $row[2], 'observa' => $row[3], 'monto' => $row[4], 'rfc' => $row[5], 'referencia' => trim($row[6])
                    );
                  $this->db->insert('subir10.estado_cuenta', $data);
                }
                
                if($row1[0]>' ' & $row1[1]<>'' and $row1[4]<>''){
                print_r($row1);
                
                //die();
                $data1 = array(
                    'fecha' => $row1[3], 'cheque' => $row1[4], 'motivo' => $row1[6], 'observa' => $row1[8], 'monto' => $row1[5], 'rfc' => ' ', 'referencia' => trim($row[9])
                    );
                  $this->db->insert('subir10.estado_cuenta', $data1);
                }
            
            
            }
            
            
            ///Escribir codigo siguiente aqui
            $s0="insert ignore into oficinas.concilia_cheques_banco(fecha, cheque, motivo, observa, monto, rfc, referencia)
                (select fecha, cheque, motivo, observa, monto, rfc, referencia from subir10.estado_cuenta)";
            $this->db->query($s0);
            $s1="update oficinas.concilia_cheques_c a, oficinas.concilia_cheques_banco b
                set a.imp_cheque=b.monto,fecha_banco=b.fecha,b.imp_cxp=a.tot,iva_cxp=iva,b.var=a.var,cheque_con=a.cheque
                where a.cheque_real=b.cheque 
                and b.observa not like '%TRASPASO%' and b.rfc not like '%SCOTIAENLINEA%' and b.motivo='CARGO' and b.cheque not in(400,100)
                and b.observa not like '%SERVICIOS%' and b.observa not like '%IMPUESTO%'";
            $this->db->query($s1);
            $s2="update oficinas.concilia_cheques_partidos a, oficinas.concilia_cheques_banco b
            set a.imp_cheque=b.monto,fecha_banco=b.fecha,b.imp_cxp=a.tot,iva_cxp=iva,b.var=a.var,partido=1,
            cheque_con=a.cheque
            where a.cheque_real=b.cheque and b.motivo='CARGO'";
            $this->db->query($s2);
            $s3="update oficinas.concilia_cheques_c a, oficinas.concilia_cheques_banco b
                set a.partida=b.partido,encontrado=1
                where a.cheque=b.cheque_con and b.motivo='CARGO'";
            $this->db->query($s3);
            $s4="update oficinas.concilia_cheques_banco a, oficinas.concilia_cheques_d b
                set a.prv_cxp=b.prv,a.cia_cxp=b.cia
                where a.cheque_con=b.cheque and cheque_con>0 and a.motivo='CARGO'";
            $this->db->query($s4);
            
            
        } else {
            echo 'error opening the file.';
        } 
        fclose($handle);    
    
    }

    
    function subir_estado_cuenta_submit()
    {
        $target_dir = "uploads/";
        $target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
        $uploadOk = 1;
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
                //echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
                $this->getFileContent($target_dir);
                
                
            } else {
                //echo "Sorry, there was an error uploading your file.";
            }
        }
        
        redirect('procesos/subir_estado_cuenta');

    }

    public function s_zip_gral()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    public function zip_gral()
    {
        ini_set('memory_limit', '5000M');
        set_time_limit(0);
        //Ruta de archivos de lectura
        $ruta = 'e:/pdvsube/infosucursales/';
        //Ruta donde se desempacan los archivos
        $in = 'e:/in/';
        $respaldo = 'e:/pdvsube/infosucursales/backup/';

        //Leo el directorio
        $map = directory_map($ruta);

        //Ciclo el arreglo de la lectura
        foreach ($map as $archivo) {

            if (is_file($ruta . $archivo)) {

                echo $archivo;
                if (($archivo <> 'PQ119110.ZIP') and ($archivo <> 'PQ091210.ZIP') and ($archivo <>
                    'PQ123510.ZIP') and ($archivo <> 'PQ091210.ZIP')) {
                    $valida_ex = explode('.', $archivo);

                    //Validar que sea archivo empacado en .zip
                    if (strtolower($valida_ex[1]) == 'zip') {

                        //desempaco en directorio in
                        $this->unzip->extract($ruta . $archivo, $in . $valida_ex[0] . '/');

                        //Lee la Carpeta recien creada
                        $this->__leer_nueva_carpeta($in, $valida_ex[0]);

                    }
                    if (copy($ruta . $archivo, $respaldo . $archivo)) {
                        echo " ok<br />";
                    } else {
                        echo " mal<br />";
                    }
                    unlink($ruta . $archivo);

                }
            }


        }
        //$die();
    }


    function __leer_nueva_carpeta($in, $carpeta)
    {

        set_time_limit(0);
        $map = directory_map($in . $carpeta);
        //Ciclo el arreglo de la lectura
        foreach ($map as $archivo) {

            $valida_ex = explode('.', $archivo);

            //Validar que sea archivo empacado en .zip
            if (strtolower($valida_ex[1]) == 'crt') {
                $this->__crt($in, $carpeta, $archivo);
            } elseif (strtolower($valida_ex[1]) == 'txt') {

                $this->procesos_model->rv_ad($in, $carpeta, $archivo);
                $this->procesos_model->rv($in, $carpeta, $archivo);
                $this->procesos_model->rv_can($in, $carpeta, $archivo);
                unlink($in . $carpeta . '/' . $archivo);
            } elseif (strtolower($valida_ex[1]) == 'inv') {
                $this->__inv($in, $carpeta, $archivo);
            } else {
                unlink($in . $carpeta . '/' . $archivo);
            }


        }


    }

    function __crt($in, $carpeta, $archivo)
    {

        copy($in . $carpeta . '/' . $archivo, '../cortes/' . $archivo);
        $this->cortes_model->inserta_archivos($archivo, 1000, null);
        unlink($in . $carpeta . '/' . $archivo);
    }

    function __inv($in, $carpeta, $archivo)
    {
        copy($in . $carpeta . '/' . $archivo, './inv/' . $archivo);
        $this->procesos_model->inv_yucif($in, $carpeta, $archivo);
        unlink($in . $carpeta . '/' . $archivo);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function s_envio_gral()
    {
        $data['q'] = $this->archivos_externos_model->envio_gral();
        $data['titulo'] = "Informacion de IMS";
        $this->load->view('main', $data);
    }

    function s_ims($id)
    {
        $data['id'] = $id;
        $data['fec1'] = $this->Catalogos_model->busca_fec1_ims('ims');
        $data['titulo'] = "Informacion de IMS";
        $this->load->view('main', $data);
    }
    function genera_ims()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $q1 = $this->Catalogos_model->busca_fec1_ims_sem($this->input->post('fec1'),
            'ims');
        $r1 = $q1->row();
        $fec1 = $r1->aaa . '-' . $r1->mes . '-' . $r1->dia1;
        $fec2 = $r1->aaa . '-' . $r1->mes . '-' . $r1->dia2;
        $v1 = $r1->mes;
        $v2 = $r1->sem;
        $q = $this->backoffice_model_proceso->enlazar_var($this->input->post('id'));
        $r = $q->row();

        $this->archivos_externos_model->genera_ims_e($fec1, $fec2, $v1, $v2, $r->ftp, $r->
            usuario, $r->contra);
    }


    function s_nilsen($id)
    {
        $data['id'] = $id;
        $data['fec1'] = $this->Catalogos_model->busca_fec1_ims('nilsen');
        $data['titulo'] = "Informacion de IMS";
        $this->load->view('main', $data);
    }
    function genera_nilsen()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $q1 = $this->Catalogos_model->busca_fec1_ims_sem($this->input->post('fec1'),
            'nilsen');
        $r1 = $q1->row();
        $fec1 = $r1->fec1;
        $fec2 = $r1->fec2;
        $v1 = $r1->mes;
        $v2 = $r1->sem;
        
        $q = $this->backoffice_model_proceso->enlazar_var($this->input->post('id'));
        $r = $q->row();
        $this->archivos_externos_model->genera_nilsen_e($fec1, $fec2, $r1->sem, $r->ftp,
            $r->usuario, $r->contra);
    }
    function s_noblock($id)
    {
        $data['id'] = $id;
        $data['fec1'] = $this->Catalogos_model->busca_fec1_ims('noblock');
        $data['titulo'] = "Informacion de IMS";
        $this->load->view('main', $data);
    }
    function genera_noblock()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $q1 = $this->Catalogos_model->busca_fec1_ims_sem($this->input->post('fec1'),
            'noblock');
        $r1 = $q1->row();
        $fecha = $r1->aaa . str_pad($r1->mes, 2, "0", STR_PAD_LEFT) . str_pad($r1->dia2,
            2, "0", STR_PAD_LEFT);
            
        $q = $this->backoffice_model_proceso->enlazar_var($this->input->post('id'));
        $r = $q->row();
        echo $r1->aaa;
        $this->archivos_externos_model->genera_noblock_e($r1->aaa, $r1->mes, $fecha, $r->
            ftp, $r->usuario, $r->contra);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function s_optimogd()
    {
        $data['uno'] = $this->Catalogos_model->busca_mes();
        $data['dos'] = $this->Catalogos_model->busca_mes();
        $data['tres'] = $this->Catalogos_model->busca_mes();
        $data['cuatro'] = $this->Catalogos_model->busca_mes();
        $data['titulo'] = "Calculo de optimo para sucursales Genericas y DDR";
        $this->load->view('main', $data);
    }
    function genera_optimogd()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $this->Procesos_model_pedido_f->genera_optimogs_p($this->input->post('uno'), $this->
            input->post('dos'), $this->input->post('tres'), $this->input->post('cuatro'));
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function facturas_oficinas()
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->procesos_model->facturas_oficinas();
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function facturas_pdv()
    {
        $this->procesos_model->facturas_pdv();

    }


    function maximo_por_igual()
    {
        $clave = 908;
        $this->procesos_model->max_por($clave);
    }

    function pro_ent_sal()
    {
        $data['titulo'] = "Entradas y salidas";
        $data['q'] = $this->procesos_model->ver_ent_sal();
        $data['js'] = 'procesos/pro_inv_js';
        $this->load->view('main', $data);
    }
    function ent_sal()
    {
        $fec1 = $this->input->post('fec1');
        $fec2 = $this->input->post('fec2');
        $sem = $this->input->post('sem');
        $this->procesos_model->ent_sal($fec1, $fec2, $sem);
        redirect('procesos/pro_ent_sal');
    }
    function borrar_ent_sal($sem, $fec1)
    {
        $this->db->delete('oficinas.sem_ent_sal', array('sem' => $sem, 'fec1' => $fec1));
        redirect('procesos/pro_ent_sal');
    }
    function p_ent_sal($sem, $fec1)
    {
        $data['titulo'] = "Entradas y salidas";
        $data['q'] = $this->procesos_model->p_ent_sal($sem, $fec1);
        $data['js'] = 'procesos/p_ent_sal_js';
        $this->load->view('main', $data);
    }

    function desplaza_segpop()
    {
        $this->procesos_model->desplazamientos();

    }

    function subir_inv()
    {
        $data['titulo'] = "Inventario";
        $data['sucx'] = $this->Catalogos_model->busca_suc();
        $data['js'] = 'procesos/subir_inv_js';
        $this->load->view('main', $data);
    }

    function subir_inv_suc()
    {
        $sucx = $this->input->post('sucx');
        $data['titulo'] = " Subir Inventario";
        $this->procesos_model->elimina_suc($sucx);
        $data['js'] = 'procesos/subir_inv_suc_js';
        $this->load->view('main', $data);
    }

    function subir_inv_sucx()
    {
        $data['titulo'] = "Resultado";
        $this->procesos_model->sube_suc();
        $data['js'] = 'procesos/subir_inv_suc_js';
        $this->load->view('main', $data);
    }

    ///////////***********************************************/////////////
    ///////////***********************************************/////////////
    
    function descarga_pedidos()
    {
        $this->load->library('zip');
        
        $directorio_raiz = 'C:/wamp/www/f/resp/';
        $fecha_actual = date('Y_m_d');
        $path = $directorio_raiz . $fecha_actual . '/pdf/';

        $this->zip->read_dir($path, false);
        
        // Download the file to your desktop. Name it "my_backup.zip"
        $this->zip->download('pedidos_'.$fecha_actual.'.zip'); 
    }


    function tabla_pedidos_formulados()
    {

        ini_set('memory_limit', '5000M');
        set_time_limit(0);
        $data['titulo'] = "Generar pedidos formulados";
        $data['por1'] = $this->Catalogos_model->busca_ord_dias();
        $data['por2'] = $this->Catalogos_model->busca_ord_dias();
        $data['por3'] = $this->Catalogos_model->busca_ord_dias();
        $data['por4'] = $this->Catalogos_model->busca_ord_dias();
        $data['por5'] = $this->Catalogos_model->busca_ord_dias();
        $data['q'] = $this->Procesos_model_pedido_f->transmision();
        $data['q1'] = $this->Procesos_model_pedido_f->sin_inv_actual();
        $this->load->view('main', $data);
    }
    ///////////***********************************************/////////////
    public function sumit_pedidos_formulados()
    {

        ini_set('memory_limit', '5000M');
        set_time_limit(0);
        $this->Procesos_model_pedido_f->inserta_pedido_for($this->input->post('por1'), $this->
            input->post('por2'), $this->input->post('por3'), $this->input->post('por4'), $this->
            input->post('por5'));
        redirect('procesos/tabla_pedidos_formulados');
    }
    ///////////***********************************************/////////////
    function tabla_pedidos_formulados_especiales()
    {

        ini_set('memory_limit', '5000M');
        set_time_limit(0);
        
        $in_suc=$this->Catalogos_model->busca_sucursales_pedido_especial();
        $data['in_suc'] = $in_suc;
        $data['titulo'] = "Generar pedidos formulados";
        $data['por1'] = $this->Catalogos_model->busca_ord_dias();
        $data['por2'] = $this->Catalogos_model->busca_ord_dias();
        $data['por3'] = $this->Catalogos_model->busca_ord_dias();
        $data['por4'] = $this->Catalogos_model->busca_ord_dias();
        $data['por5'] = $this->Catalogos_model->busca_ord_dias();
        $data['q'] = $this->Procesos_model_pedido_f->transmision_especial($in_suc);
        $data['q1'] = $this->Procesos_model_pedido_f->sin_inv_actual();
        $this->load->view('main', $data);
    }
    public function sumit_pedidos_formulados_especiales()
    {

        ini_set('memory_limit', '5000M');
        set_time_limit(0);
            $this->Procesos_model_pedido_f->inserta_pedido_for_especial($this->input->post('in_suc'),$this->input->post('por1'), $this->
            input->post('por2'), $this->input->post('por3'), $this->input->post('por4'), $this->
            input->post('por5'),$this->input->post('in_sec'));
        redirect('procesos/tabla_pedidos_formulados_especiales');
    }
    ///////////***********************************************/////////////
  
    ///////////***********************************************/////////////
    public function imprime_pedidos_diarios()
    {
        ini_set('memory_limit', '5000M');
        set_time_limit(0);
        $this->Procesos_model_pedido_f->imprime_pedidos();
        //$this->Procesos_model_pedido_f->imprime_pedidos_fecha();
        redirect('procesos/tabla_pedidos_formulados');
    }
    public function imprime_pedidos_diarios_especiales()
    {
        ini_set('memory_limit', '5000M');
        set_time_limit(0);
        $this->Procesos_model_pedido_f->imprime_pedidos_especiales();
        redirect('procesos/tabla_pedidos_formulados');
    }
    public function imprime_pedidos_diarios_ctl()
    {
        $mes = date('m');
        $fecha = date('Y-m-d');
        $sql_folios = "SELECT min(a.id)as fol1,max(a.id)as fol2
FROM catalogo.folio_pedidos_cedis a
join catalogo.sucursal b on b.suc=a.suc 
where fechas = '$fecha' and tid not in('S','X')";
        $q_folios = $this->db->query($sql_folios);
        $r_folios = $q_folios->row();

        $fol1 = $r_folios->fol1;
        $fol2 = $r_folios->fol2;
        $data['cabeza'] = '';
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['cabeza'] .= "
           <table>
           
           <tr>
           <td colspan=\"6\" align=\"center\"><strong>REPORTE DE SUCURSALES QUE TRANSMITIERON PEDIDOS</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"6\" align=\"right\">Fecha de impresion.:" . date('Y-m-d H:s:i') .
            " </td>
           </tr>
           <tr>
           <td colspan=\"6\" align=\"right\">Fecha .:" . date('Y-m-d') . " </td>
           </tr>
           <tr>
           <td colspan=\"6\" align=\"left\"><strong>ENCARGADO DE PEDIDOS: MARCO ANTONIO ZACARIAS LOPEZ</strong> <br /></td>
           
           </tr>
           <tr>
           <th width=\"50\" align=\"center\"><strong>#</strong></th>
           <th width=\"160\" align=\"center\"><strong>RUTA</strong></th>
           <th width=\"70\" align=\"center\"><strong>FOLIO</strong></th>
           <th width=\"50\" align=\"center\"><strong>TIPO</strong></th>
           <th width=\"200\" align=\"left\"><strong>SUCURSAL</strong></th>
           <th width=\"50\" align=\"right\"><strong>MUE. 0-5 </strong></th>
           <th width=\"50\" align=\"right\"><strong>MUE. 6</strong></th>
           <th width=\"50\" align=\"right\"><strong>C.PED</strong></th>
          </tr>
           </table> 
            ";
        $data['fecha'] = $fecha;
        $data['fol1'] = $fol1;
        $data['fol2'] = $fol2;
        $this->load->view('impresion/previo_de_pedidos_ctl', $data);
    }
    public function imprime_pedidos_diarios_sec()
    {

        $mes = date('m');
        $fecha = date('Y-m-d');
        $fecha_archivo = date('Y_m_d');
        $data['cabeza'] = '';
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $sql_folios = "SELECT min(a.id)as fol1,max(a.id)as fol2
FROM catalogo.folio_pedidos_cedis a
join catalogo.sucursal b on b.suc=a.suc 
where fechas='$fecha' and tid not in('S','X')";

        $q_folios = $this->db->query($sql_folios);
        $r_folios = $q_folios->row();
        $fol1 = $r_folios->fol1;
        $fol2 = $r_folios->fol2;
       
        $data['cabeza'] .= "
           <table>
           
           <tr>
           <td colspan=\"4\" align=\"center\"><strong>REPORTE DE PRODUCTOS POR CLAVE</strong></td>
           </tr>
           
           <tr>
           <td colspan=\"4\" align=\"right\">Fecha de impresion.:" . date('Y-m-d H:s:i') .
            " </td>
           </tr>
           <tr>
           <td colspan=\"4\" align=\"right\">Fecha .:" . $fecha . " </td>
           </tr>
           <tr>
           <td colspan=\"4\" align=\"left\"><strong>ENCARGADO DE PEDIDOS: MARCO ANTONIO ZACARIAS LOPEZ</strong> <br /></td>
           
           </tr>
           <tr>
           <th width=\"50\" align=\"center\"><strong>UBIC</strong></th>
           <th width=\"70\" align=\"center\"><strong>SEC</strong></th>
           <th width=\"300\" align=\"center\"><strong>SUSTANCIA ACTIVA</strong></th>
           <th width=\"70\" align=\"right\"><strong>CANT.PED</strong></th>
          </tr>
           </table> 
            ";
        $data['fecha'] = $fecha;
        $data['fol1'] = $fol1;
        $data['fol2'] = $fol2;
        $this->load->view('impresion/previo_de_pedidos_ctl_sec', $data);

    }
    ///////////***********************************************/////////////
    ///////////***********************************************/////////////
    ///////////***********************************************/////////////
    public function envia_correo_pedidos()
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.farfenix.com.mx',
            'smtp_user' => 'ivan.zuniga@farfenix.com.mx',
            'smtp_pass' => '73dex',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1');
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $mensaje = 'Las sucursales se generan';
        $this->email->from('lidia.velazquez@farfenix.com.mx', 'Lidia Velazquez Alvarez');
        $this->email->to('lidia.velazquez@farfenix.com.mx');

        $this->email->cc('ivan.zuniga@farfenix.com.mx');
        $this->email->subject("Hola");
        $this->email->message($mensaje);
        $result = $this->email->send();

        echo "<pre>";
        print_r($result);
        echo "</pre>";

        echo $this->email->print_debugger();


    }
    
    
    
      ///////////***********************************************/////////////
      ///////////***********************************************///////////// Correo nivel de faltantes   
    function correo_nivel_de_surtido()
{
    
$nom ='CONCENTADO DE PRODUCTOS '.date('Ymd').'.xlsx';
$this->__genera_nivel_surtido_exel($nom);
$corr=$this->Catalogos_model->enviar_correo('1');
$my_path = $_SERVER['DOCUMENT_ROOT'].'/oficinas/correos/'.$nom;    

$cuerpo='Buenos dias<br />Envio Concentrado de productos<br />';
$cuerpo.=$this->Evaluacion_model->nivel_de_faltante_correo();
$cuerpo.='
<br />Estad&iacute;stica generada por: 
<br /><strong>LIDIA VELAZQUEZ ALVAREZ</strong>
<br />Jefe de Backoffice
<br />Departamento de sistemas';
         $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.farfenix.com.mx',
            'smtp_user' => 'lidia.velazquez@farfenix.com.mx',
            'smtp_pass' => 'li9469',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $subject='Concentrado de productos';
        $cc=''; 
        $correo="$corr";
        
        $this->email->from('lidia.velazquez@farfenix.com.mx','Concentrado de Productos');
        $this->email->to($correo);
        $this->email->cc($cc);
        $this->email->subject($subject);
        $this->email->message($cuerpo);
        $this->email->attach($my_path);
        $this->email->send();
        
        echo 'Correos Enviados a: '.$correo.' '.date('Y-m-d');
}
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function envia_correo_sin_inv()
{
 $corr= $this->Catalogos_model->enviar_correo_suc_sin_inv();
 
    
}
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function __genera_nivel_surtido_exel($nom)
{
$data['nom']= $nom;
$data['query'] = $this->Evaluacion_model->eval_cedis_pro_excel();
$this->load->view('excel/s_productos_doctor_ahorro', $data);
}
function correo_ventas()
{
$nom ='Ventas diarias '.date('Ymd').'.xlsx';
$this->__genera_venta_excel($nom);
$corr=$this->Catalogos_model->enviar_correo('2');
$my_path = $_SERVER['DOCUMENT_ROOT'].'/oficinas/correos/'.$nom; 
$cuerpo='Buenos dias<br />Envio Reporte de ventas diarias<br />';
$qq=$this->Catalogos_model->mes_act_ant();
$cuerpo.=$this->Ventas_model->ventas_correo($qq);
$cuerpo.='
<br />Estad&iacute;stica generada por: 
<br /><strong>LIDIA VELAZQUEZ ALVAREZ</strong>
<br />Jefe de Backoffice
<br />Departamento de sistemas';

         $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.farfenix.com.mx',
            'smtp_user' => 'lidia.velazquez@farfenix.com.mx',
            'smtp_pass' => 'li9469',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $subject='Ventas diarias';
        $cc=''; 
        $correo="$corr";

        $this->email->from('lidia.velazquez@farfenix.com.mx','Ventas diarias');
        $this->email->to($correo);
        $this->email->cc($cc);
        $this->email->subject($subject);
        $this->email->message($cuerpo);
        $this->email->attach($my_path);
        $this->email->send();
        
        echo 'Correos Enviados a: '.$correo.' '.date('Y-m-d H:i:s');
}


function __genera_venta_excel($nom)
{
        $data['nom']= $nom;
        $m="select year(subdate(date(now()),1))as aaa,month(subdate(date(now()),interval 1 day))as mes";
        $n=$this->db->query($m);
        $o=$n->row();
        $this->load->model('Ventas_model');
        $mes=$o->mes;
        $aaa=$o->aaa;
        //$aaa=2016;
        //$mes=4;
        $data['mesx'] = $mes;
        $data['aaax'] = $aaa;
        $data['q'] = $this->Ventas_model->ventas_acumuladas_excel_cortes($mes, $aaa);
        $data['query'] = $this->Ventas_model->ventas_acumuladas_excel($mes, $aaa);
        
        $this->load->view('excel/s_ventas_acumuladas', $data);
}

    ///////////***********************************************/////////////


    function invChetumalControl()
    {
        $this->procesos_model->invChetumal();
    }


    function DesplazamientoCtrl()
    {
        ini_set('memory_limit', '-1');
        $this->procesos_model->metroDesplazamiento('2013-01-01', '2014-07-24');
        $this->procesos_model->bansefiDesplazamiento('2013-01-01', '2014-07-24');
    }



function a_prueba_ped()
{
        $id_plaza=11;
        $data['titulo'] = "PROCESOS";
        $data['suc'] = $this->Catalogos_model->busca_suc_bloq($id_plaza);
        $data['q'] = $this->procesos_model->prueba_ped($id_plaza);
        $this->load->view('main', $data);  
}
function sumit_prueba_ped()
{
    $suc =$this->input->post('suc');
    $a=array('suc'=>$suc);
    $this->db->insert('compras.pre_pedido_f',$a);
    redirect('procesos/a_prueba_ped');  
}
function a_prueba_ped_det($id_cc)
{
        $id_plaza=11;
        $data['titulo'] = "PROCESOS";
        $data['id_cc'] = $id_cc;
        $data['q'] = $this->procesos_model->prueba_ped_det($id_cc);
        $data['js'] = 'procesos/a_prueba_ped_det_js';
        $this->load->view('main', $data);  
}
function busquedaEAN()
{
        $ean = $this->input->post('ean');
        echo $this->Catalogos_model->busca_bloq_cod($ean);
          
}
}
