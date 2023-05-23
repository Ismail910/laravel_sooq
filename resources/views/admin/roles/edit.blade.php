@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 main-box">
            <div class="col-12 px-0">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        إضافة صلاحية
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <div class="col-12 py-3 px-3">
                    <form method="POST" action="{{route('admin.roles.update', $role->id)}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $role->id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم <span style="color:red;font-size:16px">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">
                        </div>
                        <div class="mb-3 d-flex align-items-center flex-wrap">
                            @foreach($permissions as $permission)
                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex align-items-center justify-content-start" style="gap: 5px">
                                <input type="checkbox" class="form-check-input mb-2" name="permissions[]" value="{{$permission->id}}" @checked($role->hasPermission($permission->id))>
                                <label class="form-label">{{$permission->ar_name}}</label>
                            </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
