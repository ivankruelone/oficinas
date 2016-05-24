              <ul class="sidebar-menu">
              <?php $id_plaza=$this->session->userdata('id_plaza');?>
                  
                  <li class="sub-menu" id="menu_prenomina">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Prenomina</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_prenomina_a_prenomina_captura"><?php echo anchor('prenomina/a_prenomina_captura', 'Captura de prenomina'); ?></li>
                      </ul>
                  </li>
                  
                  
              </ul>