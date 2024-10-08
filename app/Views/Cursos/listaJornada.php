<div class="table-responsive text-nowrap">
    <table class="table" id="tablaJornada">
        <thead>
            <tr>
                <th>N</th>
                <th>Jornada</th>
                <th><center>Acciones</center></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($listaJornada) { ?>
                <?php $i = 1;
                foreach ($listaJornada as $data) { ?>
                    <tr>
                        <td>
                            <?php echo $i;
                            $i++; ?>
                        </td>
                        <td><?= $data->tipoJornada; ?></td>
                        <td>
                        <center>
                                <button type="button" class="btn btn-icon btn-outline-secondary "  onclick="gestionJornada(this);" title="Editar Registro" data-accion="editarRegistro" data-id="<?php echo $data->idJornada; ?>">
                                    <span class="tf-icons bx bx-edit-alt me-1"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-outline-primary" onclick="gestionJornada(this);" title="Eliminar Registro" data-accion="eliminarRegistro" data-id="<?php echo $data->idJornada; ?>">
                                    <span class="tf-icons bx bx-trash me-1" ></span>
                                </button>
                            </center>
                        </td>
                    </tr>
                <?php
                } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3" class="text-center">No hay datos</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- DataTables -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaJornada').DataTable({
            dom: "<'row'<'col-sm-5'B><'col-sm-3'l><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="bx bxs-copy-alt"></i>',
                    className: 'btn btn-outline-secondary',
                    titleAttr: 'Copiar'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="bx bxs-file"></i>',
                    className: 'btn btn-outline-secondary',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="bx bxs-file-pdf"></i>',
                    className: 'btn btn-outline-secondary',
                    titleAttr: 'PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="bx bx-printer" ></i>',
                    className: 'btn btn-outline-primary',
                    titleAttr: 'Imprimir',
                    autoPrint: false
                }
            ],
            autoWidth: false,
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
            }
        });
    });
</script>