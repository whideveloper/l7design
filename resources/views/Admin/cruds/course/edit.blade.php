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
                            <h4 class="page-title">Atividades</h4>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 justify-content-end flex-nowrap">
                    @can('curso.remover')
                        <div class="col-6 ps-3">
                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.file.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>
                        </div>
                    @endcan
                    <div class="row col-6 d-flex justify-content-end me-3 p-0">
                        @can('curso.criar')
                            <div style="width: 165px">
{{--                                <a href="{{route('admin.dashboard.file.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>--}}
                                <a class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modal-file">Adicionar novo <i class="mdi mdi-plus"></i></a>

                                <div id="modal-file" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="max-width: 800px;">
                                        <div class="modal-content">
                                            <div class="modal-header p-3 pt-2 pb-2">
                                                <h4 class="page-title">Atividade</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-3 pt-0 pb-3">
                                                {!! Form::model(null, ['route' => 'admin.dashboard.file.store', 'class'=>'parsley-examples', 'files' => true]) !!}
                                                @include('Admin.cruds.file.form')
                                                {!! Form::button('Cadastrar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                                                <a href="{{route('admin.dashboard.file.index')}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
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
                            <th class="text-center">Descrição</th>
                            <th class="text-center">Data Final</th>
                            <th class="text-center">Ações</th>
                        </tr>
                        </thead>

                        <tbody id="atividade" data-route="{{route('admin.dashboard.file.sorting')}}">
                            @foreach ($course->file as $key => $file)
                                <tr data-code="{{$file->id}}">
                                    <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                    <td class="bs-checkbox">
                                        <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$file->id}}"></label>
                                    </td>
                                    <td>{{$file->title}}</td>
                                    <td>{{substr(strip_tags($file->description), 0, 100)}}</td>
                                    <td>{{Carbon\Carbon::parse($file->end_date)->format('d/m/Y')}}</td>
                                    <td>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-4">
{{--                                                <button class="btn-icon" data-bs-target="#modal-file-editt-{{$file->id}}" data-bs-toggle="modal"><i class="mdi mdi-square-edit-outline"></i></button>--}}
                                                <a href="{{route('admin.dashboard.file.edit', ['file' => $file->id])}}"><i class="btn-icon mdi mdi-square-edit-outline"></i></a>
                                            </div>
                                            <form action="{{route('admin.dashboard.file.destroy',['file' => $file->id])}}" class="col-4" method="POST">
                                                @method('DELETE') @csrf
                                                <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                {{-- BEGIN EDIT --}}
{{--                                <div id="modal-file-editt-{{$file->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">--}}
{{--                                    <div class="modal-dialog" style="max-width: 800px;">--}}
{{--                                        <div class="modal-content p-3 pt-2 pb-2">--}}
{{--                                            <div class="modal-header">--}}
{{--                                                <h4 class="page-title">Editar Atividade</h4>--}}
{{--                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                                            </div>--}}

{{--                                            {!! Form::model($file, ['route' => ['admin.dashboard.file.update', $file->id], 'class'=>'parsley-examples p-3 pt-0 pb-3', 'method' => 'PUT', 'files' => true]) !!}--}}
{{--                                            @include('Admin.cruds.file.form')--}}

{{--                                            <div class="button-btn d-flex justify-content-end col-12 p-2 m-auto mb-2">--}}
{{--                                                {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-0 width-lg align-items-right me-3', 'type' => 'submit']) !!}--}}
{{--                                                {!! Form::button('Fechar', ['class'=>'btn btn-secondary waves-effect waves-light float-end me-0 width-lg align-items-left', 'data-bs-dismiss'=> 'modal', 'type' => 'button']) !!}--}}
{{--                                            </div>--}}
{{--                                            {!! Form::close() !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                {{-- END EDIT --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var element = document.querySelector("#atividade");
            if (element) {
                element.scrollIntoView();
            }
            // Redirecionar para o âncora #atividade
            setTimeout(function() {
                window.location.href = "{{ route('admin.dashboard.course.edit', ['course' => $course]) }}#atividade";
            }, 500);
        });
    </script>
@endsection