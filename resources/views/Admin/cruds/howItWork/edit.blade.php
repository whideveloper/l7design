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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.howItWork.index')}}">Como Funciona</a></li>
                                    <li class="breadcrumb-item active">Editar Como Funciona</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Como Funciona</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($howItWork, ['route' => ['admin.dashboard.howItWork.update', $howItWork->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.howItWork.form')
                    @can('como funciona.editar')
                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.howItWork.index')}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}

                <div class="row mb-3 col-12">
                    <div class="row col-12 d-flex align-content-center justify-content-between flex-row pe-0 mt-3">
                        <div class="page-title-box col-lg-6">
                            <h4 class="page-title">Passo a passo</h4>
                        </div>
                        @can('passo a passo.criar')
                            <div class="pe-0 col-lg-6">
                                @if ($stepToSteps->count() < 4)                                
                                    <a class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modal-stepToStep">Adicionar novo <i class="mdi mdi-plus"></i></a>
                                @endif

                                <div id="modal-stepToStep" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="max-width: 800px;">
                                        <div class="modal-content">
                                            <div class="modal-header p-3 pt-2 pb-2">
                                                <h4 class="page-title">Passo a passo</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-3 pt-0 pb-3">
                                                {!! Form::model(null, ['route' => 'admin.dashboard.stepToStep.store', 'class'=>'parsley-examples', 'files' => true]) !!}
                                                @include('Admin.cruds.stepToStep.form')
                                                {!! Form::button('Cadastrar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                                                <a href="{{route('admin.dashboard.howItWork.edit', ['howItWork' => $howItWork])}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Cancelar</a>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
                
                <div class="row pe-3">
                    <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th class="bs-checkbox">
                                    <label><input name="btnSelectAll" value="btnDeleteListLink" type="checkbox"></label>
                                </th>
                                <th class="text-center">Ordem</th>
                                <th class="text-center">Texto</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody id="atividade" data-route="{{route('admin.dashboard.stepToStep.sorting')}}">
                            @foreach ($stepToSteps as $key => $stepToStep)
                                <tr data-code="{{$stepToStep->id}}">
                                    <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                    <td class="bs-checkbox">
                                        <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$stepToStep->id}}"></label>
                                    </td>
                                    <td>{{$stepToStep->ordem}}</td>
                                    <td>{{substr(strip_tags($stepToStep->text), 0, 180)}}...</td>
                                    <td class="text-center">
                                        @switch($stepToStep->active)
                                            @case(0) <span class="badge bg-danger">Inativo</span> @break
                                            @case(1) <span class="badge bg-success">Ativo</span> @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="row d-flex justify-content-center">  
                                            <a class="btn-icon mdi mdi-square-edit-outline col-3" data-bs-toggle="modal" data-bs-target="#modal-stepToStep-edit-{{$stepToStep->id}}"></a>

                                            <div id="modal-stepToStep-edit-{{$stepToStep->id}}" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" style="max-width: 800px;">
                                                    <div class="modal-content">
                                                        <div class="modal-header p-3 pt-2 pb-2">
                                                            <h4 class="page-title">Passo a passo</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-3 pt-0 pb-3">
                                                            {!! Form::model($stepToStep, ['route' => ['admin.dashboard.stepToStep.update', $stepToStep->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                                                                @include('Admin.cruds.stepToStep.form')
                                                                @can('Passo a passo.editar')
                                                                {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                                                                @endcan
                                                                <a href="{{route('admin.dashboard.howItWork.edit',['howItWork' => $howItWork->id])}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                     
                                            <form action="{{route('admin.dashboard.stepToStep.destroy',['stepToStep' => $stepToStep->id])}}" class="col-3" method="POST">
                                                @method('DELETE') @csrf
                                                <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
