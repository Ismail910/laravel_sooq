@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.transactions.store')}}">
		@csrf

		<div class="col-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
                    <span class="fas fa-info-circle"></span>معاملة جديدة
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3">
                <div class="col-12 p-2">
                    <div class="col-12">
                        المستخدم
                        <span style="color:red;font-size:16px">*</span>
                    </div>
                    <div class="col-12 pt-3">
                        <select name="user_id" class="form-control select2-select">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected($user->id == old('user_id'))>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 p-2">
                    <div class="col-12">
                        القيمة
                        <span style="color:red;font-size:16px">*</span>
                    </div>
                    <div class="col-12 pt-3">
                        <input type="number" name="amount" class="form-control"  value="{{old('amount')}}">
                    </div>
                </div>
			</div>

		</div>

		<div class="col-12 p-3">
			<button class="btn btn-success" id="submitEvaluation">ارسال</button>
		</div>
		</form>
	</div>
</div>
@endsection