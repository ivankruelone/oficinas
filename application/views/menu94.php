              <ul class="sidebar-menu">
              <?php $id_plaza=$this->session->userdata('id_plaza');?>
                  
                  <li class="sub-menu" id="menu_pendientes">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Pendientes</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_pendientes_activo_r"><?php echo anchor('pendientes/activo_r', 'Pendientes'); ?></li>
                          <li id="menu_pendientes"><?php echo anchor('pendientes/activo_r_val', 'Concentrado de Pendientes Liberados'); ?></li>
                      </ul>
                  </li>
                  
                  
              </ul>