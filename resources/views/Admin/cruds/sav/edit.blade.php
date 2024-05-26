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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.sav.index')}}">Sav</a></li>
                                    <li class="breadcrumb-item active">Editar Sessão Sav</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Sessão Sav</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($sav, ['route' => ['admin.dashboard.sav.update', $sav->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.sav.form')
                    @can('sav.editar')
                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light mb-3 float-end width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.sav.index')}}" class="btn btn-secondary waves-effect waves-light mb-3 float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}
                
                @can('sav.visualizar')
                    <div class="card card-body col-12">
                        <h4 class="page-title mobile">Savs Gravadas</h4>  
                        <div class="d-flex align-items-center col-12" style="justify-content: space-between !important;">
                            @can('sav.remover')
                            <div class="col-6">
                                <button id="btSubmitDelete" data-route="{{route('admin.dashboard.savGravada.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>             
                            </div>
                            @endcan
                            @can('sav.criar')
                                <a href="{{route('admin.dashboard.savGravada.create')}}" style="max-width: 160px;" class="bt-mobile btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>
                            @endcan
                        </div>                      
                    </div>
                    <div class="card card-body">
                        <div class="row pe-3">
                            <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
        
                                <thead class="table-light">
                                <tr>
                                <th></th>
                                <th class="bs-checkbox">
                                    <label><input name="btnSelectAll" value="btnDeleteListLink" type="checkbox"></label>
                                </th>
                                <th class="text-center">Título</th>
                                <th class="text-center">Link</th>
                                <th class="text-center">Imagem</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Ações</th>
                                </tr>
                                </thead>
        
                                <tbody data-route="{{route('admin.dashboard.savGravada.sorting')}}">
                                    @foreach ($savGravadas as $key => $savGravada)
                                        <tr data-code="{{$savGravada->id}}">
                                            <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                            <td class="bs-checkbox">
                                                <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$savGravada->id}}"></label>
                                            </td>
                                            <td>{{$savGravada->title}}</td>
                                            <td><a href="{{$savGravada->link}}" target="_blank" class="mdi mdi-link-box-variant font-28 text-secondary"></a></td>
                                            <td class="table-user text-center">
                                                @if ($savGravada->path_image)
                                                    <img src="{{ asset('storage/'.$savGravada->path_image) }}" alt="table-user" class="me-2 rounded-circle">
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @switch($savGravada->active)
                                                    @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                    @case(1) <span class="badge bg-success">Ativo</span> @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="row d-flex justify-content-center">  
                                                    @can('sav.editar')                                                        
                                                        <a href="{{route('admin.dashboard.savGravada.edit',['savGravada' => $savGravada->id])}}" class="btn-icon mdi mdi-square-edit-outline col-3"></a>
                                                    @endcan
                                                    @can('sav.remover')                                                        
                                                        <form action="{{route('admin.dashboard.savGravada.destroy',['savGravada' => $savGravada->id])}}" class="col-3" method="POST">
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
                            {{-- <div class="mt-3 float-end">
                                {{$savGravadas->links()}}
                            </div> --}}
                        </div>
                    </div>
                @endcan
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
