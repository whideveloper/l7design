
<div class="row col-12">
    <div class="col-12 col-lg-12">
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
    </div> <!-- end card-->
    <div class="row col-lg-12">
        <div class="col-12 col-lg-12">
            <div class="card card-body">
                <div class="row">
                    <div class="mb-3 col-lg-12">
                        {!! Form::label('path_image', 'Imagem', ['class'=>'form-label']) !!}
                        {!! Form::file('path_image', [
                            'data-plugins'=>'dropify',
                            'data-height'=>'160',
                            'data-max-file-size-preview'=>'2M',
                            'accept'=>'image/*',
                            'data-default-file'=> isset($proadi)?$proadi->path_image<>''?url('storage/'.$proadi->path_image):'':'',
                        ]) !!}
                    </div>
                    {{-- <span class="alert alert-warning" role="alert">OBS: Dimensões do proadi: 1440 x 684</span> --}}
                </div>  
                <div class="mb-3 form-check">
                    {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                    {!! Form::label('active', 'Ativo?', ['class'=>'form-check-label']) !!}
                </div>              
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
</div>
<!-- end row -->
