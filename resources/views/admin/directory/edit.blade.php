@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">


		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.directory.update', $directory)}}">
		@csrf
        @method('PUT')
		<div class="col-12 col-lg-8 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
                    <span class="fas fa-info-circle"></span> تعديل عنصر الدلبل المجاني
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
                <div class="col-12 p-3 row">
                    <div class="col-12 p-2">
                        <div class="col-12 p-2">
                            <div class="col-12">
                                <h3>ترجمة البيانات</h3>
                            </div>
                            <br />
                        </div>

                        {{-- More Language --}}
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @foreach (config("laravellocalization.supportedLocales") as $key => $lang)
                            <li class="nav-item mx-auto" role="presentation">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ $key }}-tab" data-bs-toggle="pill" href="#pills-{{ $key }}" role="tab" aria-controls="pills-{{ $key }}" aria-selected="true">{{ $lang['native'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                        @foreach (config("laravellocalization.supportedLocales") as $key => $lang)
                            <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="pills-{{ $key }}" role="tabpanel" aria-labelledby="pills-{{ $key }}-tab">
                                <div class="col-12 col-lg-12 p-2">
                                    <div class="col-12">
                                        اسم الشركة / الفرد
                                    </div>
                                    <div class="col-12 col-lg-12 pt-3">
                                        <input type="text" name="{{ $key }}[name]" required class="form-control" value="{{$directory->getTranslation('name', $key)}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-12">
                                        الوصف
                                    </div>
                                    <div class="col-12 pt-3 ">
                                        <textarea class="form-control" style="resize: none;" name="{{ $key }}[description]" required rows="5">{{ $directory->getTranslation('description', $key) }}</textarea>        
                                    </div>
                                </div>
                                <div class="col-12 p-2">
                                    <div class="col-12">
                                        العنوان
                                    </div>
                                    <div class="col-12 pt-3">
                                        <input type="text" name="{{ $key }}[address]" required class="form-control" value="{{$directory->getTranslation('address', $key)}}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="pt-3">
                            <div>
                                الصورة
                            </div>
                            <div class="pt-3 col-6">
                                <input type="file" name="img" id="img" class="form-control" accept="image/png, image/jpg, image/jpeg, image/webp">
                            </div>
                        </div>
                        @if($directory->img)
                            <img src="{{ asset('storage/uploads/directory/' . $directory->img) }}" width="250px" height="250px">
                        @endif
                    </div>
                </div>
            
            <div class="col-12 p-2">
                <div class="col-12">
                    رقم الهاتف           
                </div>
                <div class="col-6 pt-3">
                    <input type="number" name="phone" required class="form-control" value="{{$directory->phone}}">
                </div>
            </div>
            <div class="col-12 p-2">
                <div >
                    الدولة و المدينة
                </div>
                <livewire:city :country_id="$directory->city->country_id ?? null" :city_id="$directory->city->id ?? null" />
            </div>
            
            <div class="col-12 p-2">
                <livewire:category :category_id="$parent_category ?? null" :subcategory_id="$directory->category_id ?? null"/>
            </div>

            <div class="col-12 p-2">
                <div class="col-12">
                    نوع العنصر
                </div>
                <div class="col-6 pt-3">
                    <select name="type" id="type" class="form-control" required>
                        <option value="1" @if($directory->type == 1) selected @endif>فرد</option>
                        <option value="2" @if($directory->type == 2) selected @endif>شركة</option>
                    </select>
                </div>
            </div>
            
            <div class="col-12 p-2">
                <div >
                    السجل التجاري
                </div>
                <div class="col-6 pt-3">
                    <input type="file" name="license"  id="license" class="form-control" accept="image/png, image/jpg, image/jpeg, image/webp">
                </div>
                @if($directory->license)
                    <img src="{{ asset('storage/uploads/directory/' . $directory->license) }}" width="250px" height="250px">
                @endif
            </div>
            
            <div class="col-12 p-2">
                <div >
                    المستخدم
                </div>
                <div class="col-6 pt-3">
                    <select name="user_id" class="form-control">
                        @foreach($users AS $user)
                            <option value="{{ $user->id }}" @if($directory->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 p-2">
                <div >
                    اللغة
                </div>
                <div class="col-6 pt-3">
                    <select name="lang" class="form-control">
                        @foreach (config("laravellocalization.supportedLocales") as $key => $lang)
                            <option value="{{ $key }}" @if($directory->lang == $key) selected @endif>{{ $lang['native'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>
        </div>
		</form>
	</div>
</div>
@endsection