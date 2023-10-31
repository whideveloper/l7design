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
                                                {!! Form::model(null, ['route' => 'admin.dashboard.fileResponse.store', 'class'=>'parsley-examples', 'files' => true]) !!}
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
                            <th class="text-center">Descrição</th>
                            <th class="text-center">Data Final</th>
                            <th class="text-center">Ações</th>
                        </tr>
                        </thead>

                        <tbody id="atividade" data-route="{{route('admin.dashboard.fileResponse.sorting')}}">
                        @foreach ($file->fileResponses as $key => $fileResponse)
                            <tr data-code="{{$fileResponse->id}}">
                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                <td class="bs-checkbox">
                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$fileResponse->id}}"></label>
                                </td>
                                <td>{{$fileResponse->name}}</td>
                                <td>{{substr(strip_tags($fileResponse->description), 0, 100)}}</td>
                                <td>{{Carbon\Carbon::parse($fileResponse->end_date)->format('d/m/Y')}}</td>
                                <td>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4">
                                            {{--                                                <button class="btn-icon" data-bs-target="#modal-fileResponse-editt-{{$file->id}}" data-bs-toggle="modal"><i class="mdi mdi-square-edit-outline"></i></button>--}}
{{--                                            <a href="{{route('admin.dashboard.fileResponse.edit', ['fileResponse' => $fileResponse->id])}}"><i class="btn-icon mdi mdi-square-edit-outline"></i></a>--}}
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
