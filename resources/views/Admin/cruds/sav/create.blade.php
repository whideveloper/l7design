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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.sav.index')}}">Sav</a></li>
                                    <li class="breadcrumb-item active">Cadastro da Sessão Sav</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Cadastro da Sessão Sav</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model(null, ['route' => 'admin.dashboard.sav.store', 'class'=>'parsley-examples', 'files' => true]) !!}
                    @include('Admin.cruds.sav.form')
                    @can('sav.criar')
                    {!! Form::button('Cadastrar', ['class'=>'btn btn-primary waves-effect waves-light float-end width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.sav.index')}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
