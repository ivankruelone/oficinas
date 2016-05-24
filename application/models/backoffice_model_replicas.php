<?php
class backoffice_model_replicas extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

///////////////////////////////////////////////////////////////////////////////////
public function rep_sucursal($suc,$tipo)
{
$s="select c.archivo,a.nombre,b.servidor,interno,svr, destino,base_suc, nom_replica,inicio,fin,pass,intervalo,destino 
from catalogo.sucursal a
left join catalogo.cat_replicas b on b.suc=a.suc
left join catalogo.cat_replicas_tipo c on c.servidor=b.servidor and c.id=$tipo
where a.back>0 and tlid=1 and a.suc=$suc 
and b.suc is not null;";
$q=$this->db->query($s);
$r=$q->row();
$date=date('Ymd');
$replica='__'.$r->archivo.$r->servidor;
if($r->archivo<>'TODAS'){
$this->$replica($r->nombre,$r->base_suc,$r->svr,$r->nom_replica,$r->interno,$r->archivo,$date,$r->pass,$r->inicio,$r->fin,$r->intervalo,$r->destino);
}elseif($r->archivo=='TODAS')
{
$ss="select c.archivo,a.nombre,b.servidor,interno,svr, destino,base_suc, nom_replica,inicio,fin,pass,intervalo,destino
from catalogo.sucursal a
left join catalogo.cat_replicas b on b.suc=a.suc
left join catalogo.cat_replicas_tipo c on c.servidor=b.servidor 
where a.back>0 and tlid=1 and a.suc=$suc and c.archivo<>'$r->archivo'
and b.suc is not null;";
$qq=$this->db->query($ss);
$var='';
foreach ($qq->result() as $rr)
{
$rep='__'.$rr->archivo.$r->servidor;
//echo '<strong>'.$rep.'</strong>';
$var.=$this->$rep($rr->nombre,$rr->base_suc,$rr->svr,$rr->nom_replica,$rr->interno,$rr->archivo,$date,$rr->pass,$rr->inicio,$rr->fin,$rr->intervalo,$rr->destino);
}}




die();


}



///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function __VENTAS2($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{

