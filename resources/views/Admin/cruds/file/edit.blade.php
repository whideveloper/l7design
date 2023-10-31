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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.course.edit',['course'=>$course->slug])}}">Atividades</a></li>
                                    <li class="breadcrumb-item active">Editar Atividade</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Atividade</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($file, ['route' => ['admin.dashboard.file.update', $file->id], 'class'=>'parsley-examples position-relative', 'method' => 'PUT', 'files' => true]) !!}
                @include('Admin.cruds.file.form')

                {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                <a href="{{route('admin.dashboard.course.edit',['course'=>$course->slug])}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Atividades respondidas</h4>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 justify-content-end flex-nowrap">
                    @can('curso.remover')
                        <div class="col-6 ps-3">
{{--                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.fileResponse.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>--}}
                        </div>
                    @endcan
                    <div class="row col-6 d-flex justify-content-end me-3 p-0">
                        @can('curso.criar')
                            <div style="width: 165px">
                                {{--                                <a href="{{route('admin.dashboard.file.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>--}}
                                <a class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modal-fileResponse">Adicionar novo <i class="mdi mdi-plus"></i></a>

                                <div id="modal-fileResponse" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="max-width: 800px;">
                                        <div class="modal-content">
                                            <div class="modal-header p-3 pt-2 pb-2">
                                                <h4 class="page-title">Atividade Respondida</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-3 pt-0 pb-3">
                                                {!! Form::model(null, ['route' => 'admin.dashboard.response.store', 'class'=>'parsley-examples', 'files' => true]) !!}
                                                @include('Admin.cruds.fileResponse.form')
                                                {!! Form::button('Cadastrar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                                                <a href="{{route('admin.dashboard.file.edit', ['file' => $file])}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Cancelar</a>
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
                            <th class="text-center">Aluno</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Respondido em</th>
{{--                            <th class="text-center">Status</th>--}}
                            <th class="text-center">Baixar atividade</th>
                        </tr>
                        </thead>

                        <tbody id="atividade" data-route="{{route('admin.dashboard.response.sorting')}}">
                        @foreach ($fileResponses as $key => $response)
                                <tr data-code="{{$response->id}}">
                                    <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                    <td class="bs-checkbox">
                                        <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$response->id}}"></label>
                                    </td>
                                    <td>{{$response->name}}</td>
                                    <td>{{$response->email}}</td>
                                    <td>{{Carbon\Carbon::parse($response->created_at)->format('d/m/Y')}}</td>
{{--                                    <td>--}}
{{--                                        @switch($response->adjusted)--}}
{{--                                            @case(0) <span class="badge bg-danger">Não corrigido</span> @break--}}
{{--                                            @case(1) <span class="badge bg-success">Corrigido</span> @break--}}
{{--                                        @endswitch--}}
{{--                                    </td>--}}
                                    <td>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-4">
{{--                                                <button class="btn-icon" data-bs-target="#modal-fileResponse-editt-{{$response->id}}" data-bs-toggle="modal"><i class="mdi mdi-square-edit-outline"></i></button>--}}
{{--                                                <div id="modal-fileResponse-editt-{{$response->id}}" class="modal fade" tabindex="-1" response="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">--}}
{{--                                                    <div class="modal-dialog" style="max-width: 800px;">--}}
{{--                                                        <div class="modal-content">--}}
{{--                                                            <div class="modal-header p-3 pt-2 pb-2">--}}
{{--                                                                <h4 class="page-title">Definir Status</h4>--}}
{{--                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="modal-body p-3 pt-0 pb-3">--}}
{{--                                                                {!! Form::model($response, ['route' => ['admin.dashboard.response.update', $response->file_id], 'class'=>'parsley-examples position-relative', 'method' => 'PUT', 'files' => true]) !!}--}}
{{--                                                                    <input type="hidden" name="course_id" value="{{$course->id}}">--}}
{{--                                                                    <input type="hidden" name="file_id" value="{{$file->id}}">--}}
{{--                                                                    <input type="hidden" name="student_id" value="3">--}}
{{--                                                                    <div class="row mb-3">--}}
{{--                                                                        <div class="col-lg-6">--}}
{{--                                                                            {!! Form::label(null, 'Aluno', ['class'=>'form-label d-flex justify-content-start']) !!}--}}
{{--                                                                            {!! Form::text(null, $response->name, ['class'=>'form-control', 'id'=>'validationCustom01', 'readonly']) !!}--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="col-lg-6 justify-content-start">--}}
{{--                                                                            {!! Form::label(null, 'E-mail', ['class'=>'form-label d-flex justify-content-start']) !!}--}}
{{--                                                                            {!! Form::text(null, $response->name, ['class'=>'form-control', 'id'=>'validationCustom01', 'readonly']) !!}--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="mb-3">--}}
{{--                                                                        {!! Form::label(null, 'Respondido em', ['class'=>'form-label d-flex justify-content-start']) !!}--}}
{{--                                                                        <div class="input__date">--}}
{{--                                                                            <input type="input" readonly placeholder="{{Carbon\Carbon::parse($response->created_at)->format('d/m/Y')}}">--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="col-12 col-lg-12">--}}
{{--                                                                        <div class="card card-body">--}}
{{--                                                                            <div class="mb-3 col-lg-12">--}}
{{--                                                                                {!! Form::label('file', 'Anexar atividade', ['class'=>'form-label text-start d-flex']) !!}--}}
{{--                                                                                {!! Form::file('path_file', [--}}
{{--                                                                                    'data-plugins'=>'dropify',--}}
{{--                                                                                    'data-height'=>'200',--}}
{{--                                                                                    'data-max-file-size-preview'=>'2M',--}}
{{--                                                                                    'accept'=>'image/*',--}}
{{--                                                                                    'data-default-file'=> isset($response)?$response->path_file<>''?url('storage/'.$response->path_file):'':'',--}}
{{--                                                                                ]) !!}--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="mb-3 justify-content-start d-flex gap-1">--}}
{{--                                                                        {!! Form::checkbox('adjusted', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}--}}
{{--                                                                        {!! Form::label('adjusted', 'Atividade corrigida?', ['class'=>'form-check-label']) !!}--}}
{{--                                                                    </div>--}}

{{--                                                                {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}--}}
{{--                                                                <a href="{{route('admin.dashboard.file.edit', ['file' => $file->id])}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Cancelar</a>--}}
{{--                                                                {!! Form::close() !!}--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <a href="{{asset('storage/'.$response->path_file)}}" download><i class="btn-icon mdi mdi-download"></i></a>
                                            </div>
    {{--                                        <form action="{{route('admin.dashboard.fileResponse.destroy',['fileResponse' => $fileResponse->id])}}" class="col-4" method="POST">--}}
    {{--                                            @method('DELETE') @csrf--}}
    {{--                                            <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>--}}
    {{--                                        </form>--}}
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
