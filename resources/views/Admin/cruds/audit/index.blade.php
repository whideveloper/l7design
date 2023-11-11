@php
    use App\Enums\ModelTypeAudit;
@endphp
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
                                    <li class="breadcrumb-item active">Eventos de Auditorias</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Eventos de Auditorias</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                                    <thead class="table-light">
                                        <tr>
                                            <th></th>
                                            <th>Ação realizada</th>
                                            <th>Recurso manipulado</th>
                                            <th>Usuário manipulador</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($activities as $key => $activitie)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    @switch($activitie->description)
                                                        @case('created') <span>Criação</span> @break
                                                        @case('updated') <span>Atualização</span> @break
                                                        @case('deleted') <span>Deleção</span> @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    {{ ModelTypeAudit::getLabel($activitie->subject_type) }}
                                                </td>
                                                @if(Auth::user()->id == $activitie->causer_id)
                                                    <td>{{Auth::user()->name}}</td>
                                                @endif

                                                <td>
                                                    <a href="{{route('admin.dashboard.audit.show',['activitie' => $activitie->id])}}" class="btn-icon mdi mdi-eye-outline"></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- PAGINATION --}}
                                <div class="mt-3 float-end">
                                    {{$activities->links()}}
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