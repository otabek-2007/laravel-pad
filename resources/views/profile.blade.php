@extends('dashboard')

@section('content')
<div class="container">
    <h1>{{ __('messages.profile') }}</h1>

    <div class="profile-info">
        <p><strong>{{ __('messages.name') }}:</strong> {{ $user->name }}</p>
        <p><strong>{{ __('messages.email') }}:</strong> {{ $user->email }}</p>
        <p><strong>{{ __('messages.phone') }}:</strong> {{ $user->phone_number ?? __('messages.not_provided') }}</p>
        <p><strong>{{ __('messages.address') }}:</strong> {{ $user->address ?? __('messages.not_provided') }}</p>
    </div>

   
</div>
@endsection