
<div class="mb-3 col-lg-12" style="text-align: left">
    {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
    {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
</div>

<div class="mb-3 col-lg-12" style="text-align: left">
    {!! Form::label('path_image', 'Imagem desktop', ['class'=>'form-label']) !!}
    {!! Form::file('path_image', [
        'data-plugins'=>'dropify',
        'data-height'=>'160',
        'data-max-file-size-preview'=>'2M',
        'accept'=>'image/*',
        'data-default-file'=> isset($objective)?$objective->path_image<>''?url('storage/'.$objective->path_image):'':'',
    ]) !!}
</div>

<div class="mb-3 form-check" style="text-align: left">
    {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
    {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
</div>


