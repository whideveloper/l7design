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
                                    <div class="col-6">
                                        @can('evento.remover')
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.event.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>             
                                        @endcan
                                    </div>
                                    
                                    <div class="col-6">
                                        @can('evento.criar')
                                            <a href="{{route('admin.dashboard.event.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>                                        
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
                                                <td>{{$event->name}}</td>
                                                <td class="table-user text-center">
                                                    {{substr(strip_tags($event->text), 0, 180)}}...
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
