{{-- Titulo de la pagina --}}
@section('title', 'Gestionar Estado Paciente')

{{-- Contenido principal --}}
@extends('admin.layouts.app')

@section('content')
    @component('admin.components.panel')
        @slot('title', 'Gestionar Estado Paciente')
        @can('VER_ESTADOS')
            <div class="col-md-12">
                @component('admin.components.datatable', ['id' => 'estados-table-ajax']) @slot('columns', [ 'id','Animal','Responsable', 'Medico Tratante','Diagnostico','Estado',
    'Acciones' => ['style' => 'width:60px;'] ]) @endcomponent

            </div>
            @endcomponent
        @endcan
@endsection

{{-- Scripts necesarios para el formulario --}}
@push('scripts')
    <!-- Datatables -->
    <script src="{{asset('gentella/vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{asset('gentella/vendors/sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- PNotify -->
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>

@endpush

{{-- Estilos necesarios para el formulario --}}
@push('styles')
    <!-- Datatables -->
    <link href="{{ asset('gentella/vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">

@endpush

{{-- Funciones necesarias por el formulario --}}
@push('functions')
    <script type="text/javascript">
        $(document).ready(function () {
            let sesion = sessionStorage.getItem("update");
            console.log(sesion);
            if (sesion != null) {
                sessionStorage.clear();
                new PNotify({
                    title: "Datos Modificados!",
                    text: sesion,
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
            table = $('#estados-table-ajax').DataTable({
                processing: true,
                serverSide: false,
                stateSave: true,
                keys: true,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                "ajax": "{{ route('admin.estados.data') }}",
                "columns": [
                    {data: 'pk_id_epicrisis', name: 'id', "visible": false},
                    {data: 'animal.nombre', name: 'Animal', className: "min-phone-l"},
                    {data: 'Responsable', name: 'Responsable', className: "desktop"},
                    {data: 'Medico', name: 'Medico Tratante', className: "desktop"},
                    {data: 'diagnostico', name: 'Diagnostico', className: "desktop"},
                    {data: 'estado.estado', name: 'Estado', className: "min-tablet-l"},
                    {
                        defaultContent:
                            '@can('MODIFICAR_ESTADOS')<a href="javascript:;" class="btn btn-simple btn-info btn-sm edit" data-toggle="confirmation"><i class="fas fa-edit"></i></a>@endcan',
                        data: 'action',
                        name: 'action',
                        title: 'Acciones',
                        orderable: false,
                        searchable: false,
                        exportable: false,
                        printable: false,
                        className: 'text-right',
                        render: null,
                        responsivePriority: 2
                    }
                ],
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                initComplete: function () {
                    this.api().columns([2, 3, 5]).every(function () {
                        var column = this;
                        var select = $('<select style="width: 100px;"><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                    });
                }
            });

            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var route = '{{ url('estados/') }}' + '/' + dataTable.pk_id_epicrisis + '/edit';
                window.location.href = route; 


            });
        });

    </script>

@endpush