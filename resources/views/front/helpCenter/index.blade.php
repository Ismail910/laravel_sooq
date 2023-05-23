@extends('layouts.app')
@section('content')

<div class="mx-3 my-5"><h3>{{ __("lang.HelpCenter")}} </h3></div>
<div class="container row">
    @foreach ($videos as $video)
        <div class="col-sm-4">
            <iframe style="width: 100%; height: 250px; border-radius: 10px ;cursor: pointer;" data-bs-target="#exampleModal" src="{{ "https://www.youtube.com/embed/" . explode('youtu.be/', $video->link)[1]; }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            
            <h5 class="title fw-bold">{{json_decode($video->title,true)[app()->getLocale()]}}</h5>
            <span class="title" style="font-size: 13px">{{json_decode($video->subtitle,true)[app()->getLocale()] ?? ""}}</span>
        </div>
        @endforeach
    <div class="whatsapp" style="">
        <a href="#"><img style="position: fixed;bottom: 50px;width: 80px;height: 80px;left: 40px;cursor: pointer;" src="{{ asset('images/default/whatsapp-icon.png')}}" alt=""></a>
    </div>
</div>
@endsection