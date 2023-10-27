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

                <form action="{{route('admin.dashboard.subjectStudent')}}" class="col-12 student" method="POST">
                    @csrf
                    <input type="hidden" name="subject_id" value="{{ $subject->id }}"></input>

                    <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                        <thead class="table-light">
                        <tr>
                            <th></th>
                            <th class="bs-checkbox">
                                <label><input name="btnSelectAll" type="checkbox"></label>
                            </th>
                            <th>Aluno</th>
                        </tr>
                        </thead>

                        <tbody data-route="{{route('admin.dashboard.student.sorting')}}">
                        @foreach ($students as $key => $student)
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
                            <tr data-code="{{$student->id}}">
                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                <td class="bs-checkbox">
                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" {{ $checkSubject }} value="{{$student->id}}"></label>
                                </td>
                                <td>{{$student->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="btn-student col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>

                </form>
            </div>>
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesIndex')
@endsection
