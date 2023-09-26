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
                                    <li class="breadcrumb-item active">Usuários</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Usuários</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    @can('usuario.remover')
                                        <div class="col-6">
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.contact.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>
                                        </div>
                                    @endcan
                                    @can('usuario.criar')
                                        <div class="col-6">
                                            <a href="{{route('admin.dashboard.contact.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>
                                        </div>
                                    @endcan
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
                                        </tr>
                                    </thead>

                                    <tbody data-route="{{route('admin.dashboard.contact.sorting')}}">
                                        @foreach ($contacts as $key => $contact)
                                            <tr data-code="{{$contact->id}}">
                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$contact->id}}"></label>
                                                </td>
                                                <td>{{$contact->nome}}</td>
                                                <td>{{$contact->email}}</td>
                                                <td>
                                                    @switch($contact->status)
                                                        @case(1) <span class="badge bg-danger">Pendente</span> @break
                                                        @case(2) <span class="badge bg-warning">Em Contato</span> @break
                                                        @case(3) <span class="badge bg-primary">Orçamento</span> @break
                                                        @case(4) <span class="badge bg-success">Agendamento</span> @break
                                                    @endswitch
                                                </td>
                                                <td>{{$contact->created_at->format('d/m/Y H:i')}}</td>
                                                <td>
                                                    <div class="row">
                                                        @can('usuario.editar')
                                                            <div class="col-4">
                                                                <a href="{{route('admin.dashboard.contact.edit',['contact' => $contact->id])}}" class="btn-icon mdi mdi-square-edit-outline"></a>
                                                            </div>
                                                        @endcan
                                                        @can('usuario.visualizar')
                                                            <div class="col-4">
                                                                <a class="btn-icon mdi mdi-eye" data-bs-toggle="modal" data-bs-target="#modal-contact-{{$contact->id}}"></a>

                                                                <div id="modal-contact-{{$contact->id}}" class="modal fade" tabindex="-1" contact="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog" style="max-width: 800px;">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header p-3 pt-2 pb-2">
                                                                                <h4 class="page-title">Usuário</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body p-3 pt-0 pb-3">
                                                                                {!! Form::model($contact, ['route' => ['admin.dashboard.contact.show', $contact->id], 'class'=>'parsley-examples']) !!}
                                                                                    @include('Admin.cruds.contact.form')
                                                                                {!! Form::close() !!}                                                                             
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endcan
                                                        @can('usuario.remover')
                                                            <form action="{{route('admin.dashboard.contact.destroy',['contact' => $contact->id])}}" class="col-4" method="POST">
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
                                    {{$contacts->links()}}
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
