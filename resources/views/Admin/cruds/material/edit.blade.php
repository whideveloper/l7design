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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.material.index')}}">Material de apoio</a></li>
                                    <li class="breadcrumb-item active">Editar Material de apoio</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Material de apoio</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($material, ['route' => ['admin.dashboard.material.update', $material->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.material.form')
                    @can('material.editar')
                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.material.index')}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}

                
                <div class="row mb-3 col-12">
                    <div class="row col-12 d-flex align-content-center justify-content-between flex-row pe-0 mt-3">
                        <div class="page-title-box col-lg-6">
                            <h4 class="page-title">Arquivos de material</h4>
                        </div>
                        @can('material de apoio.criar')
                            <div class="pe-0 col-lg-6">                              
                                <a class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modal-materialDocument">Adicionar novo <i class="mdi mdi-plus"></i></a>

                                <div id="modal-materialDocument" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="max-width: 800px;">
                                        <div class="modal-content">
                                            <div class="modal-header p-3 pt-2 pb-2">
                                                <h4 class="page-title">Arquivo de material</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-3 pt-0 pb-3">
                                                {!! Form::model(null, ['route' => 'admin.dashboard.materialDocument.store', 'class'=>'parsley-examples', 'files' => true]) !!}
                                                @include('Admin.cruds.materialDocument.form')
                                                {!! Form::button('Cadastrar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
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
                            <th class="text-center">Titulo</th>
                            <th class="text-center">Aquivo</th>
                           <th class="text-center">Status</th>
                           <th class="text-center">Ações</th>
                        </tr>
                        </thead>

                        <tbody data-route="{{route('admin.dashboard.materialDocument.sorting')}}">
                            @foreach ($material->document as $key => $materialDocument)
                                <tr data-code="{{$materialDocument->id}}">
                                    <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                    <td class="bs-checkbox">
                                        <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$materialDocument->id}}"></label>
                                    </td>
                                    <td>{{$materialDocument->title}}</td>
                                    <td class="table-user text-center">
                                        @if ($materialDocument->path_file)
                                            <a href="{{ asset('storage/'.$materialDocument->path_file) }}" download style="color: #98a6ad; font-size:20px;">
                                                <span class="mdi mdi-download"></span>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @switch($materialDocument->active)
                                            @case(0) <span class="badge bg-danger">Inativo</span> @break
                                            @case(1) <span class="badge bg-success">Ativo</span> @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="row d-flex justify-content-center">  
                                            <a class="btn-icon mdi mdi-square-edit-outline col-3" data-bs-toggle="modal" data-bs-target="#modal-materialDocument-edit-{{$materialDocument->id}}"></a>

                                            <div id="modal-materialDocument-edit-{{$materialDocument->id}}" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" style="max-width: 800px;">
                                                    <div class="modal-content">
                                                        <div class="modal-header p-3 pt-2 pb-2">
                                                            <h4 class="page-title">Editar Arquivo de material</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-3 pt-0 pb-3">
                                                            {!! Form::model($materialDocument, ['route' => ['admin.dashboard.materialDocument.update', $materialDocument->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                                                                @include('Admin.cruds.materialDocument.form')
                                                                
                                                                {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                                                                
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                     
                                            <form action="{{route('admin.dashboard.materialDocument.destroy',['materialDocument' => $materialDocument->id])}}" class="col-3" method="POST">
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
