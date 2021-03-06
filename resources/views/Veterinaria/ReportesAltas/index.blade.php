{{-- Titulo de la pagina --}}
@section('title', 'Altas')

{{-- Contenido principal --}}
@extends('admin.layouts.app')
@section('content')
    @component('admin.components.panel')
        @slot('title', 'Altas')

            <div id="graficas" class="hidden">
                <div class="row">
                    {!! Form::open([
                            'route' => 'admin.informes_altas.filtrar',
                            'method' => 'POST',
                            'id' => 'form_filtros',
                            'class' => 'form-horizontal form-label-left',
                            'novalidate'
                    ])!!}
                    <div class="col-xs-12">
                        @include('Veterinaria.ReportesAltas._form')

                        <div class="col-xs-12">
                            <hr/>
                        </div>
                        <canvas id="altas" height="150"></canvas>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
    @endcomponent



@endsection

{{-- Scripts necesarios para el formulario --}}
@push('scripts')
    <!-- Char js -->
    <script src="{{ asset('gentella/vendors/Chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/charts.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('gentella/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
@endpush

{{-- Estilos necesarios para el formulario --}}
@push('styles')
    <link href="{{ asset('gentella/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endpush

{{-- Funciones necesarias por el formulario --}}
@push('functions')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#estado').select2({
                language: "es"
            });
            $('#medico').select2({
                language: "es"
            });
            limite = 3;

            peticionGraficasAltas("{{ route('admin.informes_altas.datos') }}");

            var form = $('#form_filtros');
            $("#estado").change(function () {
                console.log('asssa');
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (r) {
                        ChartFiltro.destroy();
                        ChartFiltro = crearGrafica('altas', 'bar', 'Numero de Altas '+r.etiqueta, r.labels_altas,
                        ['Cantidad'], r.data_altas);
                    }
                });

            });
            $("#medico").change(function () {
                console.log('asssa');
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (r) {
                        ChartFiltro.destroy();
                        ChartFiltro = crearGrafica('altas', 'bar', 'Numero de Altas '+r.etiqueta, r.labels_altas,
                        ['Cantidad'], r.data_altas);
                    }
                });

            });
            $('#generar_reporte').on('click', function (e) {
                $("#hidden_html").val(url_base64.join('|'));
                $('#form_generar_pdf').submit();
            });

        });
    </script>
@endpush