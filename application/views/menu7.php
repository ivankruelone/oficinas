              <ul class="sidebar-menu">
              <?php $id_plaza=$this->session->userdata('id_plaza');?>
                  
                  <li class="sub-menu" id="menu_catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_catalogos"><?php echo anchor('catalogos/s_cat_insumos', 'Catalogos de Insumos'); ?></li>
                          <li id="menu_catalogos_insumos"><?php echo anchor('catalogos/s_cat_permisos_insumos', 'Insumos y permisos'); ?></li>
                          
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_insumos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Insumos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                           <li id="menu_insumos_s_esp_insumos_sup_val"><?php echo anchor('insumos/s_esp_insumos_sup_val', 'Valida Pedidos Especiales(Sucursal)'); ?></li>
                      
                          <li id="menu_insumos_insumos_ctl"><?php echo anchor('insumos/s_insumos_ctl_f', 'Pedidos pendientes'); ?></li>
                          <li id="menu_insumos_insumos_e"><?php echo anchor('insumos/s_insumos_ctl_e', 'Pedidos pendientes uniformes'); ?></li>
                          <li id="menu_insumos_ctl_his_e_sec"><?php echo anchor('insumos/s_insumos_ctl_his_e_sec/1', 'Concentrado Por Articulo (Unifomes)'); ?></li>
                          <li id="menu_insumos_insumos_insumos_ctl_his_f_sec"><?php echo anchor('insumos/s_insumos_ctl_his_f_sec/1', 'Concentrado Por Articulo (Sucursales y Deptos)'); ?></li>
                          <li id="menu_insumos_insumos_insumos_ctl_his_f_sec"><?php echo anchor('insumos/s_insumos_ctl_his_f_sec/3', 'Concentrado Por Articulo (Medicos)'); ?></li>
                          
                      </ul>
                  </li>
                   <li class="sub-menu" id="menu_medicos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Medicos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_insumos_insumos_insumos_ctl_his_f_sec"><?php echo anchor('insumos/s_insumos_proceso_medicos_ver', 'Genera Pedido medicos'); ?></li>  
                          <li id="menu_Inventarios_insumos_s_inv_insumos_medicos"><?php echo anchor('insumos/s_inv_insumos_medicos', 'Inventario Insumos Sucursal'); ?></li>
                      </ul>
                  </li>
                  
                      <li class="sub-menu" id="menu_historial">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Historial</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                      <li id="menu_insumos_insumos_ctl_his"><?php echo anchor('insumos/s_insumos_ctl_his_f', 'Historico de pedidos Generales'); ?></li>
                      <li id="menu_insumos_insumos_ctl_ff"><?php echo anchor('catalogos/s_cat_insumos_his', 'Historial de Pedidos'); ?></li>
                      <li id="menu_insumos_insumos_ctl_ff"><?php echo anchor('insumos/s_insumos_ctl_his_busca', 'Historial Por articulo'); ?></li>
                        </ul>
                  </li>
                  
                 <li class="sub-menu" id="menu_inventario">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventario</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_inventario_deptos"><?php echo anchor('insumos/inventario_insumos_depto', 'Inventario de Insumos'); ?></li>
                          <li id="menu_invenratio_farmacia"><?php echo anchor('insumos/folio_devolucion','Devoluciones'); ?></li>
                          <li id="menu_invenratio_farmacia"><?php echo anchor('insumos/devolucion_insumos_hisc','Historial de devoluciones'); ?></li>
                          <li id="menu_invenratio_farmacia"><?php echo anchor('insumos/inventario_facturas', 'Facturas'); ?></li>
                          <li id="menu_invenratio_farmacia"><?php echo anchor('insumos/inventario_facturas_his', 'Historial de Facturas'); ?></li>
                        </ul>
                  </li>
                  <li class="sub-menu" id="menu_estadistica">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Estadistica</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_estadistica_venta_tic"><?php echo anchor('ventas/a_venta_tic', 'Verifica ticket'); ?></li>  
                      </ul>
                  </li>
                 
              </ul>