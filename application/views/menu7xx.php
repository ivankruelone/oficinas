              <ul class="sidebar-menu">
              <?php $id_plaza=$this->session->userdata('id_plaza');?>
                  
                  <li class="sub-menu" id="menu_mer_reporte">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Reportes</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_mer_reporte_prom_sup"><?php echo anchor('reportes/ventas_iva', 'Ventas sin iva'); ?></li>
                      </ul>
                  </li>
                 
                  
              </ul>