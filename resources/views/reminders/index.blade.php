@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Payment Reminders</h2>
    <ul>
        @foreach($reminders as $reminder)
            <li>
                Rent for {{ $reminder->rental->property_name }} is due on {{ $reminder->due_date }}.
            </li>
        @endforeach
    </ul>
</div>
@endsection