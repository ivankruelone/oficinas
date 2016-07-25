              <ul class="sidebar-menu">
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
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_empleados">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Empleados</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_Empleados_plantilla_ss"><?php echo anchor('empleados/a_plantilla', 'Plantilla'); ?></li>
                          <li id="menu_Empleados_estatus"><?php echo anchor('empleados/estatus', 'Tiempo en Sucursal'); ?></li>
                      </ul>
                  </li>  

                  <li class="sub-menu" id="menu_ventas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ventas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ventas_s_ventas_captura_nac"><?php echo anchor('ventas/s_ventas_captura_nac', 'Ventas Capturadas_diarias'); ?></li>
                          <li id="menu_ventas_s_ventas_captura_nac"><?php echo anchor('ventas/ticket_por_mes', 'Tickets por sucursal'); ?></li>
                          <li id="menu_ventas_s_ventas_captura_nac"><?php echo anchor('ventas/a_productos_negados', 'Productos Negados'); ?></li>
                      </ul>
                  </li>
                 <li class="sub-menu" id="menu_finanzas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Finanzas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_finanzas_s_proyeccion_venta"><?php echo anchor('finanzas/s_proyeccion_v', 'Evaluacion Venta'); ?></li>  
                          <li id="menu_finanzas_s_rentabilidad_farmacia"><?php echo anchor('finanzas/s_rentabilidad_farmacia', 'Rentabilidad'); ?></li>
                          <li id="menu_finanzas_ventas_s_ventas_aaa_mes"><?php echo anchor('ventas/s_ventas_aaa_mes', 'Ventas Comparativas'); ?></li>
                          <li id="menu_finanzas_ventas_s_ventas_aaa6"><?php echo anchor('finanzas/s_ventas_aaa6', 'Ventas 6 A&ntilde;os'); ?></li>
                          <li id="menu_finanzas_a_venta_90_dias"><?php echo anchor('finanzas/a_venta_90_dias', 'Venta 90 dias'); ?></li>
                          </li>
                          <li id="menu_finanzas_a_venta_desc"><?php echo anchor('finanzas/ventas_desc', 'Tarjetas de descuento'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_evaluacion">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Evaluacion</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_evaluacion"><?php echo anchor('insumos/s_insumos_nac', 'Insumos'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_desplazamientos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Desplazamientos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_desplazamientos"><?php echo anchor('desplazamientos/a_desplaza_paquetes', 'Desplazamiento de paquetes'); ?></li>
                          <li id="menu_desplazamientos_s_desplaza_ofertas_gen"><?php echo  anchor('desplazamientos/s_desplaza_ofertas_gen', 'Desplazamiento Ofertas Catalogo DOctor Ahorro'); ?></li>
                          <li id="menu_desplazamientos_s_desplaza_ofertas_gen_in"><?php echo  anchor('desplazamientos/s_desplaza_ofertas_gen_in', 'Desplazamiento Productos con Insentivos'); ?></li>
                          <li id="menu_a_desplaza_descontinuados"><?php echo anchor('desplazamientos/a_desplaza_descontinuados', 'Desplazamiento de productos descontinuados'); ?></li>
                      </ul>
                  </li>
                 <li class="sub-menu" id="menu_examen">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Examenes</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_examen_master"><?php echo anchor('examen/master', 'Master'); ?></li>
                          <li id="menu_examen_index"><?php echo anchor('examen/index', 'Examenes'); ?></li>
                          <li id="menu_examen_resultados"><?php echo anchor('examen/resultado', 'Resultados'); ?></li>
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
                  <li class="sub-menu" id="menu_inv">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Salud para todos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_reportes"><?php echo anchor('spt/reporte', 'Consulta Salud Para Todos'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('spt/consulta_comparativo', 'Consultorios'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('spt/depositos', 'Depositos'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('spt/ejercicio', 'Ejercicio Medico'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('spt/codigo', 'Codigo de Vestir'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('spt/consultas_dia', 'Consultas y Servicios'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('spt/reporte_mensual', 'Reporte Mensual'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('spt/reporte_med_nov15', 'Reporte Medicos Noviembre 2015'); ?></li>
                      </ul>
                  </li>

                <li class="sub-menu" id="menu_checklist_evaluacion">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Checklist</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                      <li id="menu_checklist_index_evaluacion"><?php echo anchor('checklist/index_resultado', 'Resultado'); ?></li>
                      </ul> 
                </li>
                
                <li class="sub-menu" id="menu_mantenimiento">
                <a href="javascript:;" class="">
                    <i class="icon-book"></i>
                          <span>Mantenimiento</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_mantenimiento"><?php echo anchor('mantenimiento/ordenes_atendidas', 'Ordenes Atendidas'); ?></li>
                          <li id="menu_mantenimiento"><?php echo anchor('mantenimiento/reporte_ordenes_detalle', 'Reporte Ordenes Por Empleado'); ?></li>
                          <li id="menu_mantenimiento"><?php echo anchor('mantenimiento/consulta_mensual', 'Reporte Ordenes Mensual'); ?></li>
                      </ul>
              </li>
                
                <li class="sub-menu" id="menu_deuda">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Deudas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_deuda_rentas_deuda_ren"><?php echo anchor('juridico/rentas_deuda_d/2', 'Deuda de rentas '); ?></li>
                          <li id="menu_deuda_rentas_deuda_ren"><?php echo anchor('juridico/rentas_deuda_d/1', 'Deuda de rentas locales propios'); ?></li>
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