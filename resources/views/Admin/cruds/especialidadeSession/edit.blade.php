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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.especialidadeSession.index')}}">Sessão Especialidade</a></li>
                                    <li class="breadcrumb-item active">Editar Sessão Especialidade</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Sessão Especialidade</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($especialidadeSession, ['route' => ['admin.dashboard.especialidadeSession.update', $especialidadeSession->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.especialidadeSession.form')
                    @can('especialidade.editar')
                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light mb-3 float-end width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.especialidadeSession.index')}}" class="btn btn-secondary waves-effect waves-light float-end mb-3 me-3 width-lg">Voltar</a>
                {!! Form::close() !!}

                <div class="card card-body">
                    <h4 class="page-title mobile">Especialistas</h4>
                    
                    @can('especialidade.criar')                                                         
                        <a href="{{route('admin.dashboard.especialidadeProfessional.create')}}" style="max-width:160px" class="btn btn-success float-end bt-mobile">Adicionar novo <i class="mdi mdi-plus"></i></a>                           
                    @endcan                                  
                </div>

                <div class="card card-body">
                    <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">

                        <thead class="table-light">
                        <tr>
                            <th></th>
                            <th class="bs-checkbox">
                                <label><input name="btnSelectAll" value="btnDeleteListLink" type="checkbox"></label>
                            </th>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Função</th>
                            <th class="text-center">Imagem</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                        </thead>

                        <tbody data-route="{{route('admin.dashboard.especialidadeProfessional.sorting')}}">
                            @foreach ($especialidadeProfessionals as $key => $especialidadeProfessional)
                                <tr data-code="{{$especialidadeProfessional->especialidade_id}}">
                                    <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                    <td class="bs-checkbox">
                                        <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$especialidadeProfessional->especialidade_id}}"></label>
                                    </td>
                                    <td>{{$especialidadeProfessional->name}}</td>
                                    <td>{{$especialidadeProfessional->categoria}}</td>
                                    <td class="table-user text-center">
                                        @if ($especialidadeProfessional->path_image)
                                            <img src="{{ asset('storage/'.$especialidadeProfessional->path_image) }}" name="path_image" alt="table-user" class="me-2 rounded-circle">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @switch($especialidadeProfessional->active)
                                            @case(0) <span class="badge bg-danger">Inativo</span> @break
                                            @case(1) <span class="badge bg-success">Ativo</span> @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="row d-flex justify-content-center">  
                                            <a href="{{route('admin.dashboard.especialidadeProfessional.edit',['especialidadeProfessional' => $especialidadeProfessional->especialidade_id])}}" class="btn-icon mdi mdi-square-edit-outline col-3"></a>

                                            <form action="{{route('admin.dashboard.especialidadeProfessional.destroy',['especialidadeProfessional' => $especialidadeProfessional->especialidade_id])}}" class="col-3" method="POST">
                                                @method('DELETE') @csrf
                                                <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- PAGINATION --}}
                    <div class="mt-3 float-end">
                        {{$especialidadeProfessionals->links()}}
                        </div>
                </div>                
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
