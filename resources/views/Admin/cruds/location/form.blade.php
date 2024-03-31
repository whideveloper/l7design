
<div class="row col-12">
    <div class="col-12 col-lg-12">
        <div class="card card-body">
            <div class="row">
                <div class="mb-3 col-lg-12">
                    {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
                    {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
                </div>
                <div class="mb-3 col-lg-12">
                    {!! Form::label(null, 'Link mapa', ['class'=>'form-label']) !!}
                    {!! Form::text('link', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
                </div>
                <div class="mb-3 col-lg-6">
                    {!! Form::label(null, 'Municípios atendidos', ['class'=>'form-label']) !!}
                    {!! Form::text('number_county', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
                </div>
                <div class="mb-3 col-lg-6">
                    {!! Form::label(null, 'Regiões de saúde de Sergipe', ['class'=>'form-label']) !!}
                    {!! Form::text('number_region', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
                </div>
                <div class="mb-3 col-lg-12">
                    {!! Form::label('basic-editor', 'Breve descrição', ['class'=>'form-label']) !!}
                    {!! Form::textarea('description', null, [
                        'class'=>'form-control CkEditorColumn',
                        'id'=>'basic-editor',
                        'data-height' => 200
                    ]) !!}
                </div>
                </div>
                <div class="mb-3">
                    {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                    {!! Form::label('active', 'Ativo?', ['class'=>'form-check-label']) !!}
                </div>
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div>
<!-- end row -->
