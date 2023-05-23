@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">

		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-users"></span>&nbsp;ادارة المحافظ
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					@can('create',\App\Models\Transaction::class)
                        <a href="{{route('admin.transactions.create')}}">
                            <span class="btn btn-primary"><span class="fas fa-plus"></span> إنشاء معاملة</span>
                        </a>
					@endcan
				</div>
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>

        <form id="validate-form" class="col-12 py-2 px-2 row" enctype="multipart/form-data" method="POST" action="{{ route('admin.user.transactions') }}">
            @csrf
            <div class="col-12 p-2">
                <div class="col-12 p-2">
                    <div class="col-12">
                        المستخدم
                    </div>
                    <div class="col-12 pt-3">
                        <select name="user_id" class="form-control select2-select">
                            @foreach ($users as $record)
                                <option value="{{ $record->id }}" @if((isset($user) && $record->id == $user->id) || $record->id == old('user_id')) selected @endif>{{ $record->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">ارسال</button>
            </div>
        </form>

        @if(isset($user))
            <div class="col-12 p-3" style="overflow:auto">
                <div class="col-12 p-0" style="min-width:1100px;">
                <table class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم المعاملة</th>
                            <th>المبلغ</th>
                            <th>نوع المعاملة</th>
                            <th>الوقت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!count($transactions))
                            <tr class="text-center">
                                <td colspan=5><b>لا يوجد معاملات حتي الآن</b></td>
                            </tr>
                        @endif
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$transaction->transaction_id}}</td>
                                <td>{{$transaction->amount}}</td>
                                <td>{{$transaction->type}}</td>
                                <td>{{date("l d M Y, H:i", strtotime($transaction->created_at))}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <div class="col-12 p-3">
                {{$transactions->links()}}
            </div>
        @endif
	</div>
</div>

<script>
    document.querySelectorAll(".pagination a.page-link[href]").forEach(el => el.href = el.href + "&user_id=" + document.querySelector("[name=user_id] option[selected]").value );

</script>
@endsection
