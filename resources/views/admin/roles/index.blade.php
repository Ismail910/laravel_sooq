@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">

		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-users"></span>	الصلاحيات
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					@can('create',\App\Models\Role::class)
                        <a href="{{route('admin.roles.create')}}">
                            <span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة صلاحية</span>
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
						<th>اسم الصلاحية</th>
						<th>تحكم</th>
					</tr>
				</thead>
				<tbody>
					@foreach($roles as $role)
					<tr>
						<td>{{$role->id}}</td>
						<td>{{$role->name}}</td>
						<td>
							@can('update', $role)
                                <a href="{{route('admin.roles.edit', $role)}}">
                                <span class="btn  btn-outline-success btn-sm font-1 mx-1">
                                    <span class="fas fa-wrench"></span> تحكم
                                </span>
                                </a>
							@endif
							@can('delete', $role)
                                <form method="POST" action="{{route('admin.roles.destroy', $role)}}" class="d-inline-block">@csrf @method("DELETE")
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
			{{-- {{$roles->links()}} --}}
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