$var="<br /><strong>-- Habilitando la base de datos de replicación ventas</strong><br />
use master
exec sp_replicationdboption @dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />go<br />
exec [$base_suc].sys.sp_addlogreader_agent @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />go<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = null, @job_password = null, @frompublisher = 1
<br />go<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', @description = N'Publicación transaccional de la base de datos ''$nombre'' del publicador ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />go<br />
exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />go<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />go<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\sqladmin'
<br />go<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\Administrador'
<br />go<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\SQLSERVERAGENT'
<br />go<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\MSSQLSERVER'
<br />go<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cxcFacturasCab', @source_owner = N'dbo', @source_object = N'cxcFacturasCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cxcFacturasCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocxcFacturasCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocxcFacturasCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocxcFacturasCab]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cxcFacturasCab', @filter_name = N'FLTR_cxcFacturasCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cxcFacturasCab', @view_name = N'SYNC_cxcFacturasCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cxcVentasFacturadasSucursalReg', @source_owner = N'dbo', @source_object = N'cxcVentasFacturadasSucursalReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cxcVentasFacturadasSucursalReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocxcVentasFacturadasSucursalReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocxcVentasFacturadasSucursalReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocxcVentasFacturadasSucursalReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cxcVentasFacturadasSucursalReg', @filter_name = N'FLTR_cxcVentasFacturadasSucursalReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cxcVentasFacturadasSucursalReg', @view_name = N'SYNC_cxcVentasFacturadasSucursalReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'espPedidosCab', @source_owner = N'dbo', @source_object = N'espPedidosCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'espPedidosCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dboespPedidosCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dboespPedidosCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dboespPedidosCab]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'espPedidosCab', @filter_name = N'FLTR_espPedidosCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'espPedidosCab', @view_name = N'SYNC_espPedidosCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'espPedidosDet', @source_owner = N'dbo', @source_object = N'espPedidosDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'espPedidosDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dboespPedidosDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dboespPedidosDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dboespPedidosDet]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'espPedidosDet', @filter_name = N'FLTR_espPedidosDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'espPedidosDet', @view_name = N'SYNC_espPedidosDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'sadPedidosCab', @source_owner = N'dbo', @source_object = N'sadPedidosCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'sadPedidosCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbosadPedidosCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbosadPedidosCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbosadPedidosCab]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'sadPedidosCab', @filter_name = N'FLTR_sadPedidosCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'sadPedidosCab', @view_name = N'SYNC_sadPedidosCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'sadPedidosDet', @source_owner = N'dbo', @source_object = N'sadPedidosDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'sadPedidosDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbosadPedidosDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbosadPedidosDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbosadPedidosDet]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'sadPedidosDet', @filter_name = N'FLTR_sadPedidosDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'sadPedidosDet', @view_name = N'SYNC_sadPedidosDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'sadPedidosFacturacionReg', @source_owner = N'dbo', @source_object = N'sadPedidosFacturacionReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'sadPedidosFacturacionReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbosadPedidosFacturacionReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbosadPedidosFacturacionReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbosadPedidosFacturacionReg]'
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venClientesPagoChequeCat', @source_owner = N'dbo', @source_object = N'venClientesPagoChequeCat', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venClientesPagoChequeCat', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenClientesPagoChequeCat]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenClientesPagoChequeCat]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenClientesPagoChequeCat]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venClientesPagoChequeCat', @filter_name = N'FLTR_venClientesPagoChequeCat_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venClientesPagoChequeCat', @view_name = N'SYNC_venClientesPagoChequeCat_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venDepositosVentaCab', @source_owner = N'dbo', @source_object = N'venDepositosVentaCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venDepositosVentaCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenDepositosVentaCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenDepositosVentaCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenDepositosVentaCab]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venDepositosVentaCab', @filter_name = N'FLTR_venDepositosVentaCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venDepositosVentaCab', @view_name = N'SYNC_venDepositosVentaCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venDepositosVentaDet', @source_owner = N'dbo', @source_object = N'venDepositosVentaDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venDepositosVentaDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenDepositosVentaDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenDepositosVentaDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenDepositosVentaDet]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venDepositosVentaDet', @filter_name = N'FLTR_venDepositosVentaDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venDepositosVentaDet', @view_name = N'SYNC_venDepositosVentaDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venDevolucionesCab', @source_owner = N'dbo', @source_object = N'venDevolucionesCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venDevolucionesCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenDevolucionesCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenDevolucionesCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenDevolucionesCab]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venDevolucionesCab', @filter_name = N'FLTR_venDevolucionesCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venDevolucionesCab', @view_name = N'SYNC_venDevolucionesCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venDevolucionesDet', @source_owner = N'dbo', @source_object = N'venDevolucionesDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venDevolucionesDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenDevolucionesDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenDevolucionesDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenDevolucionesDet]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venDevolucionesDet', @filter_name = N'FLTR_venDevolucionesDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venDevolucionesDet', @view_name = N'SYNC_venDevolucionesDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venDevolucionesIngresosCajaDet', @source_owner = N'dbo', @source_object = N'venDevolucionesIngresosCajaDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venDevolucionesIngresosCajaDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenDevolucionesIngresosCajaDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenDevolucionesIngresosCajaDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenDevolucionesIngresosCajaDet]'
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venFacturacionElectronica', @source_owner = N'dbo', @source_object = N'venFacturacionElectronica', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venFacturacionElectronica', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenFacturacionElectronica]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenFacturacionElectronica]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenFacturacionElectronica]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venFacturacionElectronica', @filter_name = N'FLTR_venFacturacionElectronica_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venFacturacionElectronica', @view_name = N'SYNC_venFacturacionElectronica_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venFoliosFacturacionDigitalReg', @source_owner = N'dbo', @source_object = N'venFoliosFacturacionDigitalReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venFoliosFacturacionDigitalReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenFoliosFacturacionDigitalReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenFoliosFacturacionDigitalReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenFoliosFacturacionDigitalReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venFoliosFacturacionDigitalReg', @filter_name = N'FLTR_venFoliosFacturacionDigitalReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venFoliosFacturacionDigitalReg', @view_name = N'SYNC_venFoliosFacturacionDigitalReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venIngresosDeCajaReg', @source_owner = N'dbo', @source_object = N'venIngresosDeCajaReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venIngresosDeCajaReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenIngresosDeCajaReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenIngresosDeCajaReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenIngresosDeCajaReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venIngresosDeCajaReg', @filter_name = N'FLTR_venIngresosDeCajaReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venIngresosDeCajaReg', @view_name = N'SYNC_venIngresosDeCajaReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venPagoRecibidosACuentaReg', @source_owner = N'dbo', @source_object = N'venPagoRecibidosACuentaReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venPagoRecibidosACuentaReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenPagoRecibidosACuentaReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenPagoRecibidosACuentaReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenPagoRecibidosACuentaReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venPagoRecibidosACuentaReg', @filter_name = N'FLTR_venPagoRecibidosACuentaReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venPagoRecibidosACuentaReg', @view_name = N'SYNC_venPagoRecibidosACuentaReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venPagoServiciosElectronicosFacturacionReg', @source_owner = N'dbo', @source_object = N'venPagoServiciosElectronicosFacturacionReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venPagoServiciosElectronicosFacturacionReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenPagoServiciosElectronicosFacturacionReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenPagoServiciosElectronicosFacturacionReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenPagoServiciosElectronicosFacturacionReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venPagoServiciosElectronicosFacturacionReg', @filter_name = N'FLTR_venPagoServiciosElectronicosFacturacionReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venPagoServiciosElectronicosFacturacionReg', @view_name = N'SYNC_venPagoServiciosElectronicosFacturacionReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venPagoServiciosElectronicosReg', @source_owner = N'dbo', @source_object = N'venPagoServiciosElectronicosReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venPagoServiciosElectronicosReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenPagoServiciosElectronicosReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenPagoServiciosElectronicosReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenPagoServiciosElectronicosReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venPagoServiciosElectronicosReg', @filter_name = N'FLTR_venPagoServiciosElectronicosReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venPagoServiciosElectronicosReg', @view_name = N'SYNC_venPagoServiciosElectronicosReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venRecetasAntibioticosCab', @source_owner = N'dbo', @source_object = N'venRecetasAntibioticosCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'manual', @destination_table = N'venRecetasAntibioticosCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenRecetasAntibioticosCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenRecetasAntibioticosCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenRecetasAntibioticosCab]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venRecetasAntibioticosCab', @filter_name = N'FLTR_venRecetasAntibioticosCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venRecetasAntibioticosCab', @view_name = N'SYNC_venRecetasAntibioticosCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venRecetasAntibioticosDet', @source_owner = N'dbo', @source_object = N'venRecetasAntibioticosDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venRecetasAntibioticosDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenRecetasAntibioticosDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenRecetasAntibioticosDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenRecetasAntibioticosDet]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venRecetasAntibioticosDet', @filter_name = N'FLTR_venRecetasAntibioticosDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venRecetasAntibioticosDet', @view_name = N'SYNC_venRecetasAntibioticosDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venRecetasReg', @source_owner = N'dbo', @source_object = N'venRecetasReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venRecetasReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenRecetasReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenRecetasReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenRecetasReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venRecetasReg', @filter_name = N'FLTR_venRecetasReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venRecetasReg', @view_name = N'SYNC_venRecetasReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venRetiroValoresReg', @source_owner = N'dbo', @source_object = N'venRetiroValoresReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'manual', @destination_table = N'venRetiroValoresReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenRetiroValoresReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenRetiroValoresReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenRetiroValoresReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venRetiroValoresReg', @filter_name = N'FLTR_venRetiroValoresReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venRetiroValoresReg', @view_name = N'SYNC_venRetiroValoresReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venTurnosCajaCierreReg', @source_owner = N'dbo', @source_object = N'venTurnosCajaCierreReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venTurnosCajaCierreReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenTurnosCajaCierreReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenTurnosCajaCierreReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenTurnosCajaCierreReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venTurnosCajaCierreReg', @filter_name = N'FLTR_venTurnosCajaCierreReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venTurnosCajaCierreReg', @view_name = N'SYNC_venTurnosCajaCierreReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venValesCab', @source_owner = N'dbo', @source_object = N'venValesCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venValesCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenValesCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenValesCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenValesCab]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venValesCab', @filter_name = N'FLTR_venValesCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venValesCab', @view_name = N'SYNC_venValesCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venValesDet', @source_owner = N'dbo', @source_object = N'venValesDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venValesDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenValesDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenValesDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenValesDet]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venValesDet', @filter_name = N'FLTR_venValesDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venValesDet', @view_name = N'SYNC_venValesDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venValesEmitidosReg', @source_owner = N'dbo', @source_object = N'venValesEmitidosReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venValesEmitidosReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenValesEmitidosReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenValesEmitidosReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenValesEmitidosReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venValesEmitidosReg', @filter_name = N'FLTR_venValesEmitidosReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1

