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
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/s_oferta_genericos', 'Productos Ofertados'); ?></li>
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/s_cat_naturistas', 'Productos Naturistas'); ?></li>
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/genericos_fenix', 'Catalogo de genericos para fenix'); ?></li>
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/cat_cambio_precio', 'Cambio de precios'); ?></li>
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/cat_bloq_codigo', 'Codigo Bloqueado Fenix'); ?></li>
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
                       <!--   <li id="menu_Empleados_c_valida_plantilla"><?php //echo anchor('empleados/c_valida_plantilla/'.$id_plaza, 'Validar Plantilla'); ?></li> -->
                      </ul>
                  </li> 
                  
                  <li class="sub-menu" id="menu_ventas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ventas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ventas_s_ventas_comparativas_historicas_nac"><?php echo anchor('ventas/s_ventas_aaa_mes', 'Ventas Comparativas'); ?></li>  
                          <li id="menu_ventas_s_descuentos_mes"><?php echo anchor('ventas/s_descuentos_mes', 'Descuentos, Optimos y Ventas'); ?></li>
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
                          <li id="menu_insumos"><?php echo anchor('pedido/s_val_pedido_ins', 'Pedido de insumos Validacion Sucursal'); ?></li>
                          <li id="menu_insumos"><?php echo anchor('insumos/s_esp_insumos_sup', 'Pedidos Especiales General'); ?></li> 
                          <li id="menu_insumos"><?php echo anchor('pedido/c_ped_esp_fanasa', 'Pedido Especial Fenix'); ?></li> 
                          <li id="menu_insumos"><?php echo anchor('pedido/s_val_pedido_ins_his', 'Historico de pedido de insumos '); ?></li>
                          <li id="menu_insumos"><?php echo anchor('pedido/s_val_pedido_ins_his_glo', 'Folios de pedidos globales'); ?></li>
                          
                          
                          
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_Inventarios">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventarios</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_Inventarios_inv_sucursal"><?php echo anchor('inventario/inv_sucursal', 'Inventario Sucursal'); ?></li>
                          <li id="menu_Inventarios_inv_sucursal"><?php echo anchor('inventario/inv_sucursal_descon', 'Inventario Sucursal Descontinuados'); ?></li>
                          <li id="menu_Inventarios_insumos_s_inv_insumos_medicos"><?php echo anchor('insumos/s_inv_insumos_medicos', 'Inventario Insumos Sucursal'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_desplazamientos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Desplazamientos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_desplazamientos_a_desplaza_paquetes"><?php echo anchor('desplazamientos/a_desplaza_paquetes', 'Desplazamiento de paquetes'); ?></li>
                          <li id="menu_desplazamientos_clasificacion"><?php echo anchor('desplazamientos/clasificacion', 'Clasificaci&oacute;n de Productos '); ?></li>
                          <li id="menu_desplazamientos_s_nivel_surtido"><?php echo  anchor('desplazamientos/s_nivel_surtido', 'Nivel de surtido'); ?></li>
                          <li id="menu_desplazamientos_a_desplaza_fenix_contado_pat"><?php echo anchor('desplazamientos/a_desplaza_fenix_contado_pat', 'Desplazamientos venta_contado'); ?></li>
                          <li id="menu_desplazamientos_s_desplaza_ofertas_gen_in"><?php echo  anchor('desplazamientos/s_desplaza_ofertas_gen_in', 'Desplazamiento Productos con Insentivos'); ?></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_evaluacion">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Checklist</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_evaluacion"><?php echo anchor('checklist/periodos', ' Checklist Pendientes '); ?></li>
                          <li id="menu_evaluacion"><?php echo anchor('checklist/periodos_evaluados', ' Checklist Evaluados '); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_fianzas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Finanzas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_fianzas_s_proyeccion_venta"><?php echo anchor('finanzas/s_proyeccion_v', 'Evaluacion Venta'); ?></li>  
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_devolucion">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Devolucion</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_devolucion_s_devolucion_ctl"><?php echo anchor('devolucion/s_devolucion_ctl', 'Devolucion'); ?></li>
                          
                      </ul>
                  </li>
                  
                  
                 
                  
              </ul>