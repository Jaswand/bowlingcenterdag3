@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left"></div>
                <h2>Overzicht Reservering</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('reserveringoverzicht.filter') }}" method="GET" class="form-inline mb-3">
        <div class="form-group">
            <label for="datum">Selecteer datum:</label>
            <select name="datum" id="datum" class="form-control ml-2">
                <option value="">Selecteer datum</option>
                @foreach ($reservering as $reservering)
                    <option value="{{ $reservering->datum }}">{{ $reservering->datum }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary ml-2">Tonen</button>
    </form>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped">
        <tr>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Reseveringsdatum</th>
            <th>Uren</th>
            <th>Volwassen</th>
            <th>Kinderen</th>
            <th>Status</th>
        </tr>
        @foreach ($reservering as $reservering)
        <tr>
            <td>{{ $reservering->persoon->voornaam }}</td>
            <td>{{ $reservering->persoon->tussenvoegsel }}</td>
            <td>{{ $reservering->persoon->achternaam }}</td>
            <td>{{ $reservering->datum }}</td>
            <td>{{ $reservering->uren }}</td>
            <td>{{ $reservering->aantalvolwassen }}</td>  
            <td>{{ $reservering->aantalkinderen }}</td> 
            <td>{{ $reservering->status }}</td>
        </tr>
        @endforeach
    </table>
@endsection