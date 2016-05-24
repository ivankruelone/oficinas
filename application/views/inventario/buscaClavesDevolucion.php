<table class="table">
    <thead>
        <tr>
            <th>Secuencia</th>
            <th>Descripcion</th>
            <th>Lote</th>
            <th>Caducidad</th>
            <th># Proveedor</th>
            <th>Proveedor</th>
            <th>Permitir Devolucion</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($query->result() as $row){ ?>
        <tr>
            <td><?php echo $row->sec; ?></td>
            <td><?php echo $row->susa1; ?></td>
            <td><?php echo $row->lote; ?></td>
            <td><?php echo $row->cadu; ?></td>
            <td><?php echo $row->prv; ?></td>
            <td><?php echo $row->razo; ?></td>
            <td><?php echo anchor('inventario/permitirDevolucion/'.$row->id, 'Permitir Devoluci&oacute;n', array('class' => 'permitir')); ?></td>
        </tr>
        <?php }?>
    </tbody>
</table>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Sec</th>
            <th>Sustancia Activa</th>
            <th>Lote</th>
            <th>Caducidad</th>
            <th>Permitir Devolucion</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($query2->result() as $row2){ ?>
        <tr>
            <td><?php echo $row2->id; ?></td>
            <td><?php echo $row2->sec; ?></td>
            <td><?php echo $row2->susa1; ?></td>
            <td><?php echo $row2->lote; ?></td>
            <td><?php echo $row2->cadu; ?></td>
            <td><?php echo anchor('inventario/permitirDevolucion2/'.$row2->id, 'Permitir Devoluci&oacute;n', array('class' => 'permitir')); ?></td>
        </tr>
        <?php }?>
    </tbody>
</table>