@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb row">
        <div class="col-9">
            <h3>Your Album</h3>
        </div>
        <div class="col-3">
            <span>
                <a href="{{ route('album.create') }}">
                   <button class="btn btn-primary">Create an Album</button>
                </a>
            </span>
        </div>
        
    </ol>
    <div class="row">
        <div class="col-md-12">
            <index />
        </div>
    </div>
</div>
@endsection