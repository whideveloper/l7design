<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-12">
            {!! Form::label('complete-editor', 'Texto', ['class'=>'form-label']) !!}
            {!! Form::textarea('text', null, [
                'class'=>'form-control CkEditorColumn',
                'id'=>'complete-editor',
                'data-height' => 250
            ]) !!}
        </div>
        <div class="mb-3">
            {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
            {!! Form::label('active', 'Ativo?', ['class'=>'form-check-label']) !!}
        </div>
    </div>
</div> <!-- end card-body-->
