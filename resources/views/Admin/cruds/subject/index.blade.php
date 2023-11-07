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
                                    <li class="breadcrumb-item active">Disciplinas</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Disciplinas</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3 justify-content-between">
                                    @can('disciplina.remover')
                                        <div class="col-6">
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.subject.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>
                                        </div>
                                    @endcan
                                    <div class="row col-6 d-flex justify-content-end">
                                        <div style="width: 240px">
{{--                                            @can('disciplina.restaurar dados')--}}
{{--                                                @if ($subjectsDeleted_at)--}}
{{--                                                    <a href="{{route('admin.dashboard.subject.show')}}" class="btn btn-primary float-end">Restaurar regitro(s) <i class="mdi mdi-delete-restore"></i></a>--}}
{{--                                                @endif--}}
{{--                                            @endcan--}}

                                        </div>
                                        @can('disciplina.criar')
                                            <div style="width: 165px">
                                                <a href="{{route('admin.dashboard.subject.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                                    <thead class="table-light">
                                        <tr>
                                            <th></th>
                                            <th class="bs-checkbox">
                                                <label><input name="btnSelectAll" type="checkbox"></label>
                                            </th>
                                            <th>Disciplina</th>
                                            <th>Professor</th>
                                            <th>Status</th>
                                            <th>Imagem</th>
                                            <th>Ações</th>
                                            <th>Alunos</th>
                                        </tr>
                                    </thead>

                                    <tbody data-route="{{route('admin.dashboard.subject.sorting')}}">
                                        @foreach ($subjects as $key => $subject)
                                            <tr data-code="{{$subject->id}}">
                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$subject->id}}"></label>
                                                </td>
                                                <td>{{$subject->name}}</td>
                                                <td>{{$subject->userId->name}}</td>
                                                <td>
                                                    @switch($subject->active)
                                                        @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                        @case(1) <span class="badge bg-success">Ativo</span> @break
                                                    @endswitch
                                                </td>
                                                <td class="table-user text-center">
                                                    @if ($subject->path_image)
                                                        <img src="{{ asset('storage/'.$subject->path_image) }}" name="Imagem" alt="table-user" class="me-2 rounded-circle">
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="row justify-content-start">
                                                        @can('disciplina.editar')
                                                            <div class="col-2">
                                                                <a href="{{route('admin.dashboard.subject.edit',['subject' => $subject->id])}}" class="btn-icon mdi mdi-square-edit-outline"></a>
                                                            </div>
                                                        @endcan
                                                        @can('disciplina.visualizar')
                                                            <div class="col-2">
                                                                <a class="btn-icon mdi mdi-eye" data-bs-toggle="modal" data-bs-target="#modal-subject-{{$subject->id}}"></a>

                                                                <div id="modal-subject-{{$subject->id}}" class="modal fade" tabindex="-1" subject="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog" style="max-width: 1200px;">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header p-3 pt-2 pb-2">
                                                                                <h4 class="page-title">Disciplina</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body p-3 pt-0 pb-3">
                                                                                {!! Form::model($subject, ['route' => ['admin.dashboard.subject.show', $subject->id], 'class'=>'parsley-examples']) !!}
                                                                                    @include('Admin.cruds.subject.form')
                                                                                {!! Form::close() !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endcan
                                                        @can('disciplina.remover')
                                                            <form action="{{route('admin.dashboard.subject.destroy',['subject' => $subject->id])}}" class="col-2" method="POST">
                                                                @method('DELETE') @csrf

                                                                <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row subject-student">
                                                        <!-- Standard  modal -->
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#standard-modall-{{$subject->id}}"><i class="icon-grid btn-icon"></i></a>
                                                    </div>

                                                    <!-- Standard modal content -->
                                                    <div id="standard-modall-{{$subject->id}}" class="modal fade studentModal" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" style="max-width: 760px;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="standard-modalLabel">Alunos vinculdos à disciplina</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{route('admin.dashboard.subjectStudent')}}" class="col-12 student" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="subject_id" value="{{ $subject->id }}"></input>
                                                                        <div class="row col-lg-12 mb-3">
                                                                            <label for="btnAll" class="label-check">
                                                                                <input type="checkbox" id="btnAll" class="form-check-input rounded-circle btnAll studentCheckbox">
                                                                                Marca/remover todos
                                                                            </label>
                                                                        </div>
                                                                        <div class="row">
                                                                            @foreach($students as $student)
                                                                                @php
                                                                                    $checkSubject = "";
                                                                                @endphp

                                                                                @foreach($student->subject as $studentSubject)
                                                                                    @if ($studentSubject->id == $subject->id)
                                                                                        @php
                                                                                            $checkSubject = "checked";
                                                                                        @endphp
                                                                                    @endif
                                                                                @endforeach

                                                                                <div class="align-top col-4 box-student">
                                                                                    <div class="form-check form-check-success">
                                                                                        <input class="form-check-input rounded-circle studentCheckbox studentCheckboxItem"
                                                                                               type="checkbox"
                                                                                               name="student_id[]"
                                                                                               id="{{ $student->id }}"
                                                                                               value="{{ $student->id }}"
                                                                                            {{ $checkSubject }}>
                                                                                        <label class="form-check-label" for="{{ $student->id }}">{{ $student->name }}</label>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>


                                                                        <div class="btn-student col-12 d-flex justify-content-end">
                                                                            <button type="submit" class="btn btn-success">Enviar</button>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- PAGINATION --}}
                                <div class="mt-3 float-end">
                                    {{$subjects->links()}}
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesIndex')

    <script>
        const marcarTodosCheckbox = document.getElementById('btnAll');
        const studentCheckboxes = document.querySelectorAll('.studentCheckbox');

        marcarTodosCheckbox.addEventListener('change', function () {
            const isChecked = this.checked;

            studentCheckboxes.forEach(function (checkbox) {
                checkbox.checked = isChecked;
            });
        });

    </script>
@endsection
