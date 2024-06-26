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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.stepToStep.index')}}">Passo a passo</a></li>
                                    <li class="breadcrumb-item active">Editar Passo a passo</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Passo a passo</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($stepToStep, ['route' => ['admin.dashboard.stepToStep.update', $stepToStep->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.stepToStep.form')
                    @can('passo a passo.editar')
                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.howItWork.edit', ['howItWork' => $howItWork->id])}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
