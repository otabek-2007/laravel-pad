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
                <th>{{ __('messages.amount') }}</th>
                <th>{{ __('messages.phone') }}</th>
                <th>{{ __('messages.given_date') }}</th>
                <th>{{ __('messages.receipt_date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($debtors as $debtor)
            <tr>
                <td>{{ $debtor->name }}</td>
                <td>{{ $debtor->address }}</td>
                <td>{{ $debtor->amount }}</td>
                <td>{{ $debtor->phone_number }}</td>
                <td>{{ $debtor->date_of_issue }}</td>
                <td>{{ $debtor->date_of_acceptance }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endif
</div>
@endsection