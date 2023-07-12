@extends('master')

@section('content')
    <div class="container padding">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="text-primary my-2">Berita</div>
        <div class="row">
            @forelse ($news as $item)
                <div class="col-4">
                    <div class="card px-2 py-2">
                        <img src="{{asset('/uploads/'.$item->thumbnail)}}" class="card-img-top" width="100%" height="200px" alt="...">
                        <div class="card-body">
                            <h1 >{{$item->title}}</h1>
                            <p class="card-text">{{Str::limit($item->content, 100) }}</p>
                            <small>{{$item->created_at->diffForHumans()}}</small>
                            <a href="/news/{{$item->id}}" class="btn btn-primary btn-block">Read More</a>
                            <div class="row my-2">
                                <div class="col">
                                    <a href="/news/{{ $item->id }}/edit" class="btn btn-warning btn-block btn-sm">Edit</a>
                                </div>
                                <div class="col">
                                    <form action="/news/{{ $item->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger btn-block btn-sm">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h3>Tidak Ada berita</h3>
            @endforelse
        </div>
    </div>
@endsection