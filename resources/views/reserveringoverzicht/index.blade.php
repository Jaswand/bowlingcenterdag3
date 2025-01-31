@extends('layouts.app')

@section('content')
    {{-- Page Header --}}
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Overzicht Reservering</h2>
            </div>
        </div>
    </div>

    {{-- Filter Form Section --}}
    <div class="row mb-3">
        <div class="col-lg-4 offset-lg-8">
            {{-- Form for filtering reservations by date --}}
            <form action="{{ route('reserveringoverzicht.filter') }}" method="GET">
                <label for="datum">Selecteer een datum:</label>
                <input type="date" id="datum" name="datum">
                <button type="submit" class="btn btn-primary">Tonen</button>
            </form>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    {{-- Display message when there are no reservations --}}
    @if ($reservering->isEmpty())
        <div class="alert alert-warning text-center">
            <strong>Er zijn geen reserveringen voor vandaag.</strong>
        </div>
    @endif

    {{-- Reservation Table --}}
    @if ($reservering->isNotEmpty()) 
        <table class="table table-striped">
            <thead>
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
            </thead>
            <tbody>
                @foreach ($reservering as $item)
                    <tr>
                        {{-- Display personal details with fallback to 'N/A' if data is missing --}}
                        <td>{{ $item->persoon->voornaam ?? 'N/A' }}</td>
                        <td>{{ $item->persoon->tussenvoegsel ?? 'N/A' }}</td>
                        <td>{{ $item->persoon->achternaam ?? 'N/A' }}</td>

                        {{-- Display reservation details --}}
                        <td>{{ $item->datum ?? 'N/A' }}</td>
                        <td>{{ $item->aantaluren ?? 'N/A' }}</td>
                        <td>{{ $item->aantalvolwassen ?? 'N/A' }}</td>
                        <td>{{ $item->aantalkinderen ?? 'N/A' }}</td>

                        {{-- Display reservation status with color-coded badges --}}
                        <td>
                            @if($item->reserveringstatus_id)
                                @switch($item->reserveringstatus->id)
                                    @case(1)
                                        <span class="badge bg-success text-dark">{{ $item->reserveringstatus->naam }}</span>    
                                        @break
                                    @case(2)
                                        <span class="badge bg-warning text-dark">{{ $item->reserveringstatus->naam }}</span>
                                        @break
                                    @case(3)
                                        <span class="badge bg-danger text-dark">{{ $item->reserveringstatus->naam }}</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary text-dark">{{ $item->reserveringstatus->naam }}</span>
                                @endswitch
                            @else
                                <span class="badge bg-secondary text-dark">N/A</span>
                            @endif   
                        </td>                  
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
