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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.course.index')}}">Cursos</a></li>
                                    <li class="breadcrumb-item active">Editar curso</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar curso</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($course, ['route' => ['admin.dashboard.course.update', $course->slug], 'class'=>'parsley-examples position-relative', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.course.form')

                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                    <a href="{{route('admin.dashboard.course.index')}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Atividade</h4>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 justify-content-end">
                    @can('curso.remover')
                        <div class="col-6">
{{--                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.file.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>--}}
                        </div>
                    @endcan
                    <div class="row col-6 d-flex justify-content-end">
                        @can('curso.criar')
                            <div style="width: 165px">
                                <a href="{{route('admin.dashboard.file.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>
                            </div>
                        @endcan
                    </div>
                </div>
                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                    <thead class="table-light">
                    <tr>
                        <th></th>
                        <th class="bs-checkbox">
                            <label><input name="btnSelectAll" value="btnDeleteListLink" type="checkbox"></label>
                        </th>
                        <th class="text-center">Titulo</th>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    </thead>

                    <tbody data-route="{{route('admin.dashboard.file.sorting')}}">
                        @foreach ($course->file as $key => $file)
                            <tr data-code="{{$file->id}}">
                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                <td class="bs-checkbox">
                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$file->id}}"></label>
                                </td>
                                <td>{{$file->title}}</td>
                                <td>{{$file->subtitle}}</td>
                                <td>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4">
                                            <button class="btn-icon" data-bs-target="#modal-file-editt-{{$file->id}}" data-bs-toggle="modal"><i class="mdi mdi-square-edit-outline"></i></button>
                                        </div>
                                        <form action="{{route('admin.dashboard.file.destroy',['file' => $file->id])}}" class="col-4" method="POST">
                                            @method('DELETE') @csrf
                                            <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            {{-- BEGIN EDIT --}}
                            <div id="modal-file-editt-{{$file->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="max-width: 800px;">
                                    <div class="modal-content p-3 pt-2 pb-2">
                                        <div class="modal-header">
                                            <h4 class="page-title">Editar Atividade</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        {!! Form::model($file, ['route' => ['admin.dashboard.file.update', $file->id], 'class'=>'parsley-examples p-3 pt-0 pb-3', 'method' => 'PUT', 'files' => true]) !!}
                                        @include('Admin.cruds.file.form')

                                        <div class="button-btn d-flex justify-content-end col-12 p-2 m-auto mb-2">
                                            {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-0 width-lg align-items-right me-3', 'type' => 'submit']) !!}
                                            {!! Form::button('Fechar', ['class'=>'btn btn-secondary waves-effect waves-light float-end me-0 width-lg align-items-left', 'data-bs-dismiss'=> 'modal', 'type' => 'button']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            {{-- END EDIT --}}
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
