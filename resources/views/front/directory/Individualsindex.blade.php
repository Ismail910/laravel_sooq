@extends('layouts.app')
@section('content')
{{-- Add Button --}}
@if(Auth::user())<div style="margin-bottom: 5rem;"><a href="{{route("front.individual.create")}}" class="btn btn-primary" style="@if(app()->getlocale() == 'ar') float: left @else float: right @endif;margin: 2rem 0 0 2rem">{{__('lang.AddYourPage')}}</a></div>@endif

<div class="container pt-3">
    
    @foreach($individuals as $person)
    <div class="store row py-3" style="margin-bottom: 2rem !important">
        <a href="{{route('front.directory.show',$person->id)}}" style="display: flex">
            <div class="store-img col-3 col-sm-2 me-3" style="height: 100px;">
                <img src="{{$person->img ? asset("storage/uploads/directory/$person->img") :  asset("images/default/image.jpg")}}" alt="store-img" style="height: 100%;object-fit: contain">
        </div>
        <div class="store-data col" style="display: grid">
            <h3 class="title name" style="font-size: 20px;">{{ $person->name }}</h3>
            <div class="description" style="color: #aaa;width: 80%;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"> {{$person->description}}</div>
            <div class="number">{{__("lang.phone")}}: {{$person->phone}}</div>
            <div class="city">{{__("lang.Country")}}: {{ $person->city ? $person->city->country->name . ' - ' . $person->city->name : '' }}</div>
    </div>
    </a>
</div>
@endforeach
</div>

@endsection