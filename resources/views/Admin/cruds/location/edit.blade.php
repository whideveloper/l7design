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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.location.index')}}">Localização</a></li>
                                    <li class="breadcrumb-item active">Editar Localização</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Localização</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($location, ['route' => ['admin.dashboard.location.update', $location->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.location.form')
                    @can('localizacao.editar')
                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.location.index')}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}

                <div class="row mb-3 col-12">
                    <div class="row col-12 d-flex align-content-center justify-content-between flex-row pe-0 mt-3">
                        <div class="page-title-box col-lg-6">
                            <h4 class="page-title">Objetivos específicos</h4>
                        </div>
                        @can('objetivo.criar')
                            <div class="pe-0 col-lg-6">
                                @if ($objectives->count() < 4)                                
                                    <a class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modal-objective">Adicionar novo <i class="mdi mdi-plus"></i></a>
                                @endif

                                <div id="modal-objective" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="max-width: 800px;">
                                        <div class="modal-content">
                                            <div class="modal-header p-3 pt-2 pb-2">
                                                <h4 class="page-title">Objetivo</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-3 pt-0 pb-3">
                                                {!! Form::model(null, ['route' => 'admin.dashboard.objective.store', 'class'=>'parsley-examples', 'files' => true]) !!}
                                                @include('Admin.cruds.objective.form')
                                                {!! Form::button('Cadastrar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                                                <a href="{{route('admin.dashboard.location.edit', ['location' => $location])}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Cancelar</a>
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
                            <th class="text-center">Título</th>
                            <th class="text-center">Imagem</th>
                           <th class="text-center">Status</th>
                           <th class="text-center">Ações</th>
                        </tr>
                        </thead>

                        <tbody id="atividade" data-route="{{route('admin.dashboard.objective.sorting')}}">
                            @foreach ($objectives as $key => $objective)
                                <tr data-code="{{$objective->id}}">
                                    <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                    <td class="bs-checkbox">
                                        <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$objective->id}}"></label>
                                    </td>
                                    <td>{{$objective->title}}</td>
                                    <td class="table-user text-center">
                                        @if ($objective->path_image)
                                            <img src="{{ asset('storage/'.$objective->path_image) }}" name="path_image" alt="table-user" class="me-2 rounded-circle">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @switch($objective->active)
                                            @case(0) <span class="badge bg-danger">Inativo</span> @break
                                            @case(1) <span class="badge bg-success">Ativo</span> @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="row d-flex justify-content-center">  
                                            <a class="btn-icon mdi mdi-square-edit-outline col-3" data-bs-toggle="modal" data-bs-target="#modal-objective-edit-{{$objective->id}}"></a>

                                            <div id="modal-objective-edit-{{$objective->id}}" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" style="max-width: 800px;">
                                                    <div class="modal-content">
                                                        <div class="modal-header p-3 pt-2 pb-2">
                                                            <h4 class="page-title">Objetivo</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-3 pt-0 pb-3">
                                                            {!! Form::model($objective, ['route' => ['admin.dashboard.objective.update', $objective->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                                                                @include('Admin.cruds.objective.form')
                                                                @can('objetivo.editar')
                                                                {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                                                                @endcan
                                                                <a href="{{route('admin.dashboard.location.edit',['location' => $location->id])}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                     
                                            <form action="{{route('admin.dashboard.objective.destroy',['objective' => $objective->id])}}" class="col-3" method="POST">
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
