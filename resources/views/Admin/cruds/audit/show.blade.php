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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.audit.index')}}">Auditoria</a></li>
                                    <li class="breadcrumb-item active">Visualizar Evento Auditoria</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Visualizar Evento Auditoria</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row col-12">
                    <div class="col-12 col-lg-12">
                        <div class="card card-body">
                            <div class="mb-2 col-lg-6">
                                <div>
                                    <h5>Usuário manipulador</h5>
                                </div>
                                @if(Auth::user()->id == $activitie->causer_id)
                                    {{Auth::user()->name}}
                                @endif
                            </div>
                            <div class="mb-2 col-lg-6">
                                <div>
                                    <h5>Recurso manipulado</h5>
                                </div>
                                {{ ModelTypeAudit::getLabel($activitie->subject_type) }}
                            </div>
                            <div class="mb-2">
                                <div>
                                    <h5>Ação realizada</h5>
                                </div>
                                @switch($activitie->description)
                                    @case('created') <span>Criação</span> @break
                                    @case('updated') <span>Atualização</span> @break
                                    @case('deleted') <span>Deleção</span> @break
                                @endswitch
                            </div>
                            <div class="mb-2">
                                <div>
                                    <h5>Valores Antigos</h5>
                                </div>
                                <code>
                                    {{ print_r($activitie->properties['old'] ?? [], true) }}
                                </code>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <h5>Valores Novos</h5>
                                </div>
                                <code>
                                    {{ print_r($activitie->properties['attributes'] ?? [], true) }}
                                </code>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
