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
                                    <li class="breadcrumb-item active">Lead</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Lead</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3 align-items-center filter">
                                    <div class="col-3 bt-mobile">
                                        @can('leads.remover')
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.lead.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>             
                                        @endcan
                                    </div>
                                    <div class="col-6 form">
                                        <div class="mb-3 card card-body">
                                            @if (Route::currentRouteName() == 'admin.dashboard.lead.lead-search')
                                                <a href="{{route('admin.dashboard.lead.index')}}" class="btn btn-danger waves-effect waves-light float-end me-3 width-lg">Limpar</a>
                                            @endif
                                            <form action="{{route('admin.dashboard.lead.lead-search')}}" method="GET" class="d-flex align-items-end">
                                                @csrf
                                                <div class="row">
                                                    {!! Form::label('heard', 'Filtrar por Vídeos', ['class' => 'form-label ps-0']) !!}
                                                    {!! Form::select('video_id', $videoSelect, $selectedVideoId, [
                                                        'class' => 'form-select',
                                                        'id' => 'heard',
                                                        'placeholder' => 'Selecione o vídeo'
                                                    ]) !!}
                                                </div>
                                                {!! Form::button('Buscar', ['class'=>'btn btn-primary waves-effect waves-light float-end ms-3 width-lg bt-select', 'type' => 'submit']) !!}                                               
                                            </form>
                                        </div> 
                                    </div>
                                    {{-- <div class="col-3 bt-mobile">
                                        @can('leads.criar')
                                        <a href="{{route('admin.dashboard.lead.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>
                                        @endcan
                                    </div> --}}
                                </div>
                                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                                    <thead class="table-light">
                                        <tr>
                                            {{-- <th></th> --}}
                                            <th class="bs-checkbox">
                                                <label><input name="btnSelectAll" type="checkbox"></label>
                                            </th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Vídeo assistido</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($leads as $key => $lead)
                                            <tr data-code="{{$lead->id}}">
                                                {{-- <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td> --}}
                                                <td class="bs-checkbox">
                                                    <label><input data-index="" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$lead->id}}"></label>
                                                </td>
                                                
                                                <td>{{$lead->name}}</td>
                                                <td>{{$lead->email}}</td>
                                                <td>{{$lead->video_title}}</td>
                                                <td>
                                                    <div class="row">
                                                        @can('leads.editar')
                                                        <div class="col-4">
                                                           <a class="btn-icon mdi mdi-eye" data-bs-toggle="modal" data-bs-target="#modal-lead-{{$lead->id}}"></a>

                                                            <div id="modal-lead-{{$lead->id}}" class="modal fade" tabindex="-1" lead="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog" style="max-width: 800px;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header p-3 pt-2 pb-2">
                                                                            <h4 class="page-title">Lead</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body p-3 pt-0 pb-3">
                                                                            {!! Form::model($lead, ['route' => ['admin.dashboard.lead.show', $lead->id], 'class'=>'parsley-examples']) !!}
                                                                                @include('Admin.cruds.leads.form')
                                                                            {!! Form::close() !!}                                                                             
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endcan
                                                        @can('leads.remover')
                                                            <form action="{{route('admin.dashboard.lead.destroy',['lead' => $lead->id])}}" class="col-4" method="POST">
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

                                {{-- PAGINATION --}}
                                <div class="mt-3 float-end">
                                   {{$leads->links()}}
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
