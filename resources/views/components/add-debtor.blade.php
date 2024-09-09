@extends('dashboard')

@section('content')
<div class="container mt-4">
    <h2>{{__('messages.add_debtors_form')}}</h2>

    <!-- Add Debtor Form -->
    <form action="{{ route('debtors.store') }}" method="POST" class="add-debtor-form">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('messages.name') }}:</label>
            <input type="text" id="name" name="name" class="form-control" required placeholder="{{ __('messages.name') }}">
        </div>

        <div class="form-group">
            <label for="address">{{ __('messages.address') }}:</label>
            <input type="text" id="address" name="address" class="form-control" required placeholder="{{ __('messages.address') }}">
        </div>
        <div class="form-group">
            <label for="amount">{{ __('messages.amount') }}:</label>
            <input type="number" id="amount" name="amount" class="form-control" required placeholder="{{ __('messages.amount') }}">
        </div>

        <div class="form-group">
            <label for="phone">{{ __('messages.phone') }}:</label>
            <input id="phone" name="phone" class="form-control">
        </div>
        <div class="form-group">
            <label for="given_date">{{ __('messages.given_date') }}:</label>
            <input type="date" id="given_date" name="given_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="receipt_date">{{ __('messages.receipt_date') }}:</label>
            <input type="date" id="receipt_date" name="receipt_date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.add_debtor') }}</button>
    </form>

</div>
@endsection