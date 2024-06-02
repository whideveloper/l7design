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
                                    <li class="breadcrumb-item active">Evento</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Evento</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">                                
                                <div class="row mb-3">
                                    <div class="col-4 bt-rm">
                                        @can('evento.remover')
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.event.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>             
                                        @endcan
                                    </div>
                                    
                                    <div class="col-8 pe-0 bt-event">
                                        @can('evento.criar') 
                                            @can('evento.criar')
                                                <a href="{{route('admin.dashboard.event.create')}}" style="width: 170px;" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>                                        
                                                <a class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#modal-holiday">Adicionar feriado <i class="mdi mdi-plus"></i></a>
                                            @endcan                                
            
                                            <div id="modal-holiday" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" style="max-width: 800px;">
                                                    <div class="modal-content">
                                                        <div class="modal-header p-3 pt-2 pb-2">
                                                            <h4 class="page-title">Feriados</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-3 pt-0 pb-3">
                                                            {!! Form::model(null, ['route' => 'admin.dashboard.holiday.store', 'class'=>'parsley-examples', 'files' => true]) !!}
                                                            @include('Admin.cruds.holiday.form')
                                                            {!! Form::button('Cadastrar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row pe-3">
                                                                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                                            
                                                                    <thead class="table-light">
                                                                    <tr>
                                                                        <th></th>
                                                                        <th class="text-center">Título</th>
                                                                        <th class="text-center">Data</th>
                                                                        <th class="text-center">Status</th>
                                                                        <th class="text-center">Ações</th>
                                                                    </tr>
                                                                    </thead>
                                            
                                                                    <tbody data-route="{{route('admin.dashboard.holiday.sorting')}}">
                                                                        @foreach ($holidays as $key => $holiday)
                                                                            <tr data-code="{{$holiday->id}}">
                                                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                                                <td>{{$holiday->title}}</td>
                                                                                <td>{{Carbon\Carbon::parse($holiday->date_holiday)->format('d/m')}}</td>
                                                                                <td class="text-center">
                                                                                    @switch($holiday->active)
                                                                                        @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                                                        @case(1) <span class="badge bg-success">Ativo</span> @break
                                                                                    @endswitch
                                                                                </td>
                                                                                <td>
                                                                                    <div class="row d-flex justify-content-center">
                                                                                        @can('evento.editar')                                                                                            
                                                                                            <a class="btn-icon mdi mdi-square-edit-outline col-3" data-bs-toggle="modal" data-bs-target="#modal-holiday-edit{{$holiday->id}}"></a>
                                                                                        @endcan
                
                                                                                        <div id="modal-holiday-edit{{$holiday->id}}" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                                            <div class="modal-dialog" style="max-width: 800px;">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header p-3 pt-2 pb-2">
                                                                                                        <h4 class="page-title">Feriados</h4>
                                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                    </div>
                                                                                                    <div class="modal-body p-3 pt-0 pb-3">
                                                                                                        {!! Form::model($holiday, ['route' => ['admin.dashboard.holiday.update', $holiday->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                                                                                                            @include('Admin.cruds.holiday.form')
                                                                                                            @can('evento.editar')
                                                                                                            {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                                                                                                            @endcan
                                                                                                            <a href="{{route('admin.dashboard.event.index')}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                                                                                                        {!! Form::close() !!}
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> 
                                                                                        @can('evento.remover')                                                                                            
                                                                                            <form action="{{route('admin.dashboard.holiday.destroy',['holiday' => $holiday->id])}}" class="col-3" method="POST">
                                                                                                @method('DELETE') @csrf
                                                                                                <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                                                                            </form>
                                                                                        @endcan
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                            <th>Texto</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody data-route="{{route('admin.dashboard.event.sorting')}}">
                                        @foreach($events as $key => $event)
                                            <tr data-code="{{$event->id}}">
                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$event->id}}"></label>
                                                </td>
                                                <td>{{$event->title}}</td>
                                                <td class="table-user text-center">
                                                    {!!substr(strip_tags($event->text), 0, 180)!!}...
                                                </td>

                                                <td class="text-center">
                                                    @switch($event->active)
                                                        @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                        @case(1) <span class="badge bg-success">Ativo</span> @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        @can('evento.editar')
                                                            <div class="col-4">
                                                                <a href="{{route('admin.dashboard.event.edit',['event' => $event->id])}}" class="btn-icon mdi mdi-square-edit-outline"></a>
                                                            </div>
                                                        @endcan
                                                        @can('evento.remover')
                                                            <form action="{{route('admin.dashboard.event.destroy',['event' => $event->id])}}" class="col-4" method="POST">
                                                                @method('DELETE') @csrf
                                                                <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
