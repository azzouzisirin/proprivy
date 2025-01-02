@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Authorization for Rent Collection</h2>
    <form method="POST" action="{{ route('authorizations.update') }}">
        @csrf
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_authorized" name="is_authorized" {{ $authorization->is_authorized ? 'checked' : '' }}>
            <label class="form-check-label" for="is_authorized">
                I authorize ProPrivy to collect rents on my behalf.
            </label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>
@endsection
