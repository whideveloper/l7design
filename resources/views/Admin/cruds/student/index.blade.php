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
                                    <li class="breadcrumb-item active">Alunos</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Alunos</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3 justify-content-end">
                                    @can('aluno.remover')
                                        <div class="col-6">
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.student.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>
                                        </div>
                                    @endcan
                                    <div class="row col-6 d-flex justify-content-end">
                                        <div style="width: 240px">
                                            @can('aluno.restaurar dados')
                                                @if ($studentsDeleted_at)
                                                    <a href="{{route('admin.dashboard.student.show')}}" class="btn btn-primary float-end">Restaurar regitro(s) <i class="mdi mdi-delete-restore"></i></a>
                                                @endif
                                            @endcan

                                        </div>
                                        @can('aluno.criar')
                                            <div style="width: 165px">
                                                <a href="{{route('admin.dashboard.student.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>
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
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Status</th>
                                            <th>Criado em</th>
                                            <th>Ações</th>
                                            <th>Disciplinas</th>
                                        </tr>
                                    </thead>

                                    <tbody data-route="{{route('admin.dashboard.student.sorting')}}">
                                        @foreach ($students as $key => $student)
                                            <tr data-code="{{$student->id}}">
                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$student->id}}"></label>
                                                </td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>
                                                    @switch($student->active)
                                                        @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                        @case(1) <span class="badge bg-success">Ativo</span> @break
                                                    @endswitch
                                                </td>
                                                <td>{{$student->created_at->format('d/m/Y H:i')}}</td>
                                                <td>
                                                    <div class="row justify-content-start">
                                                        @can('aluno.editar')
                                                            <div class="col-2">
                                                                <a href="{{route('admin.dashboard.student.edit',['student' => $student->id])}}" class="btn-icon mdi mdi-square-edit-outline"></a>
                                                            </div>
                                                        @endcan
                                                        @can('aluno.visualizar')
                                                            <div class="col-2">
                                                                <a class="btn-icon mdi mdi-eye" data-bs-toggle="modal" data-bs-target="#modal-student-{{$student->id}}"></a>

                                                                <div id="modal-student-{{$student->id}}" class="modal fade" tabindex="-1" student="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog" style="max-width: 800px;">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header p-3 pt-2 pb-2">
                                                                                <h4 class="page-title">Aluno</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body p-3 pt-0 pb-3">
                                                                                {!! Form::model($student, ['route' => ['admin.dashboard.student.show', $student->id], 'class'=>'parsley-examples']) !!}
                                                                                    @include('Admin.cruds.student.form')
                                                                                {!! Form::close() !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endcan
                                                        @can('aluno.remover')
                                                            <form action="{{route('admin.dashboard.student.destroy',['student' => $student->id])}}" class="col-2" method="POST">
                                                                @method('DELETE') @csrf

                                                                <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row course-student">
                                                        <!-- Standard  modal -->
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#standard-modall-{{$student->id}}"><i class="icon-grid btn-icon"></i></a>
                                                    </div>

                                                    <!-- Standard modal content -->
                                                    <div id="standard-modall-{{$student->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="standard-modalLabel">Disciplinas vinculada ao Aluno</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('admin.dashboard.studentSubject')}}" class="col-4" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="student_id" value="{{ $student->id }}"></input>
                                                                        @foreach($subjects as $subject)
                                                                            @php
                                                                                $checkSubject = "";
                                                                            @endphp

                                                                            @foreach ($student->subject as $studentSubject)
                                                                                @if ($studentSubject->subject_id == $subject->id)
                                                                                    @php
                                                                                        $checkSubject = "checked";
                                                                                    @endphp

                                                                                    @break
                                                                                @endif
                                                                            @endforeach

                                                                            <div class="mb-3 align-top">
                                                                                <div class="form-check mb-2 form-check-success">
                                                                                    <input class="form-check-input rounded-circle" type="checkbox" name="subject_id[]" id="{{ $subject->id }}" value="{{ $subject->id }}" {{ $checkSubject }}>
                                                                                    <label class="form-check-label" for="{{ $subject->id }}">{{ $subject->name }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach

                                                                        <button type="submit" class="btn btn-success">Enviar</button>
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
                                    {{$students->links()}}
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
@endsection
