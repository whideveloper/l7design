<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div>
        <div class="mb-3 col-lg-12">
            {!! Form::label('complete-editor', 'Descrição', ['class'=>'form-label']) !!}
            {!! Form::textarea('description', null, [
                'class'=>'form-control CkEditorColumn',
                'id'=>'complete-editor',
                'data-height' => 250
            ]) !!}
        </div>                
    </div>
</div> <!-- end card-body-->
