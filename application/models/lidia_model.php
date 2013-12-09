
<?php
class Lidia_model extends CI_Model
{
function enlace_ftp()
{
$my_file='surc.txt';
$this->load->library('ftp');

$config['hostname'] = 'fenixcentral.homeip.net';
$config['username'] = 'nadro';
$config['password'] = 'N4dr08';
$config['debug']    = TRUE;

$this->ftp->connect($config);
$li=$this->ftp->download('/conofe.txt', './transfer/lidiaofe.txt');
}











}
?>
