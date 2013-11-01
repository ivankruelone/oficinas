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
                          <li id="menu_Empleados_plantilla_ss"><?php echo anchor('empleados/plantilla_ss/'.$id_plaza, 'Plantilla'); ?></li>
                      </ul>
                  </li> 
                  
                  <li class="sub-menu" id="menu_ventas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ventas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ventas_ventas_cortes_succ"><?php echo anchor('ventas/ventas_cortes_succ', 'Ventas cortes Zonas'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_entradas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Entradas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_entradas_facturas_ss"><?php echo anchor('entradas/facturas_ss/0', 'Facturas '); ?></li>
                          <li id="menu_entradas_facturas_ss"><?php echo anchor('entradas/facturas_ss/1', 'Facturas Locales'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_desplazamientos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Desplazamientos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_desplazamientos_clasificacion"><?php echo anchor('desplazamientos/clasificacion', 'Clasificaci&oacute;n de Productos '); ?></li>
                      </ul>
                  </li>
                 
                  
              </ul>