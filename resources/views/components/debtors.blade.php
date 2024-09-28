@extends('dashboard')

@section('content')
<div class="container" style="margin-top: 30px;">
    <h1>{{__('messages.debdors')}}</h1>

    @if(is_null($debtors))
    <p>{{__('messages.debdors_not_found')}}.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.address') }}</th>
                <th>{{ __('messages.phone') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($debtors as $debtor)
            <tr>
                <td><a href="{{ url('/debtor/payment/' . $debtor->id) }}">{{ $debtor->name }}</a></td>
                <td>{{ $debtor->address }}</td>
                <td>{{ $debtor->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endif
</div>
@endsection