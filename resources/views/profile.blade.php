@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Profile</div>

                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Following</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Profile Picture</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            Manage your profile
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @foreach ($followings as $follow)
                                <div class="card" style="width: 18rem;">
                                    <a href="{{ route('user.album', [$follow->userfollow->id]) }}">
                                        <img src="{{ Storage::url($follow->userfollow->profilePic) }}" 
                                        class="card-img-top" alt="...">
                                    </a>
                                    <div class="card-body">
                                    <h5 class="card-title">Following User:</h5>
                                    <p class="card-text">{{ $follow->userfollow->name }}</p>
                                    <p>
                                        @if (auth()->user()->id != $userId)
                                            <follow 
                                                user-id="{{ $userId }}"
                                                follows="{{ $follows }}"
                                            />
                                        @endif
                                    </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
