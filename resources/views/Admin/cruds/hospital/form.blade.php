<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div>
        <div class="mb-3 col-lg-12">
            {!! Form::label('complete-editor', 'Texto', ['class'=>'form-label']) !!}
            {!! Form::textarea('text', null, [
                'class'=>'form-control CkEditorColumn',
                'id'=>'complete-editor',
                'data-height' => 250
            ]) !!}
        </div>
    </div>
</div> <!-- end card-body-->

    <div class="row col-lg-12">
        <div class="col-12 col-lg-6">
            <div class="card card-body">
                <div class="row">
                    <div class="mb-3 col-lg-12">
                        {!! Form::label('path_image', 'Imagem', ['class'=>'form-label']) !!}
                        {!! Form::file('path_image', [
                            'data-plugins'=>'dropify',
                            'data-height'=>'160',
                            'data-max-file-size-preview'=>'2M',
                            'accept'=>'image/*',
                            'data-default-file'=> isset($hospital)?$hospital->path_image<>''?url('storage/'.$hospital->path_image):'':'',
                        ]) !!}
                    </div>
                    {{-- <span class="alert alert-warning" role="alert">OBS: Dimensões do hospital: 1440 x 684</span> --}}
                </div>
                <div class="mb-3 form-check">
                    {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                    {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
        <div class="col-12 col-lg-6">
            <div class="card card-body">
                <div class="row">
                    <div class="mb-3 col-lg-12">
                        {!! Form::label('path_image_logo', 'Imagem logo', ['class'=>'form-label']) !!}
                        {!! Form::file('path_image_logo', [
                            'data-plugins'=>'dropify',
                            'data-height'=>'205',
                            'data-max-file-size-preview'=>'2M',
                            'accept'=>'image/*',
                            'data-default-file'=> isset($hospital)?$hospital->path_image_logo<>''?url('storage/'.$hospital->path_image_logo):'':'',
                        ]) !!}
                    </div>
                    {{-- <span class="alert alert-warning" role="alert">OBS: Dimensões do hospital: 600 x 380</span> --}}
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>

