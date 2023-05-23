@extends('layouts.app')
@section('content')

{{-- Add Button --}}
@if(Auth::user())<div style="margin-bottom: 5rem;"><a href="{{route("front.store.create")}}" class="btn btn-primary" style="@if(app()->getlocale() == 'ar') float: left @else float: right @endif;margin: 2rem 0 0 2rem">{{__('lang.AddYourCompanyToFreeDirectory')}}</a></div>@endif
<div class="container pt-3">
    @foreach ($companies as $company)
        
    <div class="store row py-3" style="margin-bottom: 2rem !important">
        <a href="{{route('front.directory.show',$company->id)}}" style="display: flex">
            <div class="store-img col-3 col-sm-2 me-3" style="height: 100px;">
                <img src="{{$company->img ? asset("storage/uploads/directory/$company->img") :  asset("images/default/image.jpg")}}" alt="store-img" style="height: 100%;object-fit: contain">
        </div>
        <div class="store-data col" style="display: grid">
            {{-- Detect Filled Language --}}
            <h3 class="title name" style="font-size: 20px;">{{$company->name}}</h3>
            <div class="description" style="color: #aaa;width: 80%;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;">
            {{$company->description,true}}            
            </div>
            <div class="number">{{__("lang.phone")}}: {{$company->phone}}</div>
            <div class="city">{{__("lang.Country")}}: {{ $company->city ? $company->city->country->name . ' - ' . $company->city->name : '' }}</div>
            <div class="address">{{__("lang.Company Address")}} : {{$company->address}}</div>
        </div>
    </a>
</div>
@endforeach
<style>
    .store-data > * {
    font-size: 12px;
}
div.store-img{
    height: 120px;
}
div.store-img img {
        width: 200px;
        height: 200px;
    }
@media screen and (max-width: 1100px){
    div.store-img {
        height: 90px;
    }
    div.store-img img {
        width: 100px;
        height: 100px;
    }
}
</style>
 
</div>

@endsection