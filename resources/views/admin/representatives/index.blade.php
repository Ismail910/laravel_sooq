@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">

		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-users"></span>	المناديب
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

		<div class="col-12 py-2 px-2 row">
			<div class="col-12 col-lg-4 p-2">
				<form method="GET" filter-form>
					<div class="d-flex align-items-center" style="gap:15px">
                        <input type="text" name="filter" class="form-control" placeholder="بحث ... " value="@if(isset($filter) && $filter){{$filter}}@endif">

                        <select name="country_filter" class="form-control select2-select" id="country">
                                <option value="" selected>اختر</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" @selected(isset($country_filter) && $country_filter == $country->id)>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
				</form>
			</div>
		</div>
		<div class="col-12 p-3" style="overflow:auto">
			<div class="col-12 p-0" style="min-width:1100px;">


			<table class="table table-bordered  table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>الاسم</th>
						<th>الهاتف</th>
						<th>الدولة</th>
						<th>تحكم</th>
					</tr>
				</thead>
				<tbody>
					@foreach($representatives as $representative)
					<tr>
						<td>{{$representative->id}}</td>
						<td>{{$representative->name}}</td>
						<td>{{ '+' .$representative->country?->phone_code . $representative->phone }}</td>
						<td>{{$representative->country?->name}}</td>
						<td>
							@can('view', $representative)
                                <a href="{{route('admin.representatives.show', $representative)}}">
                                    <span class="btn  btn-outline-primary btn-sm font-1 mx-1">
                                        <span class="fas fa-search "></span> عرض
                                    </span>
                                </a>
							@endif
							@can('update', $representative)
								<a href="{{route('admin.representatives.edit', $representative)}}">
									<span class="btn  btn-outline-success btn-sm font-1 mx-1">
										<span class="fas fa-wrench "></span> تحكم
									</span>
								</a>
							@endif
							@can('delete', $representative)
								<form method="POST" action="{{route('admin.representatives.destroy', $representative)}}" class="d-inline-block">@csrf @method("DELETE")
									<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
										<span class="fas fa-trash "></span> حذف
									</button>
								</form>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
		<div class="col-12 p-3">
			{{-- {{$representative->links()}} --}}
		</div>
	</div>
</div>
@endsection

@section('scripts')
    <script>
        $("#country").on('change input', () => {
            $("[filter-form]").submit();
        });
    </script>
@endsection