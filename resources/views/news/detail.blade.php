@extends('master')

@section('content')
    <div class="container padding">
        <div class="row">
            <div class="col-4">
                <img src="{{ asset('/uploads/'.$news->thumbnail) }}" alt="" width="100%" alt="">
            </div>
            <div class="col-8">
                <h3 class="text-primary">{{ $news->title }}</h3>
                <p>{{ $news->content }}</p>
            </div>
        </div>
        <a href="/news" class="btn btn-secondary btn-block">Kembali</a>
    </div>
@endsection