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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.user.index')}}">Usuários</a></li>
                                    <li class="breadcrumb-item active">Visualizar Usuário</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Visualizar Usuário</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th class="bs-checkbox">
                                <label><input name="btnSelectAll" type="checkbox"></label>
                            </th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Deletado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody data-route="{{route('admin.dashboard.user.sorting')}}">
                        @foreach ($users as $key => $user)
                            <tr data-code="{{$user->id}}">
                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                <td class="bs-checkbox">
                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$user->id}}"></label>
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->format('d/m/Y')}}</td>
                                <td>
                                    <div class="row">
                                        @can('usuario.editar')
                                            <div class="col-4">
                                                <form action="{{route('admin.dashboard.user.retoreData',['user' => $user->id])}}" class="col-4" method="POST">
                                                    @csrf
                                                    @method('POST') 
                                                        
                                                    <button type="submit" class="btn-icon" title="Restaurar item"><i class="mdi mdi-restore"></i></button>
                                                </form>
                                            </div>
                                        @endcan
                                        @can('usuario.remover')
                                            <form action="{{route('admin.dashboard.user.deleteForced',['user' => $user->id])}}" class="col-4" method="POST">
                                                @csrf
                                                @method('DELETE') 
                                                    
                                                <button type="button" class="btn-icon btSubmitDeleteItemForever" title="Deletar permanentemente"><i class="mdi mdi-delete-forever-outline"></i></button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
