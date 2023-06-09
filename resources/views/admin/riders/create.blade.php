@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">


		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.riders.store')}}">
		@csrf

		<div class="col-12 col-lg-8 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>	إضافة جديد
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
                <div class="col-12 col-lg-6 p-2">
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
                                    الاسم
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="text" name="{{ $key }}[name]" required class="form-control">
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>

                <div class="col-12 p-2">
                    <div class="col-12">
                        الفيديو
                    </div>
                    <div class="col-12 pt-3">
                        <input type="file" name="link" requiredclass="form-control" accept="video/*">
                    </div>
                    <div class="col-12 pt-3">

                    </div>
                </div>
                    <div class="col-12  p-2">
                        <div class="col-6">
                            <div>
                                تصنيف الفيديو
                            </div>
                            <div class=" pt-3">
                                <input type="text" name="vid_category" id="vid_category" class="form-control">
                            </div>
                        </div>
                    </div>
                <div class="col-12 col-lg-6 p-2">
                    <div class="col-12">
                        حالة الظهور
                    </div>
                    <div class="col-12 pt-3">
                        <select class="form-control" name="hidden" required>
                            <option selected value="0">اخفاء</option>
                            <option value="1">ظهور</option>
                        </select>
                    </div>
                </div>
			</div>
		</div>

		<div class="col-12 p-3">
			<button class="btn btn-success" id="submitEvaluation">حفظ</button>
		</div>
		</form>
	</div>
</div>

@endsection