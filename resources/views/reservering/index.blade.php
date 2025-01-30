@extends('layouts.app')

@section('content')
    {{-- Page Header --}}
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left"></div>
                <h2>Overzicht Reservering - Pakketoptie</h2>
            </div>
        </div>
    </div>
   
    {{-- Display success message if available --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    {{-- Table displaying reservation details --}}
    <table class="table table-striped">
        <tr>
            {{-- Table headers for reservation details --}}
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Datum</th>
            <th>Volwassen</th>
            <th>Kinderen</th>
            <th>Optiepakket</th>
            <th width="280px">wijzigen</th>
        </tr>

        {{-- Loop through each reservation and display its details --}}
        @foreach ($reserveringen as $reservering)
        <tr>
            {{-- Display personal details --}}
            <td>{{ $reservering->persoon->voornaam }}</td>
            <td>{{ $reservering->persoon->tussenvoegsel }}</td>
            <td>{{ $reservering->persoon->achternaam }}</td>

            {{-- Display reservation date --}}
            <td>{{ $reservering->datum }}</td>

            {{-- Display number of adults and children --}}
            <td>{{ $reservering->aantalvolwassen }}</td>  
            <td>{{ $reservering->aantalkinderen }}</td> 

            {{-- Display the name of the selected package option --}}
            <td>{{ $reservering->pakketoptie->naam }}</td>

            {{-- Actions column for editing the reservation --}}
            <td>
                {{-- CSRF token for form submission --}}
                @csrf

                {{-- Method directive for specifying the HTTP verb --}}
                @method('PUT')
      
                {{-- Link to the edit route for the reservation --}}
                <a href="{{ route('reservering.edit', $reservering->id) }}" class="btn btn-primary">Edit</a>
            </td>
        </tr>
        @endforeach
    </table>      
@endsection
