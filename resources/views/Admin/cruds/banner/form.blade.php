
<div class="row col-12">
    <div class="col-12 col-lg-12">
        <div class="card card-body">
            <div class="row">
                <div class="mb-3 col-lg-6">
                    {!! Form::label(null, 'Data Iinício', ['class'=>'form-label']) !!}
                    <div class="input__date">
                        <input type="date" name="start_date" value="{{isset($banner->start_date)?$banner->start_date:''}}">
                    </div>
                </div>

                <div class="mb-3 col-lg-6">
                    {!! Form::label(null, 'Data Final', ['class'=>'form-label']) !!}
                    <div class="input__date">
                        <input type="date" name="end_date" value="{{isset($banner->end_date)?$banner->end_date:''}}">
                    </div>
                </div>
                <div class="mb-3">
                    {!! Form::label(null, 'Link', ['class'=>'form-label']) !!}
                    {!! Form::text('link', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
                </div>

            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
    <div class="row col-lg-12">
        <div class="col-12 col-lg-6">
            <div class="card card-body">
                <div class="row">
                    <div class="mb-3 col-lg-12">
                        {!! Form::label('path_image', 'Imagem desktop', ['class'=>'form-label']) !!}
                        {!! Form::file('path_image', [
                            'data-plugins'=>'dropify',
                            'data-height'=>'160',
                            'data-max-file-size-preview'=>'2M',
                            'accept'=>'image/*',
                            'data-default-file'=> isset($banner)?$banner->path_image<>''?url('storage/'.$banner->path_image):'':'',
                        ]) !!}
                    </div>
                    <span class="alert alert-warning" role="alert">OBS: Dimensões do banner: 1440 x 684</span>
                </div>
                <div class="mb-3 form-check">
                    {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                    {!! Form::label('active', 'Ativar banner?', ['class'=>'form-check-label']) !!}
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
        <div class="col-12 col-lg-6">
            <div class="card card-body">
                <div class="row">
                    <div class="mb-3 col-lg-12">
                        {!! Form::label('path_image_mobile', 'Imagem mobile', ['class'=>'form-label']) !!}
                        {!! Form::file('path_image_mobile', [
                            'data-plugins'=>'dropify',
                            'data-height'=>'205',
                            'data-max-file-size-preview'=>'2M',
                            'accept'=>'image/*',
                            'data-default-file'=> isset($banner)?$banner->path_image_mobile<>''?url('storage/'.$banner->path_image_mobile):'':'',
                        ]) !!}
                    </div>
                    <span class="alert alert-warning" role="alert">OBS: Dimensões do banner: 600 x 380</span>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
</div>
<!-- end row -->
