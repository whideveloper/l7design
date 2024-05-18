<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div>
        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Título do botão', ['class'=>'form-label']) !!}
            {!! Form::text('btn_title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
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

<div class="card card-body">
    
    <div class="mb-3 col-lg-12">
        {!! Form::label('path_file', 'Arquivo', ['class'=>'form-label']) !!}
        {!! Form::file('path_file', [
            'data-plugins'=>'dropify',
            'data-height'=>'160',
            'data-max-file-size-preview'=>'2M',
            'accept'=>'*',
            'data-default-file'=> isset($tutorial)?$tutorial->path_file<>''?url('storage/'.$tutorial->path_file):'':'',
        ]) !!}
    </div>
    
    <div class="mb-3 form-check">
        {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
        {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
    </div>
</div> <!-- end card-body-->


