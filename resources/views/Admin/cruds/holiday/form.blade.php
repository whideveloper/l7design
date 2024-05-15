
<div class="row col-12">
    <div class="col-12 col-lg-12">
        <div class="card card-body">
            <div class="row">
                <div class="mb-3 col-lg-6">
                    {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
                    {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
                </div>     
                <div class="mb-3 col-lg-6">
                    {!! Form::label(null, 'Data', ['class'=>'form-label']) !!}
                    <div class="input__date">
                        <input type="date" name="date_holiday" value="{{isset($holiday->date_holiday)?$holiday->date_holiday:''}}">
                    </div>
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
