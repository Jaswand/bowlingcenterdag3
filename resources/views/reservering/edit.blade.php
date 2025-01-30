@extends('layouts.app')

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            {{-- Card structure for displaying the package option details --}}
            <div class="card">
                <div class="card-header">
                    <h3>Details Pakketoptie</h3>
                </div>
                <div class="card-body">
                    {{-- Display error message if any --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Form to update the selected package option --}}
                    <form method="POST" action="{{ route('reservering.update', $reservering->id) }}">
                        {{-- CSRF protection and HTTP method spoofing for PUT request --}}
                        @csrf
                        @method('PUT')

                        {{-- Hidden input for the number of children, preserving current value --}}
                        <input type="hidden" name="aantalkinderen" value="{{ $reservering->aantalkinderen }}">

                        {{-- Dropdown for selecting a package option --}}
                        <label for="pakketoptie_id">Pakketoptie</label>
                        <select id="pakketoptie_id" name="pakketoptie_id" class="form-control @error('pakketoptie_id') is-invalid @enderror form-select" required autofocus>
                            {{-- Placeholder option --}}
                            <option selected value="">Kies optie</option>
                            {{-- List of package options with dynamic selection based on current value --}}
                            <option value="1" @if(old('pakketoptie_id', $reservering->pakketoptie_id) == '1') selected @endif>Basis Snackpakket</option>
                            <option value="2" @if(old('pakketoptie_id', $reservering->pakketoptie_id) == '2') selected @endif>Luxe Snackpakket</option>
                            <option value="3" @if(old('pakketoptie_id', $reservering->pakketoptie_id) == '3') selected @endif>Kinderpartij</option>
                            <option value="4" @if(old('pakketoptie_id', $reservering->pakketoptie_id) == '4') selected @endif>Vrijgezellenfeest</option>
                        </select>

                        {{-- Error message for invalid package option --}}
                        @error('pakketoptie_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>

                        {{-- Submit button for updating the reservation --}}
                        <button type="submit" class="btn btn-primary">Wijzigen</button>
                    </form>

                    {{-- Back button to return to the reservation overview --}}
                    <a href="{{ route('reserveren') }}" class="btn btn-secondary mt-2">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
