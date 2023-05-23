@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 main-box">
            <div class="col-12 px-0">
                <div class="col-12 px-0">
                    <div class="col-12 p-0 row">
                        <div class="col-12 col-lg-4 py-3 px-3">
                            عرض بيانات المندوب
                        </div>
                        <div class="col-12 col-lg-4 p-2">
                        </div>
                        <div class="col-12 col-lg-4 p-2 text-lg-end">
                            @can('create',\App\Models\Representative::class)
                                <a href="{{route('admin.representatives.create')}}">
                                    <span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة مندوب</span>
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
        
                <div class="col-12 py-3 px-3">

                    <div class="mb-3">
                        <label for="name" class="form-label">الاسم:</label>
                        <p>{{$representative->name}}</p>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">الهاتف:</label>
                        <p>{{'+' . $representative->country?->phone_code . $representative->phone}}</p>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">الدولة:</label>
                        <p>{{$representative->country?->name}}</p>
                    </div>
                    @if ($representative->photo)
                        <div class="mb-3">
                            <label for="photo" class="form-label">الصورة الشخصية:</label>
                            <a data-fancybox="gallery" href="{{$representative->photoUrl()}}">
                                <img src="{{$representative->photoUrl()}}" alt="{{$representative->name}}" width="50" height="50">
                            </a>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="description" class="form-label">الوصف:</label>
                        <p>{{$representative->description}}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection