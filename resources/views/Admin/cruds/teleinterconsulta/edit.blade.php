@extends('Admin.core.admin')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.teleinterconsulta.index')}}">Teleinterconsulta</a></li>
                                    <li class="breadcrumb-item active">Editar Teleinterconsulta</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Teleinterconsulta</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($teleinterconsulta, ['route' => ['admin.dashboard.teleinterconsulta.update', $teleinterconsulta->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.teleinterconsulta.form')
                    @can('teleinterconsulta.editar')
                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.teleinterconsulta.index')}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
