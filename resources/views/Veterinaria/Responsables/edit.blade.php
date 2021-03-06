{{-- Titulo de la pagina --}}
@section('title', 'Responsables')

{{-- Contenido principal --}}
@extends('admin.layouts.app')
@section('content') 
@component('admin.components.panel') 
@slot('title', 'Modificar Responsables')
{!! Form::model($responsables, [ 'route' => ['admin.responsables.update', $responsables], 'method' => 'PUT', 'id' => 'form_modificar_responsables',
'class' => 'form-horizontal form-label-lef', 'novalidate' ])!!}
@include('Veterinaria.Responsables._form')
<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-md-offset-3">
        {{ link_to_route('admin.responsables.index',"Cancelar", [], ['class' => 'btn btn-info']) }} {!! Form::submit('Modificar Responsables',
        ['class' => 'btn btn-success']) !!}
    </div>
</div>
{!! Form::close() !!} @endcomponent
@endsection

{{-- Estilos necesarios para el formulario --}}
@push('styles')
    <!-- PNotify -->
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('gentella/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('gentella/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endpush

{{-- Scripts necesarios para el formulario --}}
@push('scripts')
    <script src="{{ asset('js/admin.js') }}"></script>
    <!-- validator -->
    <script src="{{ asset('gentella/vendors/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/parsleyjs/i18n/es.js') }}"></script>
    <!-- PNotify -->
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('gentella/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('gentella/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('gentella/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

@endpush

{{-- Funciones necesarias por el formulario --}}
@push('functions')
    <script type="text/javascript">
        $(document).ready(function () {
            var form = $('#form_modificar_responsables');
            $(form).parsley({
                trigger: 'change',
                successClass: "has-success",
                errorClass: "has-error",
                classHandler: function (el) {
                    return el.$element.closest('.form-group');
                },
                errorsWrapper: '<p class="help-block help-block-error"></p>',
                errorTemplate: '<span></span>',
            });
            form.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    Accept: 'application/json',
                    success: function (response, NULL, jqXHR) {
                        sessionStorage.setItem('update', 'Los datos se han modificado exitosamente.');
                        window.location.href = " {{ route('admin.responsables.index')}} ";
                    },
                    error: function (data) {
                        console.log(data);
                        var errores = data.responseJSON.errors;
                        var msg = '';
                        $.each(errores, function (name, val) {
                            msg += val + '<br>';
                        });
                        new PNotify({
                            title: "Error!",
                            text: msg,
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                    }
                });
            });
        });
    </script>
@endpush
