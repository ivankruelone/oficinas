<ul class="sidebar-menu">
              <li class="sub-menu" id="menu_medicos">
                <a href="javascript:;" class="">
                    <i class="icon-book"></i>
                          <span>Medicos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_medicos"><?php echo anchor('medicos/muestra_medicos', 'Medicos Activos'); ?></li>
                          <li id="menu_medicos"><?php echo anchor('medicos/muestra_medicos_in', 'Medicos Inactivos'); ?></li>
                          <li id="menu_cedulas"><?php echo anchor('medicos/cedulas', 'Verificac&oacute;n de c&eacute;dulas'); ?></li>
                      </ul>
              </li>
</ul>
