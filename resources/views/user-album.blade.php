@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">

        @if (Auth::check() && auth()->user()->bgpic)
            <img src="{{ Storage::url(auth()->user()->bgpic) }}" >
        @else
            <img src="{{ asset('banner') }}/gojo.png" style="width: 100%" alt="">
        @endif

    </div>
    
    @if (Auth::check() && auth()->user()->id!=$userId)
        <follow
            user-id="{{ $userId }}"
            follows="{{ $follows }}"
        />
    @endif

    <div class="row">
        @foreach($albums as $album)
            
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('album') }}/{{ $album->image }}" class="card-img-top" alt="">
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title">
                            <center>{{ $album->name }}</center>
                        </h5>
                        <center>
                            <a href="{{ route('view.album', [$album->slug, $album->id]) }}" class="btn btn-primary">View Album</a>
                        </center>
                    </div>
                </div>    
            </div>

        @endforeach
    </div>
</div>
@endsection
