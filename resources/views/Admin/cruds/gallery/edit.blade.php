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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.gallery.index')}}">Galerias</a></li>
                                    <li class="breadcrumb-item active">Editar Galeria</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Galeria</h4>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary me-3 col-3 waves-effect waves-light mb-3" data-bs-toggle="modal" data-bs-target="#modal-image-gallery">Cadastrar imagens da Galeria <i class="mdi mdi-plus"></i></button>
                <!-- end page title -->
                {!! Form::model($gallery, ['route' => ['admin.dashboard.gallery.update', $gallery->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.gallery.form')
                    @can('galeria.editar')
                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.gallery.index')}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}

                {{-- BEGIN ABOUT IMAGES GALLERY --}}
                <div id="modal-image-gallery" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" style="max-width: 800px;">
                        <div class="modal-content">
                            <div class="modal-header p-3 pt-2 pb-2">
                                <h4 class="page-title">Cadastrar imagens da galeria</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-3 pt-0 pb-3">
                                <div class="card-body p-0">
                                    <h4 class="header-title">Inserir Imagens</h4>
                                    <p class="sub-header">
                                        Clique na área designada abaixo para adicionar suas imagens. Você pode selecionar uma ou várias imagens para enviar.
                                    </p>
        
                                    <form action="{{ route('admin.dashboard.galleryImage.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
                                        <label for="imageInput" class="custom-file-upload">Selecionar Imagens</label>
                                        <input id="imageInput" name="path_image[]" type="file" multiple onchange="updateFileCount(this)" />
                                        <span id="fileCount">Nenhum arquivo selecionado</span>
                                        <button type="submit" class="btn btn-secondary waves-effect waves-light float-end mb-3 me-0 width-lg align-items-left">Enviar</button>
                                    </form>

                                    <script>
                                        function updateFileCount(input) {
                                            var count = input.files.length;
                                            var fileCountText = count + (count === 1 ? ' arquivo selecionado' : ' arquivos selecionados');
                                            document.getElementById('fileCount').innerText = fileCountText;
                                        }
                                    </script>                                                                  
                                </div> <!-- end card-body-->

                                <div class="col-12 mb-3 mt-3">
                                    <button id="btSubmitDelete" data-route="{{route('admin.dashboard.galleryImage.destroySelected')}}" type="button" class="btn btn-danger btnDeleteImage" style="display: none;">Deletar selecionados</button>
                                </div>
                                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                                    <thead class="table-light">
                                        <tr>
                                            <th></th>
                                            <th class="bs-checkbox">
                                                <label><input name="btnSelectAll" value="btnDeleteImage" type="checkbox"></label>
                                            </th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody data-route="{{route('admin.dashboard.galleryImage.sorting')}}">
                                        @foreach ($gallery->galleryImage as $key => $galleryImage)
                                            <tr data-code="{{$galleryImage->id}}">
                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$galleryImage->id}}"></label>
                                                </td>
                                                <td class="table-user text-center">
                                                    @if ($galleryImage->path_image)
                                                        <img src="{{ asset('storage/'.$galleryImage->path_image) }}" name="path_image" alt="table-user" class="me-2 rounded-circle">
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="row d-flex justify-content-center">
                                                        <form action="{{route('admin.dashboard.galleryImage.destroy',['galleryImage' => $galleryImage->id])}}" class="col-4" method="POST">
                                                            @method('DELETE') @csrf
                                                            <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                                        </form>
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
                {{-- END ABOUT IMAGES GALLERY --}}
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
    <style>
        /* Estilizando o input file */
        input[type='file'] {
            display: none; /* Oculta o input file nativo */
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            background-color: #f9f9f9;
        }

        .custom-file-upload:hover {
            background-color: #e9e9e9;
        }

    </style>
@endsection 
