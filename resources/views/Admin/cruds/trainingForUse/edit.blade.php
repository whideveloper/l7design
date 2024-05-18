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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.trainingForUse.index')}}">Treinamento da plataforma</a></li>
                                    <li class="breadcrumb-item active">Editar Treinamento da plataforma</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Treinamento da plataforma</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($trainingForUse, ['route' => ['admin.dashboard.trainingForUse.update', $trainingForUse->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.trainingForUse.form')
                    @can('treinamento.editar')
                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light mb-3 float-end width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.trainingForUse.index')}}" class="btn btn-secondary mb-3 waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}
                
                @can('treinamento.visualizar')
                    <div class="card card-body col-12">
                        <h4 class="page-title mobile">Arquivos de treinamento</h4>
                        
                        <div class="col-12">
                            @can('treinamento.criar')                             
                                <a class="btn btn-success float-end bt-mobile" style="max-width: 160px" data-bs-toggle="modal" data-bs-target="#modal-training">Adicionar novo <i class="mdi mdi-plus"></i></a>
        
                                <div id="modal-training" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="max-width: 800px;">
                                        <div class="modal-content">
                                            <div class="modal-header p-3 pt-2 pb-2">
                                                <h4 class="page-title">Arquivo de treinamento</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-3 pt-0 pb-3">
                                                {!! Form::model(null, ['route' => 'admin.dashboard.training.store', 'class'=>'parsley-examples', 'files' => true]) !!}
                                                @include('Admin.cruds.training.form')
                                                {!! Form::button('Cadastrar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="card card-body">
                        <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">

                            <thead class="table-light">
                            <tr>
                                <th></th>
                                {{-- <th class="bs-checkbox">
                                    <label><input name="btnSelectAll" value="btnDeleteListLink" type="checkbox"></label>
                                </th> --}}
                                <th class="text-center">Nome do botão</th>
                                <th class="text-center">Link/Aquivo</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Ações</th>
                            </tr>
                            </thead>

                            <tbody data-route="{{route('admin.dashboard.training.sorting')}}">
                                @foreach ($trainings as $key => $training)
                                    <tr data-code="{{$training->id}}">
                                        <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                        {{-- <td class="bs-checkbox">
                                            <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$training->id}}"></label>
                                        </td> --}}
                                        <td>{{$training->btn_title}}</td>
                                        <td class="table-user text-center">
                                            @if ($training->path_file)
                                                <a href="{{ asset('storage/'.$training->path_file) }}" download style="color: #98a6ad; font-size:20px;">
                                                    <span class="mdi mdi-download"></span>
                                                </a>
                                            @endif
                                            @if ($training->link_vimeo)                                                
                                                <a href="{{$training->link_vimeo}}" target="_blank" rel="noopener noreferrer" style="color: #98a6ad; font-size:20px;">
                                                    <span class="mdi mdi-link-variant"></span>
                                                </a>                                                    
                                            @endif
                                            @if($training->link_youtube)
                                                <a href="{{$training->link_youtube}}" target="_blank" rel="noopener noreferrer" style="color: #98a6ad; font-size:20px;">
                                                    <span class="mdi mdi-link-variant"></span>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @switch($training->active)
                                                @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                @case(1) <span class="badge bg-success">Ativo</span> @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="row d-flex justify-content-center">
                                                @can('treinamento.editar')                                                    
                                                    <a class="btn-icon mdi mdi-square-edit-outline col-3" data-bs-toggle="modal" data-bs-target="#modal-training-edit-{{$training->id}}"></a>
                                                @endcan  

                                                <div id="modal-training-edit-{{$training->id}}" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog" style="max-width: 800px;">
                                                        <div class="modal-content">
                                                            <div class="modal-header p-3 pt-2 pb-2">
                                                                <h4 class="page-title">Especialista</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body p-3 pt-0 pb-3">
                                                                {!! Form::model($training, ['route' => ['admin.dashboard.training.update', $training->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                                                                    @include('Admin.cruds.training.form')
                                                                    @can('treinamento.editar')
                                                                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end width-lg', 'type' => 'submit']) !!}
                                                                    @endcan
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                                @can('treinamento.remover')                                                    
                                                    <form action="{{route('admin.dashboard.training.destroy',['training' => $training->id])}}" class="col-3" method="POST">
                                                        @method('DELETE') @csrf
                                                        <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                                    </form>
                                                @endcan                                 
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endcan
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
