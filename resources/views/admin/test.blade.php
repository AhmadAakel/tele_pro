@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h2>Channel Settings</h2>
        </div>
        <div class="card-body">
            @foreach($channels as $channel)
            <div class="card">
                <div class="card-header">
                    Quote
                </div>
                <div class="card-body">
                    <figure>
                        <blockquote class="blockquote">
                            <p>{{ $channel->telegram_channel_url }}</p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            Someone famous in <cite title="Source Title">{{ $channel->comment }}</cite>
                        </figcaption>
                        <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" id="active{{ $channel->id }}" {{ $channel->is_active ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="active{{ $channel->id }}">Active</label>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-secondary">User Count: {{ $channel->users_count }}</span>
                        <a href="{{ route('admin.channel.users', $channel->id) }}" class="btn btn-sm btn-info">View Users</a>
                    </div>
                    </figure>
                </div>
            </div>
            <!-- <div class="mb-3">
                <form action="{{ route('admin.channel.update', $channel->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <input type="url" name="telegram_channel_url" class="form-control" value="{{ $channel->telegram_channel_url }}" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="comment" placeholder="Your Comment" class="form-control" value="{{ $channel->comment }}">
                    </div>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    
                    <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" id="active{{ $channel->id }}" {{ $channel->is_active ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="active{{ $channel->id }}">Active</label>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-secondary">User Count: {{ $channel->users_count }}</span>
                        <a href="{{ route('admin.channel.users', $channel->id) }}" class="btn btn-sm btn-info">View Users</a>
                    </div>
                </form>
            </div> -->


            @endforeach
        </div>
    </div>
</div>
@endsection