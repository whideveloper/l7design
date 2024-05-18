<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div>
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Latitude', ['class'=>'form-label']) !!}
            {!! Form::text('latitude', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div>
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Longitude', ['class'=>'form-label']) !!}
            {!! Form::text('longitude', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
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
    <div class="mb-3 form-check">
        {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
        {!! Form::label('active', 'Ativo?', ['class'=>'form-check-label']) !!}
    </div> 
</div> <!-- end card-body-->