<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venValesRecibidosCab', @source_owner = N'dbo', @source_object = N'venValesRecibidosCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venValesRecibidosCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenValesRecibidosCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenValesRecibidosCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenValesRecibidosCab]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venValesRecibidosCab', @filter_name = N'FLTR_venValesRecibidosCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venValesRecibidosCab', @view_name = N'SYNC_venValesRecibidosCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venValesRecibidosDet', @source_owner = N'dbo', @source_object = N'venValesRecibidosDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venValesRecibidosDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenValesRecibidosDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenValesRecibidosDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenValesRecibidosDet]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venValesRecibidosDet', @filter_name = N'FLTR_venValesRecibidosDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venValesRecibidosDet', @view_name = N'SYNC_venValesRecibidosDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venValesRecibidosReg', @source_owner = N'dbo', @source_object = N'venValesRecibidosReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venValesRecibidosReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenValesRecibidosReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenValesRecibidosReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenValesRecibidosReg]'
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasAfiliados', @source_owner = N'dbo', @source_object = N'venVentasAfiliados', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasAfiliados', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasAfiliados]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasAfiliados]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasAfiliados]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasAfiliados', @filter_name = N'FLTR_venVentasAfiliados_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasAfiliados', @view_name = N'SYNC_venVentasAfiliados_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasBoletos', @source_owner = N'dbo', @source_object = N'venVentasBoletos', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasBoletos', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasBoletos]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasBoletos]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasBoletos]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasBoletos', @filter_name = N'FLTR_venVentasBoletos_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasBoletos', @view_name = N'SYNC_venVentasBoletos_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasCab', @source_owner = N'dbo', @source_object = N'venVentasCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasCab]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasCab', @filter_name = N'FLTR_venVentasCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasCab', @view_name = N'SYNC_venVentasCab_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasCodigosRelacionadosDet', @source_owner = N'dbo', @source_object = N'venVentasCodigosRelacionadosDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasCodigosRelacionadosDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasCodigosRelacionadosDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasCodigosRelacionadosDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasCodigosRelacionadosDet]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasCodigosRelacionadosDet', @filter_name = N'FLTR_venVentasCodigosRelacionadosDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasCodigosRelacionadosDet', @view_name = N'SYNC_venVentasCodigosRelacionadosDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasDatosSolicitadosReg', @source_owner = N'dbo', @source_object = N'venVentasDatosSolicitadosReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasDatosSolicitadosReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasDatosSolicitadosReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasDatosSolicitadosReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasDatosSolicitadosReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasDatosSolicitadosReg', @filter_name = N'FLTR_venVentasDatosSolicitadosReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasDatosSolicitadosReg', @view_name = N'SYNC_venVentasDatosSolicitadosReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasDatosValidacionRecetasDevolucionReg', @source_owner = N'dbo', @source_object = N'venVentasDatosValidacionRecetasDevolucionReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasDatosValidacionRecetasDevolucionReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasDatosValidacionRecetasDevolucionReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasDatosValidacionRecetasDevolucionReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasDatosValidacionRecetasDevolucionReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articleview @publication = N'$nombre', @article = N'venVentasDatosValidacionRecetasDevolucionReg', @view_name = N'SYNC_venVentasDatosValidacionRecetasDevolucionReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasDatosValidacionRecetasReg', @source_owner = N'dbo', @source_object = N'venVentasDatosValidacionRecetasReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasDatosValidacionRecetasReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasDatosValidacionRecetasReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasDatosValidacionRecetasReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasDatosValidacionRecetasReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasDatosValidacionRecetasReg', @filter_name = N'FLTR_venVentasDatosValidacionRecetasReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasDatosValidacionRecetasReg', @view_name = N'SYNC_venVentasDatosValidacionRecetasReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasDet', @source_owner = N'dbo', @source_object = N'venVentasDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasDet]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasDet', @filter_name = N'FLTR_venVentasDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasDet', @view_name = N'SYNC_venVentasDet_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasDetalleReg', @source_owner = N'dbo', @source_object = N'venVentasDetalleReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasDetalleReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasDetalleReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasDetalleReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasDetalleReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasDetalleReg', @filter_name = N'FLTR_venVentasDetalleReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasDetalleReg', @view_name = N'SYNC_venVentasDetalleReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasFacturacionCanceladaReg', @source_owner = N'dbo', @source_object = N'venVentasFacturacionCanceladaReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasFacturacionCanceladaReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasFacturacionCanceladaReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasFacturacionCanceladaReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasFacturacionCanceladaReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasFacturacionCanceladaReg', @filter_name = N'FLTR_venVentasFacturacionCanceladaReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasFacturacionCanceladaReg', @view_name = N'SYNC_venVentasFacturacionCanceladaReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasFacturacionReg', @source_owner = N'dbo', @source_object = N'venVentasFacturacionReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasFacturacionReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasFacturacionReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasFacturacionReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasFacturacionReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasFacturacionReg', @filter_name = N'FLTR_venVentasFacturacionReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasFacturacionReg', @view_name = N'SYNC_venVentasFacturacionReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venVentasPagoElectronicoReg', @source_owner = N'dbo', @source_object = N'venVentasPagoElectronicoReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'venVentasPagoElectronicoReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenVentasPagoElectronicoReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenVentasPagoElectronicoReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenVentasPagoElectronicoReg]', @filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venVentasPagoElectronicoReg', @filter_name = N'FLTR_venVentasPagoElectronicoReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venVentasPagoElectronicoReg', @view_name = N'SYNC_venVentasPagoElectronicoReg_1__70', @filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />go<br />

use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql',@destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic',@article = N'all', @update_mode = N'read only', @subscriber_type = 0 
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql',@subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor' 
<br />GO<br />

";

