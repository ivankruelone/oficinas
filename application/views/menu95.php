              <ul class="sidebar-menu">
              <?php $id_plaza=$this->session->userdata('id_plaza');?>
                  
                    <li class="sub-menu" id="menu_inv">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>P&L</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_reportes"><?php echo anchor('pl/captura_reporte_pl', 'Captura Sucursal'); ?></li>
                      </ul>
                    </li>     
                  
                  
                 
                  
              </ul>