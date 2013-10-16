<?php
class Empleados_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function plantilla($f1)
    {
        $aaa = date('Y');
        $s = "select b.cia,c.puesto, a.nombre as sucx,a.regional,a.superv,a.tipo2,a.suc,a.nombre,a.plantilla,
b.nomina,b.completo,b.puestox,d.nombre_e as regionalx,e.nombre as supervx,
case when f.motivo is null then 'NO' else 'RETENCION' end as motivo
from catalogo.sucursal a
left join catalogo.cat_empleado b on b.succ=a.suc and tipo=1
left join catalogo.cat_puesto c on c.puesto=b.puestox and farmacia='S'
left join catalogo.gerente d on d.ger=a.regional
left join catalogo.supervisor e on e.zona=a.superv
left join catalogo.cat_alta_empleado f on f.empleado=b.nomina and f.motivo='RETENCION' and id_causa<>7
where a.tlid=1 and a.suc>100 and a.suc<=2000
and a.suc<>170
and a.suc<>171
and a.suc<>172
and a.suc<>173
and a.suc<>174
and a.suc<>175
and a.suc<>176
and a.suc<>177
and a.suc<>178
and a.suc<>179
and a.suc<>180
and a.suc<>187
and farmacia='S'
order by puesto";
        $q = $this->db->query($s);
        foreach ($q->result() as $r) {
            $a[$r->regional]['f1'] = $f1;
            $a[$r->regional]['regional'] = $r->regional;
            $a[$r->regional]['regionalx'] = $r->regionalx;
            $a[$r->regional]['m'][$r->superv]['superv'] = $r->superv;
            $a[$r->regional]['m'][$r->superv]['supervx'] = $r->supervx;
            $a[$r->regional]['m'][$r->superv]['segundo'][$r->suc]['suc'] = $r->suc;
            $a[$r->regional]['m'][$r->superv]['segundo'][$r->suc]['sucx'] = $r->sucx;
            $a[$r->regional]['m'][$r->superv]['segundo'][$r->suc]['plantilla'] = $r->plantilla;
            $a[$r->regional]['m'][$r->superv]['segundo'][$r->suc]['tercero'][$r->nomina]['nomina'] = $r->nomina;
            $a[$r->regional]['m'][$r->superv]['segundo'][$r->suc]['tercero'][$r->nomina]['cia'] = $r->cia;
            $a[$r->regional]['m'][$r->superv]['segundo'][$r->suc]['tercero'][$r->nomina]['completo'] = $r->completo;
            $a[$r->regional]['m'][$r->superv]['segundo'][$r->suc]['tercero'][$r->nomina]['puestox'] = trim($r->puestox);
            $a[$r->regional]['m'][$r->superv]['segundo'][$r->suc]['tercero'][$r->nomina]['motivo'] = trim($r->motivo);
        }
        return $a;
    }
  
    

}
