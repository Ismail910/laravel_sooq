@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">

		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-countries"></span> مركز المساعدة
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					@can('create', \App\Models\HelpCenter::class)
						<a href="{{route('admin.help-center.create')}}">
							<span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة جديد</span>
						</a>
					@endcan
				</div>
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>

		<div class="col-12 py-2 px-2 row">
			<div class="col-12 col-lg-4 p-2">
				<form method="GET">
					<input type="text" name="q" class="form-control" placeholder="بحث ... ">
				</form>
			</div>
		</div>
		<div class="col-12 p-3" style="overflow:auto">
			<div class="col-12 p-0" style="min-width:1100px;">
			<table class="table table-bordered  table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>العنوان</th>
						<th>التصنيف</th>
						<th>مخفي</th>
						<th>تحكم</th>
					</tr>
				</thead>
				<tbody>
					@php
						$count =1;
					@endphp
					@foreach($videos as $video)
					<tr>
						<td>{{$count++}}</td>

						<td>{{json_decode($video->title,true)[app()->getLocale()]}}</td>
						<td>{{$video->vid_category}}</td>
						<td>{{$video->hidden == 0 ? 'نعم' : 'لا'}}</td>

						<td>
							@can('update', $video)
								<a href="{{route('admin.help-center.edit',$video)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> تحكم
								</span>
								</a>
							@endcan
							@can('delete', $video)
								<form method="POST" action="{{route('admin.help-center.destroy',$video)}}" class="d-inline-block">
									@csrf @method("DELETE")
									<button class="btn btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
										<span class="fas fa-trash "></span> حذف
									</button>
								</form>
							@endcan
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
		<div class="col-12 p-3">
			{{$videos->appends(request()->query())->render()}}
		</div>
	</div>
</div>
@endsection