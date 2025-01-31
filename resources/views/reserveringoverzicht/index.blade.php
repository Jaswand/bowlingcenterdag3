@extends('layouts.app')

@section('content')
    {{-- Page Header --}}
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left"></div>
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
                <input type="date" id="datum" name="datum" required>
                <button type="submit" class="btn btn-primary">Tonen</button>
            </form>
        </div>
    </div>

    {{-- Success Message --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- Error Message --}}
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- Reservation Table --}}
    <table class="table table-striped">
        <tr>
            {{-- Table headers for reservation details --}}
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Reseveringsdatum</th>
            <th>Uren</th>
            <th>Volwassen</th>
            <th>Kinderen</th>
            <th>Status</th>
        </tr>

        {{-- Check if there are any reservations to display --}}
        @if($reservering && is_iterable($reservering))
            {{-- Loop through each reservation and display details --}}
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
                                {{-- Green badge for status 1 --}}
                                <span class="badge bg-success text-dark">{{ $item->reserveringstatus->naam }}</span>    
                                @break
                            @case(2)
                                {{-- Yellow badge for status 2 --}}
                                <span class="badge bg-warning text-dark">{{ $item->reserveringstatus->naam }}</span>
                                @break
                            @case(3)
                                {{-- Red badge for status 3 --}}
                                <span class="badge bg-danger text-dark">{{ $item->reserveringstatus->naam }}</span>
                                @break
                            @default
                                {{-- Default grey badge for other statuses --}}
                                <span class="badge bg-secondary text-dark">{{ $item->reserveringstatus->naam }}</span>
                        @endswitch
                    @else
                        {{-- Display N/A if no status is set --}}
                        <span class="badge bg-secondary text-dark">N/A</span>
                    @endif   
                </td>                 
            </tr>
            @endforeach
        @else
            {{-- Display a message if no reservations are found --}}
            <tr>
                <td colspan="8">Geen reserveringen gevonden.</td>
            </tr>
        @endif
    </table>
@endsection