echo $var;
}

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function __COMPRAS2($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{

$var="
<br />--<strong> Habilitando la base de datos de replicación de compras_pedidos</strong><br />
use master
exec sp_replicationdboption @dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />

exec [$base_suc].sys.sp_addlogreader_agent @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = null, @job_password = null, @frompublisher = 1
<br />GO<br />
<br />-- Agregando la publicación transaccional<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre',
@description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />


exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\sqladmin'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\Administrador'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\SQLSERVERAGENT'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cmpComprasCab', @source_owner = N'dbo', @source_object = N'cmpComprasCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cmpComprasCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocmpComprasCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocmpComprasCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocmpComprasCab]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cmpComprasCab', @filter_name = N'FLTR_cmpComprasCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cmpComprasCab', @view_name = N'SYNC_cmpComprasCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cmpComprasDet', @source_owner = N'dbo', @source_object = N'cmpComprasDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cmpComprasDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocmpComprasDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocmpComprasDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocmpComprasDet]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cmpComprasDet', @filter_name = N'FLTR_cmpComprasDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cmpComprasDet', @view_name = N'SYNC_cmpComprasDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cmpComprasDirectasCab', @source_owner = N'dbo', @source_object = N'cmpComprasDirectasCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cmpComprasDirectasCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocmpComprasDirectasCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocmpComprasDirectasCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocmpComprasDirectasCab]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cmpComprasDirectasCab', @filter_name = N'FLTR_cmpComprasDirectasCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cmpComprasDirectasCab', @view_name = N'SYNC_cmpComprasDirectasCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cmpComprasDirectasDet', @source_owner = N'dbo', @source_object = N'cmpComprasDirectasDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cmpComprasDirectasDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocmpComprasDirectasDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocmpComprasDirectasDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocmpComprasDirectasDet]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cmpComprasDirectasDet', @filter_name = N'FLTR_cmpComprasDirectasDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cmpComprasDirectasDet', @view_name = N'SYNC_cmpComprasDirectasDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cmpNotaCreditoCab', @source_owner = N'dbo', @source_object = N'cmpNotaCreditoCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cmpNotaCreditoCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocmpNotaCreditoCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocmpNotaCreditoCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocmpNotaCreditoCab]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cmpNotaCreditoCab', @filter_name = N'FLTR_cmpNotaCreditoCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cmpNotaCreditoCab', @view_name = N'SYNC_cmpNotaCreditoCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cmpNotaCreditoDet', @source_owner = N'dbo', @source_object = N'cmpNotaCreditoDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cmpNotaCreditoDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocmpNotaCreditoDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocmpNotaCreditoDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocmpNotaCreditoDet]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cmpNotaCreditoDet', @filter_name = N'FLTR_cmpNotaCreditoDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cmpNotaCreditoDet', @view_name = N'SYNC_cmpNotaCreditoDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cmpRecepcionCompraReg', @source_owner = N'dbo', @source_object = N'cmpRecepcionCompraReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cmpRecepcionCompraReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocmpRecepcionCompraReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocmpRecepcionCompraReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocmpRecepcionCompraReg]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cmpRecepcionCompraReg', @filter_name = N'FLTR_cmpRecepcionCompraReg_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cmpRecepcionCompraReg', @view_name = N'SYNC_cmpRecepcionCompraReg_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cnsCompraCab', @source_owner = N'dbo', @source_object = N'cnsCompraCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cnsCompraCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocnsCompraCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocnsCompraCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocnsCompraCab]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cnsCompraCab', @filter_name = N'FLTR_cnsCompraCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cnsCompraCab', @view_name = N'SYNC_cnsCompraCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cnsCompraDet', @source_owner = N'dbo', @source_object = N'cnsCompraDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cnsCompraDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocnsCompraDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocnsCompraDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocnsCompraDet]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cnsCompraDet', @filter_name = N'FLTR_cnsCompraDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cnsCompraDet', @view_name = N'SYNC_cnsCompraDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cnsDevolucionesCab', @source_owner = N'dbo', @source_object = N'cnsDevolucionesCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cnsDevolucionesCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocnsDevolucionesCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocnsDevolucionesCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocnsDevolucionesCab]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cnsDevolucionesCab', @filter_name = N'FLTR_cnsDevolucionesCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cnsDevolucionesCab', @view_name = N'SYNC_cnsDevolucionesCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'cnsDevolucionesDet', @source_owner = N'dbo', @source_object = N'cnsDevolucionesDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'cnsDevolucionesDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbocnsDevolucionesDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbocnsDevolucionesDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbocnsDevolucionesDet]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'cnsDevolucionesDet', @filter_name = N'FLTR_cnsDevolucionesDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'cnsDevolucionesDet', @view_name = N'SYNC_cnsDevolucionesDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'pedArticulosNegadosReg', @source_owner = N'dbo', @source_object = N'pedArticulosNegadosReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'pedArticulosNegadosReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbopedArticulosNegadosReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbopedArticulosNegadosReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbopedArticulosNegadosReg]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'pedArticulosNegadosReg', @filter_name = N'FLTR_pedArticulosNegadosReg_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'pedArticulosNegadosReg', @view_name = N'SYNC_pedArticulosNegadosReg_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'pedPedidosCab', @source_owner = N'dbo', @source_object = N'pedPedidosCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'pedPedidosCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbopedPedidosCab]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbopedPedidosCab]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbopedPedidosCab]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'pedPedidosCab', @filter_name = N'FLTR_pedPedidosCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'pedPedidosCab', @view_name = N'SYNC_pedPedidosCab_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'pedPedidosDescuentosCascadaReg', @source_owner = N'dbo', @source_object = N'pedPedidosDescuentosCascadaReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'pedPedidosDescuentosCascadaReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbopedPedidosDescuentosCascadaReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbopedPedidosDescuentosCascadaReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbopedPedidosDescuentosCascadaReg]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'pedPedidosDescuentosCascadaReg', @filter_name = N'FLTR_pedPedidosDescuentosCascadaReg_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'pedPedidosDescuentosCascadaReg', @view_name = N'SYNC_pedPedidosDescuentosCascadaReg_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'pedPedidosDet', @source_owner = N'dbo', @source_object = N'pedPedidosDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'pedPedidosDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbopedPedidosDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbopedPedidosDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbopedPedidosDet]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'pedPedidosDet', @filter_name = N'FLTR_pedPedidosDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'pedPedidosDet', @view_name = N'SYNC_pedPedidosDet_1__68', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql',@destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic',@article = N'all', @update_mode = N'read only', @subscriber_type = 0 
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql',@subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor' 
<br />GO<br />";
echo $var;
}
///////////////////////////////////////////////////////////////////////////////////
function __EXISTENCIAS2($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{
$var="replica de existencias o inventarios
<br />-- <strong>Habilitando la base de datos de replicación existencias o inventarios</strong><br />
use master
exec sp_replicationdboption @dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />

exec [$base_suc].sys.sp_addlogreader_agent @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = null, @job_password = null, @frompublisher = 1
<br />GO<br />
<br />-- Agregando la publicación transaccional<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', 
@description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador ''$svr''.', 
@sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'false', 
@enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, 
@ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', 
@repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'false', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />


exec sp_addpublication_snapshot @publication = N'$nombre', 
@frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, 
@frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, 
@active_start_date = 0, @active_end_date = 0, @job_login = null, @job_password = null, @publisher_security_mode = 0, 
@publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\sqladmin'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\Administrador'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\SQLSERVERAGENT'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />

<br />-- Agregando los artículos transaccionales<br />

use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'invControlExistenciasLotesReg', @source_owner = N'dbo', @source_object = N'invControlExistenciasLotesReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'invControlExistenciasLotesReg', @destination_owner = N'dbo', @status = 8, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dboinvControlExistenciasLotesReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dboinvControlExistenciasLotesReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dboinvControlExistenciasLotesReg]', 
@filter_clause = N'[codigoSucursal] =$sucursal'

<br />-- Agregando el filtro de artículo<br />
exec sp_articlefilter @publication = N'$nombre', @article = N'invControlExistenciasLotesReg', @filter_name = N'FLTR_invControlExistenciasLotesReg_1__59', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1

<br />-- Agregando el objeto de sincronización de artículo<br />
exec sp_articleview @publication = N'$nombre', @article = N'invControlExistenciasLotesReg', @view_name = N'SYNC_invControlExistenciasLotesReg_1__59', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'invControlExistenciasReg', @source_owner = N'dbo', @source_object = N'invControlExistenciasReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'invControlExistenciasReg', @destination_owner = N'dbo', @status = 8, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dboinvControlExistenciasReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dboinvControlExistenciasReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dboinvControlExistenciasReg]', 
@filter_clause = N'[codigoSucursal] =$sucursal'

<br />-- Agregando el filtro de artículo<br />
exec sp_articlefilter @publication = N'$nombre', @article = N'invControlExistenciasReg', @filter_name = N'FLTR_invControlExistenciasReg_1__59', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1

<br />-- Agregando el objeto de sincronización de artículo<br />
exec sp_articleview @publication = N'$nombre', @article = N'invControlExistenciasReg', @view_name = N'SYNC_invControlExistenciasReg_1__59', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql',@destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic',@article = N'all', @update_mode = N'read only', @subscriber_type = 0 
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql',@subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor' 
<br />GO<br />";
echo $var;
}
    ///////////////////////////////////////////////////////////////////////////////////
function __CONFIGURACION2($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{
$var="<br /><strong>-- Habilitando la base de datos de replicación de configuraciones</strong><br />
use master
exec sp_replicationdboption 
@dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />
exec [$base_suc].sys.sp_addlogreader_agent @job_login = null, @job_password = null, 
@publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = null, @job_password = null, @frompublisher = 1
<br />GO<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', 
@description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />
exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\sqladmin'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre',
@login = N'$svr\Administrador'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\SQLSERVERAGENT'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'sadConfiguracionCnf', @source_owner = N'dbo', @source_object = N'sadConfiguracionCnf', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803409F, @identityrangemanagementoption = N'none', @destination_table = N'sadConfiguracionCnf', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbosadConfiguracionCnf]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbosadConfiguracionCnf]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbosadConfiguracionCnf]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'sadConfiguracionCnf', @filter_name = N'FLTR_sadConfiguracionCnf_1__64', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1

exec sp_articleview @publication = N'$nombre', @article = N'sadConfiguracionCnf', @view_name = N'SYNC_sadConfiguracionCnf_1__64', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql',@destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic',@article = N'all', @update_mode = N'read only', @subscriber_type = 0 
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql',@subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 64, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor' 
<br />GO<br />";
echo $var;
}

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function __MOVIMIENTOS2($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{
$var="<br /><strong>-- Habilitando la base de datos de replicación de movimientos</strong><br />
use master
exec sp_replicationdboption 
@dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />
exec [$base_suc].sys.sp_addlogreader_agent @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = null, @job_password = null, @frompublisher = 1
<br />GO<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', @description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />
exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\sqladmin'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\Administrador'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\SQLSERVERAGENT'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />
use [$base_suc]

exec sp_addarticle @publication = N'$nombre', @article = N'invHistorialMovimientosDet', @source_owner = N'dbo', @source_object = N'invHistorialMovimientosDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'invHistorialMovimientosDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dboinvHistorialMovimientosDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dboinvHistorialMovimientosDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dboinvHistorialMovimientosDet]', 
@filter_clause = N'[codigoMovimiento] in(11,12) and [codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'invHistorialMovimientosDet', @filter_name = N'FLTR_invHistorialMovimientosDet_1__69', 
@filter_clause = N'[codigoMovimiento] in(11,12) and [codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'invHistorialMovimientosDet', @view_name = N'SYNC_invHistorialMovimientosDet_1__69', 
@filter_clause = N'[codigoMovimiento] in(11,12) and [codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'invHistorialMovimientosLotesDet', @source_owner = N'dbo', @source_object = N'invHistorialMovimientosLotesDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'invHistorialMovimientosLotesDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dboinvHistorialMovimientosLotesDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dboinvHistorialMovimientosLotesDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dboinvHistorialMovimientosLotesDet]', 
@filter_clause = N'[codigoMovimiento] in(11,12) and [codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'invHistorialMovimientosLotesDet', @filter_name = N'FLTR_invHistorialMovimientosLotesDet_1__69', 
@filter_clause = N'[codigoMovimiento] in(11,12) and [codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'invHistorialMovimientosLotesDet', @view_name = N'SYNC_invHistorialMovimientosLotesDet_1__69', 
@filter_clause = N'[codigoMovimiento] in(11,12) and [codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'invMovimientosAlmacenDet', @source_owner = N'dbo', @source_object = N'invMovimientosAlmacenDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'invMovimientosAlmacenDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dboinvMovimientosAlmacenDet]', @del_cmd = N'CALL [dbo].[sp_MSdel_dboinvMovimientosAlmacenDet]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dboinvMovimientosAlmacenDet]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'invMovimientosAlmacenDet', @filter_name = N'FLTR_invMovimientosAlmacenDet_1__69', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'invMovimientosAlmacenDet', @view_name = N'SYNC_invMovimientosAlmacenDet_1__69', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql',@destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic',@article = N'all', @update_mode = N'read only', @subscriber_type = 0 
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql',@subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor' 
<br />GO<br />";
echo $var;
}

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function __RFC2($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{
$var="<br /><strong>-- Habilitando la base de datos de replicación rfc</strong><br />
use master
exec sp_replicationdboption 
@dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />
exec [$base_suc].sys.sp_addlogreader_agent @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = null, @job_password = null, @frompublisher = 1
<br />GO<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', 
@description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />
exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\sqladmin'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\Administrador'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\SQLSERVERAGENT'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'sadRfcClientesCat', @source_owner = N'dbo', @source_object = N'sadRfcClientesCat', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803409F, @identityrangemanagementoption = N'none', @destination_table = N'sadRfcClientesCat', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbosadRfcClientesCat]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbosadRfcClientesCat]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbosadRfcClientesCat]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'sadRfcClientesCat', @filter_name = N'FLTR_sadRfcClientesCat_1__64', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'sadRfcClientesCat', @view_name = N'SYNC_sadRfcClientesCat_1__64', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql',@destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic',@article = N'all', @update_mode = N'read only', @subscriber_type = 0 
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql',@subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor' 
<br />GO<br />";
echo $var;
}

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function __SERVICIOS2($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{
$var="<br />-- <strong>Habilitando la base de datos de replicación servicios verticales</strong><br />
use master
exec sp_replicationdboption @dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />
exec [$base_suc].sys.sp_addlogreader_agent @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = null, @job_password = null, @frompublisher = 1
<br />GO<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', 
@description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />
exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = null, @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\sqladmin'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', 
@login = N'$svr\Administrador'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\SQLSERVERAGENT'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT SERVICE\MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venAhorroVoluntarioReg', @source_owner = N'dbo', @source_object = N'venAhorroVoluntarioReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803409F, @identityrangemanagementoption = N'none', @destination_table = N'venAhorroVoluntarioReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenAhorroVoluntarioReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenAhorroVoluntarioReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenAhorroVoluntarioReg]', 
@filter_clause = N'[codigoSucursal]=$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venAhorroVoluntarioReg', @filter_name = N'FLTR_venAhorroVoluntarioReg_1__67', 
@filter_clause = N'[codigoSucursal]=$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venAhorroVoluntarioReg', @view_name = N'SYNC_venAhorroVoluntarioReg_1__67', 
@filter_clause = N'[codigoSucursal]=$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venCashBackReg', @source_owner = N'dbo', @source_object = N'venCashBackReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803409F, @identityrangemanagementoption = N'none', @destination_table = N'venCashBackReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenCashBackReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenCashBackReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenCashBackReg]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venCashBackReg', @filter_name = N'FLTR_venCashBackReg_1__67', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venCashBackReg', @view_name = N'SYNC_venCashBackReg_1__67', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venConveniosEfectivoReg', @source_owner = N'dbo', @source_object = N'venConveniosEfectivoReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803409F, @identityrangemanagementoption = N'none', @destination_table = N'venConveniosEfectivoReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenConveniosEfectivoReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenConveniosEfectivoReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenConveniosEfectivoReg]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venConveniosEfectivoReg', @filter_name = N'FLTR_venConveniosEfectivoReg_1__67', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venConveniosEfectivoReg', @view_name = N'SYNC_venConveniosEfectivoReg_1__67', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'venRemesasReg', @source_owner = N'dbo', @source_object = N'venRemesasReg', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803409F, @identityrangemanagementoption = N'none', @destination_table = N'venRemesasReg', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [dbo].[sp_MSins_dbovenRemesasReg]', @del_cmd = N'CALL [dbo].[sp_MSdel_dbovenRemesasReg]', @upd_cmd = N'SCALL [dbo].[sp_MSupd_dbovenRemesasReg]', 
@filter_clause = N'[codigoSucursal] =$sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'venRemesasReg', @filter_name = N'FLTR_venRemesasReg_1__67', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'venRemesasReg', @view_name = N'SYNC_venRemesasReg_1__67', 
@filter_clause = N'[codigoSucursal] =$sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql',@destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic',@article = N'all', @update_mode = N'read only', @subscriber_type = 0 
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql',@subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor' 
<br />GO<br />";
echo $var;
}
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function __COMPRAS1($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{
$MSSQLSERVER='$MSSQLSERVER';
$var="
<br /><strong><font color='red'>-- $farmacia REPICA  DE $archivo : ".$nombre."</font></strong><br />
use master<br />
exec sp_replicationdboption @dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />

exec [$base_suc].sys.sp_addlogreader_agent @job_login = N'$svr\sqladmin', @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = N'$svr\sqladmin', @job_password = null, @frompublisher = 1
<br />GO<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', @description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />
exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = N'$svr\sqladmin', @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'BUILTIN\Administradores'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\SQLServer2005SQLAgentUser$".$svr."$MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\SQLServer2005MSSQLUser$".$svr."$MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'CompraCab', @source_owner = N'dbo', @source_object = N'CompraCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'CompraCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboCompraCab]', @del_cmd = N'CALL [sp_MSdel_dboCompraCab]', @upd_cmd = N'SCALL [sp_MSupd_dboCompraCab]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'CompraCab', @filter_name = N'FLTR_CompraCab_1__64', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'CompraCab', @view_name = N'SYNC_CompraCab_1__64', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'CompraDet', @source_owner = N'dbo', @source_object = N'CompraDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'CompraDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboCompraDet]', @del_cmd = N'CALL [sp_MSdel_dboCompraDet]', @upd_cmd = N'SCALL [sp_MSupd_dboCompraDet]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'CompraDet', @filter_name = N'FLTR_CompraDet_1__64', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'CompraDet', @view_name = N'SYNC_CompraDet_1__64', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'CompraDirCab', @source_owner = N'dbo', @source_object = N'CompraDirCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'CompraDirCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboCompraDirCab]', @del_cmd = N'CALL [sp_MSdel_dboCompraDirCab]', @upd_cmd = N'SCALL [sp_MSupd_dboCompraDirCab]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'CompraDirCab', @filter_name = N'FLTR_CompraDirCab_1__64', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'CompraDirCab', @view_name = N'SYNC_CompraDirCab_1__64', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'CompraDirDet', @source_owner = N'dbo', @source_object = N'CompraDirDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'CompraDirDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboCompraDirDet]', @del_cmd = N'CALL [sp_MSdel_dboCompraDirDet]', @upd_cmd = N'SCALL [sp_MSupd_dboCompraDirDet]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'CompraDirDet', @filter_name = N'FLTR_CompraDirDet_1__64', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'CompraDirDet', @view_name = N'SYNC_CompraDirDet_1__64', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'NotaCreditoCab', @source_owner = N'dbo', @source_object = N'NotaCreditoCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'NotaCreditoCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboNotaCreditoCab]', @del_cmd = N'CALL [sp_MSdel_dboNotaCreditoCab]', @upd_cmd = N'SCALL [sp_MSupd_dboNotaCreditoCab]', @filter_clause = N'[CodFarmacia] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'NotaCreditoCab', @filter_name = N'FLTR_NotaCreditoCab_1__64', @filter_clause = N'[CodFarmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'NotaCreditoCab', @view_name = N'SYNC_NotaCreditoCab_1__64', @filter_clause = N'[CodFarmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'NotaCreditoDet', @source_owner = N'dbo', @source_object = N'NotaCreditoDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'NotaCreditoDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboNotaCreditoDet]', @del_cmd = N'CALL [sp_MSdel_dboNotaCreditoDet]', @upd_cmd = N'SCALL [sp_MSupd_dboNotaCreditoDet]', @filter_clause = N'[CodFarmacia] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'NotaCreditoDet', @filter_name = N'FLTR_NotaCreditoDet_1__64', @filter_clause = N'[CodFarmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'NotaCreditoDet', @view_name = N'SYNC_NotaCreditoDet_1__64', @filter_clause = N'[CodFarmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />

use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql', @destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic', @article = N'all', @update_mode = N'read only', @subscriber_type = 0
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql', @subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor'
<br />GO<br />
";
echo $var;
}
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function __MOVIMIENTOS1($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{
$MSSQLSERVER='$MSSQLSERVER';
$var="<br /><strong><font color='red'>-- $farmacia REPICA  DE $archivo : ".$nombre."</font></strong><br />
use master
exec sp_replicationdboption @dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />
exec [$base_suc].sys.sp_addlogreader_agent @job_login = N'$svr\sqladmin', @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = N'$svr\sqladmin', @job_password = null, @frompublisher = 1
<br />GO<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', @description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />
exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = N'$svr\sqladmin', @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'BUILTIN\Administradores'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\SQLServer2005SQLAgentUser$".$svr."$MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\SQLServer2005MSSQLUser$".$svr."$MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'MovAlmDet', @source_owner = N'dbo', @source_object = N'MovAlmDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'MovAlmDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboMovAlmDet]', @del_cmd = N'CALL [sp_MSdel_dboMovAlmDet]', @upd_cmd = N'SCALL [sp_MSupd_dboMovAlmDet]', @filter_clause = N'[Cve_Farmacia] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'MovAlmDet', @filter_name = N'FLTR_MovAlmDet_1__70', @filter_clause = N'[Cve_Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'MovAlmDet', @view_name = N'SYNC_MovAlmDet_1__70', @filter_clause = N'[Cve_Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'MovGralInv', @source_owner = N'dbo', @source_object = N'MovGralInv', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'MovGralInv', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboMovGralInv]', @del_cmd = N'CALL [sp_MSdel_dboMovGralInv]', @upd_cmd = N'SCALL [sp_MSupd_dboMovGralInv]', @filter_clause = N'[Cve_Farmacia] = $sucursal AND (Cve_Movto = 20 OR Cve_Movto = 22)'
exec sp_articlefilter @publication = N'$nombre', @article = N'MovGralInv', @filter_name = N'FLTR_MovGralInv_1__70', @filter_clause = N'[Cve_Farmacia] = $sucursal AND (Cve_Movto = 20 OR Cve_Movto = 22)', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'MovGralInv', @view_name = N'SYNC_MovGralInv_1__70', @filter_clause = N'[Cve_Farmacia] = $sucursal AND (Cve_Movto = 20 OR Cve_Movto = 22)', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql', @destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic', @article = N'all', @update_mode = N'read only', @subscriber_type = 0
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql', @subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor'
<br />GO<br />
";
echo $var;    
}
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function __PEDIDOS1($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{
$MSSQLSERVER='$MSSQLSERVER';
$var="<br /><strong><font color='red'>-- $farmacia REPICA  DE $archivo : ".$nombre."</font></strong><br />
use master
exec sp_replicationdboption @dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />
exec [$base_suc].sys.sp_addlogreader_agent @job_login = N'$svr\sqladmin', @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = N'$svr\sqladmin', @job_password = null, @frompublisher = 1
<br />GO<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', @description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />
exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = N'$svr\sqladmin', @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'BUILTIN\Administradores'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\SQLServer2005SQLAgentUser$".$svr."$MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\SQLServer2005MSSQLUser$".$svr."$MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'PedidosCab', @source_owner = N'dbo', @source_object = N'PedidosCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'PedidosCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboPedidosCab]', @del_cmd = N'CALL [sp_MSdel_dboPedidosCab]', @upd_cmd = N'SCALL [sp_MSupd_dboPedidosCab]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'PedidosCab', @filter_name = N'FLTR_PedidosCab_1__77', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'PedidosCab', @view_name = N'SYNC_PedidosCab_1__77', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'PedidosDet', @source_owner = N'dbo', @source_object = N'PedidosDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'PedidosDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboPedidosDet]', @del_cmd = N'CALL [sp_MSdel_dboPedidosDet]', @upd_cmd = N'SCALL [sp_MSupd_dboPedidosDet]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'PedidosDet', @filter_name = N'FLTR_PedidosDet_1__77', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'PedidosDet', @view_name = N'SYNC_PedidosDet_1__77', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql', @destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic', @article = N'all', @update_mode = N'read only', @subscriber_type = 0
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql', @subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor'
<br />GO<br />
";
echo $var;    
}
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function __EXISTENCIAS1($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{
$MSSQLSERVER='$MSSQLSERVER';
$var="<br /><strong><font color='red'>-- $farmacia REPICA DE $archivo :".$nombre."</font></strong><br />
use master
exec sp_replicationdboption @dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />
exec [$base_suc].sys.sp_addlogreader_agent @job_login = N'$svr\sqladmin', @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = N'$svr\sqladmin', @job_password = null, @frompublisher = 1
<br />GO<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', @description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />
exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = N'$svr\sqladmin', @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'BUILTIN\Administradores'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\SQLServer2005SQLAgentUser$".$svr."$MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\SQLServer2005MSSQLUser$".$svr."$MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'ProductoFarma', @source_owner = N'dbo', @source_object = N'ProductoFarma', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'ProductoFarma', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboProductoFarma]', @del_cmd = N'CALL [sp_MSdel_dboProductoFarma]', @upd_cmd = N'SCALL [sp_MSupd_dboProductoFarma]', @filter_clause = N'[Farmacia] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'ProductoFarma', @filter_name = N'FLTR_ProductoFarma_1__65', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'ProductoFarma', @view_name = N'SYNC_ProductoFarma_1__65', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql', @destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic', @article = N'all', @update_mode = N'read only', @subscriber_type = 0
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql', @subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, @subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, @frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, @frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, @active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', @dts_package_location = N'Distributor'
<br />GO<br />

";
echo $var;    
}
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function __VENTAS1($farmacia,$base_suc,$svr,$nombre,$sucursal,$archivo,$date,$pass,$inicio,$fin,$interval,$destino)
{
$MSSQLSERVER='$MSSQLSERVER';
$var="<br /><strong><font color='red'>-- $farmacia REPICA DE $archivo : ".$nombre."</font></strong><br />
use master
exec sp_replicationdboption @dbname = N'$base_suc', @optname = N'publish', @value = N'true'
<br />GO<br />
exec [$base_suc].sys.sp_addlogreader_agent @job_login = N'$svr\sqladmin', @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
<br />GO<br />
exec [$base_suc].sys.sp_addqreader_agent @job_login = N'$svr\sqladmin', @job_password = null, @frompublisher = 1
<br />GO<br />
use [$base_suc]
exec sp_addpublication @publication = N'$nombre', @description = N'Publicación transaccional de la base de datos ''$base_suc'' del publicador  ''$svr''.', @sync_method = N'concurrent', @retention = 0, @allow_push = N'true', @allow_pull = N'true', @allow_anonymous = N'true', @enabled_for_internet = N'false', @snapshot_in_defaultfolder = N'true', @compress_snapshot = N'false', @ftp_port = 21, @ftp_login = N'anonymous', @allow_subscription_copy = N'false', @add_to_active_directory = N'false', @repl_freq = N'continuous', @status = N'active', @independent_agent = N'true', @immediate_sync = N'true', @allow_sync_tran = N'false', @autogen_sync_procs = N'false', @allow_queued_tran = N'false', @allow_dts = N'false', @replicate_ddl = 1, @allow_initialize_from_backup = N'false', @enabled_for_p2p = N'false', @enabled_for_het_sub = N'false'
<br />GO<br />
exec sp_addpublication_snapshot @publication = N'$nombre', @frequency_type = 1, @frequency_interval = 0, @frequency_relative_interval = 0, @frequency_recurrence_factor = 0, @frequency_subday = 0, @frequency_subday_interval = 0, @active_start_time_of_day = 0, @active_end_time_of_day = 235959, @active_start_date = 0, @active_end_date = 0, @job_login = N'$svr\sqladmin', @job_password = null, @publisher_security_mode = 0, @publisher_login = N'sa', @publisher_password = N''
exec sp_grant_publication_access @publication = N'$nombre', @login = N'sa'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'NT AUTHORITY\SYSTEM'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'BUILTIN\Administradores'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\SQLServer2005SQLAgentUser$".$svr."$MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'$svr\SQLServer2005MSSQLUser$".$svr."$MSSQLSERVER'
<br />GO<br />
exec sp_grant_publication_access @publication = N'$nombre', @login = N'distributor_admin'
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'ArticulosNegados', @source_owner = N'dbo', @source_object = N'ArticulosNegados', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'ArticulosNegados', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboArticulosNegados]', @del_cmd = N'CALL [sp_MSdel_dboArticulosNegados]', @upd_cmd = N'SCALL [sp_MSupd_dboArticulosNegados]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'ArticulosNegados', @filter_name = N'FLTR_ArticulosNegados_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'ArticulosNegados', @view_name = N'SYNC_ArticulosNegados_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'CajPag', @source_owner = N'dbo', @source_object = N'CajPag', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'CajPag', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboCajPag]', @del_cmd = N'CALL [sp_MSdel_dboCajPag]', @upd_cmd = N'SCALL [sp_MSupd_dboCajPag]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'CajPag', @filter_name = N'FLTR_CajPag_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'CajPag', @view_name = N'SYNC_CajPag_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'CancelacionFacturasPV', @source_owner = N'dbo', @source_object = N'CancelacionFacturasPV', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'CancelacionFacturasPV', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboCancelacionFacturasPV]', @del_cmd = N'CALL [sp_MSdel_dboCancelacionFacturasPV]', @upd_cmd = N'SCALL [sp_MSupd_dboCancelacionFacturasPV]', @filter_clause = N'[CodSucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'CancelacionFacturasPV', @filter_name = N'FLTR_CancelacionFacturasPV_1__68', @filter_clause = N'[CodSucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'CancelacionFacturasPV', @view_name = N'SYNC_CancelacionFacturasPV_1__68', @filter_clause = N'[CodSucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'DevolCab', @source_owner = N'dbo', @source_object = N'DevolCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'DevolCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboDevolCab]', @del_cmd = N'CALL [sp_MSdel_dboDevolCab]', @upd_cmd = N'SCALL [sp_MSupd_dboDevolCab]', @filter_clause = N'[Farmacia] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'DevolCab', @filter_name = N'FLTR_DevolCab_1__68', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'DevolCab', @view_name = N'SYNC_DevolCab_1__68', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'DevolDet', @source_owner = N'dbo', @source_object = N'DevolDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'DevolDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboDevolDet]', @del_cmd = N'CALL [sp_MSdel_dboDevolDet]', @upd_cmd = N'SCALL [sp_MSupd_dboDevolDet]', @filter_clause = N'[Farmacia] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'DevolDet', @filter_name = N'FLTR_DevolDet_1__68', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'DevolDet', @view_name = N'SYNC_DevolDet_1__68', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'DoctorNotFound', @source_owner = N'dbo', @source_object = N'DoctorNotFound', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'manual', @destination_table = N'DoctorNotFound', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboDoctorNotFound]', @del_cmd = N'CALL [sp_MSdel_dboDoctorNotFound]', @upd_cmd = N'SCALL [sp_MSupd_dboDoctorNotFound]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'DoctorNotFound', @filter_name = N'FLTR_DoctorNotFound_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'DoctorNotFound', @view_name = N'SYNC_DoctorNotFound_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'RecibidosCtaDet', @source_owner = N'dbo', @source_object = N'RecibidosCtaDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'RecibidosCtaDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboRecibidosCtaDet]', @del_cmd = N'CALL [sp_MSdel_dboRecibidosCtaDet]', @upd_cmd = N'SCALL [sp_MSupd_dboRecibidosCtaDet]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'RecibidosCtaDet', @filter_name = N'FLTR_RecibidosCtaDet_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'RecibidosCtaDet', @view_name = N'SYNC_RecibidosCtaDet_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'ValesCab', @source_owner = N'dbo', @source_object = N'ValesCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'ValesCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboValesCab]', @del_cmd = N'CALL [sp_MSdel_dboValesCab]', @upd_cmd = N'SCALL [sp_MSupd_dboValesCab]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'ValesCab', @filter_name = N'FLTR_ValesCab_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'ValesCab', @view_name = N'SYNC_ValesCab_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'ValesDet', @source_owner = N'dbo', @source_object = N'ValesDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'ValesDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboValesDet]', @del_cmd = N'CALL [sp_MSdel_dboValesDet]', @upd_cmd = N'SCALL [sp_MSupd_dboValesDet]', @filter_clause = N'[Sucursal] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'ValesDet', @filter_name = N'FLTR_ValesDet_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'ValesDet', @view_name = N'SYNC_ValesDet_1__68', @filter_clause = N'[Sucursal] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'VenCab', @source_owner = N'dbo', @source_object = N'VenCab', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'VenCab', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboVenCab]', @del_cmd = N'CALL [sp_MSdel_dboVenCab]', @upd_cmd = N'SCALL [sp_MSupd_dboVenCab]', @filter_clause = N'[Farmacia] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'VenCab', @filter_name = N'FLTR_VenCab_1__68', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'VenCab', @view_name = N'SYNC_VenCab_1__68', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'VenDatosHSA', @source_owner = N'dbo', @source_object = N'VenDatosHSA', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'VenDatosHSA', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboVenDatosHSA]', @del_cmd = N'CALL [sp_MSdel_dboVenDatosHSA]', @upd_cmd = N'SCALL [sp_MSupd_dboVenDatosHSA]', @filter_clause = N'[Farmacia] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'VenDatosHSA', @filter_name = N'FLTR_VenDatosHSA_1__68', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'VenDatosHSA', @view_name = N'SYNC_VenDatosHSA_1__68', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addarticle @publication = N'$nombre', @article = N'VenDet', @source_owner = N'dbo', @source_object = N'VenDet', @type = N'logbased', @description = N'', @creation_script = N'', @pre_creation_cmd = N'delete', @schema_option = 0x000000000803509F, @identityrangemanagementoption = N'none', @destination_table = N'VenDet', @destination_owner = N'dbo', @status = 24, @vertical_partition = N'false', @ins_cmd = N'CALL [sp_MSins_dboVenDet]', @del_cmd = N'CALL [sp_MSdel_dboVenDet]', @upd_cmd = N'SCALL [sp_MSupd_dboVenDet]', @filter_clause = N'[Farmacia] = $sucursal'
exec sp_articlefilter @publication = N'$nombre', @article = N'VenDet', @filter_name = N'FLTR_VenDet_1__68', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
exec sp_articleview @publication = N'$nombre', @article = N'VenDet', @view_name = N'SYNC_VenDet_1__68', @filter_clause = N'[Farmacia] = $sucursal', @force_invalidate_snapshot = 1, @force_reinit_subscription = 1
<br />GO<br />
use [$base_suc]
exec sp_addsubscription @publication = N'$nombre', @subscriber = N'svr-sql', 
@destination_db = N'$destino', @subscription_type = N'Push', @sync_type = N'automatic', 
@article = N'all', @update_mode = N'read only', @subscriber_type = 0
exec sp_addpushsubscription_agent @publication = N'$nombre', @subscriber = N'svr-sql', 
@subscriber_db = N'$destino', @job_login = null, @job_password = null, @subscriber_security_mode = 0, 
@subscriber_login = N'sa', @subscriber_password =N'$pass', @frequency_type = 4, @frequency_interval = 1, 
@frequency_relative_interval = 1, @frequency_recurrence_factor = 1, @frequency_subday = 4, 
@frequency_subday_interval = $interval, @active_start_time_of_day = $inicio, @active_end_time_of_day = $fin, 
@active_start_date = $date, @active_end_date = 99991231, @enabled_for_syncmgr = N'False', 
@dts_package_location = N'Distributor'
<br />GO<br />
";
echo $var;    
}
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

}