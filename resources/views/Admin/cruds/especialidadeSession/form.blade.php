
<div class="row col-12">
    <div class="col-12 col-lg-12">
        <div class="card card-body">
            <div class="row">
                <div class="mb-3 col-lg-12">
                    {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
                    {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
                </div>   
                
                <div class="mb-3 col-lg-12">
                    {!! Form::label('basic-editor', 'Descrição', ['class'=>'form-label']) !!}
                    {!! Form::textarea('text', null, [
                        'class'=>'form-control CkEditorColumn',
                        'id'=>'basic-editor',
                        'data-height' => 200
                    ]) !!}
                </div>             
            </div>
            <div class="mb-3 form-check">
                {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->

</div>
<!-- end row -->
