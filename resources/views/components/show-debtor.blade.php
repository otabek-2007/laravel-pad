@extends('dashboard')

@section('content')
<div class="container mt-4">
    <!-- Debtor Name -->
    <h1>{{ $debtor->name }}</h1>

    <!-- Payments Table -->
    <div class="mt-4">
        <h2>{{ __('messages.payments') }}</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.amount') }}</th>
                    <th>{{ __('messages.currency') }}</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($debtor->payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->currency->name }}</td>
                    <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">{{ __('messages.debdors_not_found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Total Calculation -->
        @php
        $exchangeRate = 13000; // Exchange rate from USD to UZS

        $totalInDollar = 0;
        $totalInSom = 0;

        foreach ($debtor->payments as $payment) {
        $amount = is_numeric($payment->amount) ? $payment->amount : 0;

        if ($payment->currency_id == 1) {
        // Amount is in UZS, convert to dollars
        $totalInDollar += $amount / $exchangeRate;
        // Sum in som
        $totalInSom += $amount;
        } else if ($payment->currency_id == 2) {
        // Amount is in dollars
        $totalInDollar += $amount;
        // Convert to som
        $totalInSom += $amount * $exchangeRate;
        }
        }

        // Format totals
        $formattedTotalInDollar = number_format($totalInDollar, 2);
        $formattedTotalInSom = number_format($totalInSom, 2);
        @endphp

        <h6>Your total price in dollars = {{ $formattedTotalInDollar }}</h6>
        <h6>Your total price in som = {{ $formattedTotalInSom }}</h6>
    </div>
</div>
@endsection