@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">


		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.users.store')}}">
		@csrf

		<div class="col-12 col-lg-8 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>	إضافة جديد
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3">

            <livewire:city />
			<div class="col-12 p-2">
				<div class="col-12">
					الاسم
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name" required minlength="3"  maxlength="190" class="form-control" value="{{old('name')}}" >
				</div>
			</div>

			<div class="col-12 p-2">
				<div class="col-12">
					البريد
				</div>
				<div class="col-12 pt-3">
					<input type="email" name="email"  class="form-control"  value="{{old('email')}}" >
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
					كلمة المرور
				</div>
				<div class="col-12 pt-3">
					<input type="password" name="password"  class="form-control" required minlength="8" >
				</div>
			</div>

			<div class="col-12 p-2">
				<div class="col-12">
					الصورة الشخصية
				</div>
				<div class="col-12 pt-3">
					<input type="file" name="avatar"  class="form-control"  accept="image/*" >
				</div>
				<div class="col-12 p-0">

				</div>
			</div>

			<div class="col-12 p-2">
				<div class="col-12">
					الهاتف
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="phone"   maxlength="190" class="form-control"  value="{{old('phone')}}" >
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
					الدور
				</div>
				<div class="col-12 pt-3">
					<select class="form-control" name="power">
						<option selected hidden value="" >إختر الدور</option>
						<option @selected(old('power')=="ADMIN") value="ADMIN">مسؤول</option>
						<option @selected(old('power')=="USER") value="USER">مستخدم</option>
					</select>
				</div>
			</div>
			<div class="col-12 p-2" hidden role-container>
				<div class="col-12">
					صلاحية الإدارة
				</div>
				<div class="col-12 pt-3">
					<select class="form-control" name="role">
						<option selected hidden value="" >إختر الصلاحية</option>
						@foreach ($roles as $role)
							<option value="{{$role->name}}" @checked(old('role') == $role->name)>{{$role->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
					نبذة
				</div>
				<div class="col-12 pt-3">
					<textarea  name="bio" maxlength="5000" class="form-control" style="min-height:150px">{{old('bio')}}</textarea>
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
					محظور
				</div>
				<div class="col-12 pt-3">
					<select class="form-control" name="blocked">
						<option @if(old('blocked')=="0") selected @endif value="0">لا</option>
						<option @if(old('blocked')=="1") selected @endif value="1">نعم</option>
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

@section('scripts')
	<script>
		function toggleRoleVisibility() {
			const power = $("[name=power]").val();

			if(power == 'ADMIN') {
				$("[role-container]").removeAttr('hidden');
			} else {
				$("[role-container]").attr('hidden', true);
			}
		}

		$("[name=power]").on('change', () => {toggleRoleVisibility()});
		toggleRoleVisibility();
	</script>
@endsection
