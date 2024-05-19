
<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
        </div>
        <div class="mb-3 col-12">
            {!! Form::label('message', 'Breve descrição', ['class'=>'form-label']) !!}
            {!! Form::textarea('description', null, [
                'class'=>'form-control',
                'id'=>'message',
                'required'=>'required',
                'data-parsley-trigger'=>'keyup',
                'data-parsley-minlength'=>'20',
                'data-parsley-maxlength'=>'100',
                'data-parsley-minlength-message'=>'Vamos lá! Você precisa inserir um texto de pelo menos 20 caracteres.',
                'data-parsley-validation-threshold'=>'10',
            ]) !!}
        </div>
        <div class="mb-3 col-lg-12">
            {!! Form::label('complete-editor', 'Descrição', ['class'=>'form-label']) !!}
            {!! Form::textarea('text', null, [
                'class'=>'form-control CkEditorColumn',
                'id'=>'complete-editor',
                'data-height' => 250
            ]) !!}
        </div>
    </div>
</div> <!-- end card-->
<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-12">
            {!! Form::label('path_image', 'Imagem', ['class'=>'form-label']) !!}
            {!! Form::file('path_image', [
                'data-plugins'=>'dropify',
                'data-height'=>'160',
                'data-max-file-size-preview'=>'2M',
                'accept'=>'image/*',
                'data-default-file'=> isset($gallery)?$gallery->path_image<>''?url('storage/'.$gallery->path_image):'':'',
            ]) !!}
        </div>
    </div>
    <div class="mb-3 form-check">
        {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
        {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
    </div>
</div> <!-- end card-body-->
