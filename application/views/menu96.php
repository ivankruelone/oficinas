<ul class="sidebar-menu">
              <?php $id_plaza=$this->session->userdata('id_plaza');?>
                  
                  <li class="sub-menu" id="menu_mer_procesos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Procesos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_mer_procesos"><?php echo anchor('estadistica/tablas', 'TABLAS'); ?></li>
                      </ul>
                  </li>
                 
                  
              </ul>