@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left"></div>
                <h2>Overzicht Reservering</h2>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-4 offset-lg-8">
            <form action="{{ route('reserveringoverzicht.filter') }}" method="GET" class="form-inline">
                <div class="form-group">
                    <label for="datum" class="mr-2">Selecteer datum:</label>
                    <select name="datum" id="datum" class="form-control mr-2">
                        <option value="">Selecteer datum</option>
                        @if($reservering && is_iterable($reservering))
                            @foreach ($reservering as $item)
                                <option value="{{ $item->datum }}">{{ $item->datum }}</option>
                            @endforeach
                        @endif
                    </select>
                    <button type="submit" class="btn btn-primary">Tonen</button>
                </div>
            </form>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
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
        @if($reservering && is_iterable($reservering))
            @foreach ($reservering as $item)
            <tr>
                <td>{{ $item->persoon->voornaam ?? 'N/A' }}</td>
                <td>{{ $item->persoon->tussenvoegsel ?? 'N/A' }}</td>
                <td>{{ $item->persoon->achternaam ?? 'N/A' }}</td>
                <td>{{ $item->datum ?? 'N/A' }}</td>
                <td>{{ $item->uren ?? 'N/A' }}</td>
                <td>{{ $item->aantalvolwassen ?? 'N/A' }}</td>  
                <td>{{ $item->aantalkinderen ?? 'N/A' }}</td> 
                <td>
                    @if($item->status_id)
                        @switch($item->status->id)
                        @case(1)
                        <span class="badge bg-success text-dark">{{ $item->status->name }}</span>    
                        @break
                        @case(2)
                        <span class="badge bg-warning text-dark">{{ $item->status->name }}</span>
                        @break
                        @case(3)
                        <span class="badge bg-danger text-dark">{{ $item->status->name }}</span>
                        @break
                        @default
                        <span class="badge bg-secondary text-dark">{{ $item->status->name }}</span>
                        @endswitch
                    @else
                        <span class="badge bg-secondary text-dark">N/A</span>
                    @endif   
                </td>                 
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">Geen reserveringen gevonden.</td>
            </tr>
        @endif
    </table>
@endsection