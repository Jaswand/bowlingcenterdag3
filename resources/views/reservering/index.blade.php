@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left"></div>
                <h2>Overzicht Reservering</h2>
            </div>
        </div>
    </div>
   
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
            <th>Datum</th>
            <th>Volwassen</th>
            <th>Kinderen</th>
            <th>Optiepakket</th>
            <th width="280px">wijzigen</th>
        </tr>
        @foreach ($reservering as $reservering)
        <tr>
            <td>{{ $reservering->persoon->voornaam }}</td>
            <td>{{ $reservering->persoon->tussenvoegsel }}</td>
            <td>{{ $reservering->persoon->achternaam }}</td>
            <td>{{ $reservering->datum }}</td>
            <td>{{ $reservering->aantalvolwassen }}</td>  
            <td>{{ $reservering->aantalkinderen }}</td> 
            <td>{{ $reservering->pakketoptie->naam }}</td>
            <td>
                    @csrf
                    @method('PUT')
      
                    <a href="{{ route('reservering.edit', $reservering->id) }}" class="btn btn-primary">Edit</a>

                </form>
            </td>
        </tr>
        @endforeach
    </table>      
@endsection