@extends('layouts.app')

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Details Pakketoptie</h3>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reservering.update', $reservering->id) }}">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="aantalkinderen" value="{{ $reservering->aantalkinderen }}">

                        <label for="pakketoptie_id">Pakketoptie</label>
                        <select id="pakketoptie_id" name="pakketoptie_id" class="form-control @error('pakketoptie_id') is-invalid @enderror form-select" required autofocus>
                            <option selected value="">Kies optie</option>
                            <option value="1" @if(old('pakketoptie_id', $reservering->pakketoptie_id) == '1') selected @endif>Basis Snackpakket</option>
                            <option value="2" @if(old('pakketoptie_id', $reservering->pakketoptie_id) == '2') selected @endif>Luxe Snackpakket</option>
                            <option value="3" @if(old('pakketoptie_id', $reservering->pakketoptie_id) == '3') selected @endif>Kinderpartij</option>
                            <option value="4" @if(old('pakketoptie_id', $reservering->pakketoptie_id) == '4') selected @endif>Vrijgezellenfeest</option>
                        </select>

                        @error('pakketoptie_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>

                        <button type="submit" class="btn btn-primary">Wijzigen</button>
                    </form>

                    <a href="{{ route('reserveren') }}" class="btn btn-secondary mt-2">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
