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
                          <li id="menu_catalogos_genericos_oferta"><?php echo anchor('catalogos/genericos_oferta', 'Ofertas para Doctor Ahorro'); ?></li>
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
                          <li id="menu_ventas_ventas_cortes_succ"><?php echo anchor('ventas/s_ventas_cortes_succ', 'Ventas cortes Zonas'); ?></li>
                          <li id="menu_ventas_s_ventas_compara_mes"><?php echo anchor('ventas/s_ventas_compara_mes', 'Ventas Comparativo'); ?></li>
                          <li id="menu_ventas_s_ventas_capturadas"><?php echo anchor('ventas/s_ventas_capturadas', 'Ventas Capturadas'); ?></li>
                          <li id="menu_ventas_s_ventas_comparativas_historicas"><?php echo anchor('ventas/s_ventas_comparativas_historicas', 'Ventas Historicas'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_recursos_humanos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Movimientos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_recursos_humanos_s_cap_mov"><?php echo anchor('recursos_humanos/s_cap_mov', 'Cap.Movimientos'); ?></li>
                          <li id="menu_recursos_humanos_s_cap_mov_his"><?php echo anchor('recursos_humanos/s_cap_mov_his', 'Movimientos Capturados'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_insumos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Pedido</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_insumos"><?php echo anchor('pedido/s_val_pedido_ins', 'Pedido de insumos '); ?></li>
                          <li id="menu_insumos"><?php echo anchor('pedido/s_val_pedido_ins_his', 'Histoeico de pedido de insumos '); ?></li>
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
                          <li id="menu_entradas_facturas_ss"><?php echo anchor('entradas/gastos', 'Gastos x Sucursal'); ?></li>
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
                          <li id="menu_desplazamientos_s_nivel_surtido"><?php echo  anchor('desplazamientos/s_nivel_surtido', 'Nivel de surtido'); ?></li>
                      </ul>
                  </li>
                  
                  
                 
                  
              </ul>