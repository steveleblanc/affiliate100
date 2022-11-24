@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">The following Affiliates</b> are invited to our Dublin office for some food and drinks.<br>Gambling.co Group. Fitzwilliam Court, 3rd Floor, Leeson Cl, Dublin 2, Ireland, +353 1 903 8375</div>
                <div class="card-body">
                    <div class="col-md-12">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Affiliate ID</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($affiliates as $affiliate)
                                <?Php             
                                    $theta = $officeLongitude - $affiliate->longitude; 
                                    $distance = (sin(deg2rad($officeLatitude)) * sin(deg2rad($affiliate->latitude))) + (cos(deg2rad($officeLatitude)) * cos(deg2rad($affiliate->latitude)) * cos(deg2rad($theta))); 
                                    $distance = acos($distance); 
                                    $distance = rad2deg($distance); 
                                    $distance = $distance * 60 * 1.1515; 
                                    switch($unit) { 
                                        case 'miles': 
                                        break; 
                                        case 'kilometers' : 
                                        $distance = $distance * 1.609344; 
                                    } 
                                    $theDistance = (round($distance,1)); 
                                ?>
                            @if ($theDistance < 99.9)        
                                <tr>
                                    <td>{{ $affiliate->affiliate_id }}</td>
                                    <td>{{ $affiliate->name }}</td>
                                </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection