
<div class="row col-12">
    <div class="col-12 col-lg-6">
        <div class="card card-body">
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <div class="mb-3">
                {!! Form::label('heard', 'Disciplina', ['class'=>'form-label']) !!}
                {!! Form::select('subject_id', $subjects, isset($subject)?$subject:null, [
                    'class'=>'form-select',
                    'id'=>'heard',
                    'required'=>'required',
                    'placeholder' => 'Selecione uma disciplina'
                ]) !!}
            </div>

            <div class="mb-3 col-lg-12">
                {!! Form::label(null, 'Nome do curso', ['class'=>'form-label']) !!}
                {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
            </div>

            <div class="mb-3 col-lg-12">
                {!! Form::label(null, 'Link Youtube', ['class'=>'form-label']) !!}
                {!! Form::text('link_youtube', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
            </div>

            <div class="mb-3 col-lg-12">
                {!! Form::label(null, 'Link Vímeo', ['class'=>'form-label']) !!}
                {!! Form::text('link_vimeo', null, ['class'=>'form-control', 'id'=>'validationCustom03']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label('complete-editor', 'Texto', ['class'=>'form-label']) !!}
                {!! Form::textarea('text', null, [
                    'class'=>'form-control CkEditorColumn',
                    'id'=>'complete-editor',
                    'data-height' => 150
                ]) !!}
            </div>
            <div class="mb-3">
                {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                {!! Form::label('active', 'Curso Ativo?', ['class'=>'form-check-label']) !!}
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
    <div class="col-12 col-lg-6">
        <div class="card card-body">
            <div class="mb-3 col-lg-12">
                {!! Form::label('file', 'Imagem', ['class'=>'form-label']) !!}
                {!! Form::file('path_image', [
                    'data-plugins'=>'dropify',
                    'data-height'=>'200',
                    'data-max-file-size-preview'=>'2M',
                    'accept'=>'image/*',
                    'data-default-file'=> isset($course)?$course->path_image<>''?url('storage/'.$course->path_image):'':'',
                ]) !!}
            </div>
        </div>

        <div class="card card-body">
            <div class="mb-3 col-lg-12">
                {!! Form::label('file', 'Vídeo', ['class'=>'form-label']) !!}
                {!! Form::file('video', [
                    'data-plugins'=>'dropify',
                    'data-height'=>'200',
                    'data-max-file-size-preview'=>'2M',
                    'accept'=>'image/*',
                    'data-default-file'=> isset($course)?$course->video<>''?url('storage/'.$course->video):'':'',
                ]) !!}
            </div>
        </div>
    </div>
</div>

<!-- end row -->
