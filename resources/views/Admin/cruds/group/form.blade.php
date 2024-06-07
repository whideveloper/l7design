<div class="card card-body">
    <div class="row">
        <input type="hidden" name="guard_name" value="web">
        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Nome', ['class'=>'form-label']) !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'validationCustom01', 'required'=>'required']) !!}
        </div>
    </div>
</div> <!-- end card-body-->
<div class="card card-body">
    <ul class="w-100 h-100 ps-0" style="column-count: 4">
        @php
            $last_index = '';
        @endphp
        @foreach($permissions as $permission)
            <li style="list-style:none;">
                <div class="mb-1 mt-1">
                    @if($last_index!==$permission->index())
                        {{ucfirst($permission->index())}}:
                    @endif
                </div>
                <ul class="mt-0">
                    <li class="">
                        <label>
                            {{ucfirst($permission->name())}}
                            <input name="permissions[]"
                                   type="checkbox"
                                   @if(isset($role) && $role->hasPermissionTo($permission->name)) checked @endif
                                   value="{{$permission->name}}">
                        </label>
                    </li>
                </ul>
            </li>
            @php
                $last_index = $permission->index();
            @endphp
        @endforeach
    </ul>
</div>