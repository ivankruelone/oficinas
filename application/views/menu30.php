              <ul class="sidebar-menu">
                  <li class="sub-menu" id="menu_insumos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Insumos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_insumos_insumos_ctl"><?php echo anchor('insumos/s_insumos_ctl_cont', 'Pedidos pendientes Contrataciones'); ?></li>
                          <?php if((date('Y') >= 2015 && date('m') >= 10)||(date('Y') >= 2016 && date('m') >= 1)){?>
                          <li id="menu_insumos_insumos_ctl"><?php echo anchor('insumos/s_insumos_ctl_extra', 'Pedidos pendientes Uniformes'); ?></li>
                          <?php } ?>
                          <li id="menu_insumos_insumos_ctl"><?php echo anchor('insumos/s_insumos_ctl', 'Pedidos pendientes sucursales y Deptos'); ?></li>
                          <li id="menu_insumos_insumos_ctl"><?php echo anchor('insumos/s_insumos_ctl_med', 'Pedidos pendientes Medicos'); ?></li>
                          <li id="menu_insumos_insumos_ctl_his"><?php echo anchor('insumos/s_insumos_ctl_his', 'Pedidos cerrados'); ?></li>
                          <li id="menu_insumos_insumos_ctl_his"><?php echo anchor('insumos/s_insumos_cont_his', 'Pedidos Contrataciones cerrados'); ?></li>
                          <?php if((date('Y') >= 2015 && date('m') >= 10)||(date('Y') >= 2016 && date('m') >= 1)){?>
                          <li id="menu_insumos_insumos_ctl_his"><?php echo anchor('insumos/s_insumos_extra_his', 'Pedidos Cerrados Uniformes'); ?></li>
                          <?php } ?>
                  
                          </ul>
                  </li>
                          <?php
	                          if($this->session->userdata('id') == 126){
                          ?>
                          <li class="sub-menu" id="menu_medicos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Medicos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                               <li id="menu_Inventarios_insumos_s_inv_insumos_medicos"><?php echo anchor('insumos/s_inv_insumos_medicos', 'Inventario Insumos Sucursal'); ?></li>
                      </ul>
                      </li>
                        <?php
	                      }
                       ?>
              </ul>