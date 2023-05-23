@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 main-box">
            <div class="col-12 px-0">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        إضافة مندوب
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <div class="col-12 py-3 px-3">
                    <form method="POST" action="{{route('admin.representatives.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم <span style="color:red;font-size:16px">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">الهاتف (بدون كود الدولة) <span style="color:red;font-size:16px">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">الدولة <span style="color:red;font-size:16px">*</span></label>
                            <select class="form-select select2-select" aria-label="Default select example" id="country" name="country_id">
                                <option selected>اختر الدولة</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" @selected(old('country_id') == $country->id)>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">الصورة الشخصية <span style="color:red;font-size:16px">*</span></label>
                            <input type="file" class="form-control" id="photo" name="photo" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">الوصف <span style="color:red;font-size:16px">*</span></label>
                            <textarea class="form-control" id="description" name="description" required>{{old('description')}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
