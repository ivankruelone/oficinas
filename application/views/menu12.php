              <ul class="sidebar-menu">
              <?php $id_plaza=$this->session->userdata('id_plaza');?>
                  <li class="sub-menu" id="menu_catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/genericos_venta', 'Genericos'); ?></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_empleados">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Empleados</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_Empleados_plantilla_s"><?php echo anchor('empleados/plantilla_s/'.$id_plaza, 'Plantilla'); ?></li>
                      </ul>
                  </li>  
  
                  <li class="sub-menu" id="menu_ventas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ventas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ventas_ventas_cortes_sup"><?php echo anchor('ventas/ventas_cortes_sup', 'Ventas cortes Sucursal'); ?></li>
                      </ul>
                  </li>
                   <li class="sub-menu" id="menu_entradas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Entradas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_entradas_facturas_gg"><?php echo  anchor('entradas/facturas_gg/0', 'Facturas '); ?></li>
                          <li id="menu_entradas_facturas_gg"><?php echo  anchor('entradas/facturas_gg/1', 'Facturas Locales'); ?></li>
                          
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_mer_reporte">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Reportes</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_mer_reporte_prom_ger"><?php echo anchor('reportes/mer_reporte_prom_ger', 'Claves en promocion'); ?></li>
                      </ul>
                  </li>
               
                  
              </ul>