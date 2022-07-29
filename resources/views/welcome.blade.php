@extends('layouts.frontend.app')

@section('title')
    Non Reziden - Homepage
@endsection
    
@section('content')
    <div id="search">
        <div class="container-fluid">
            <div class="row justify-content-center py-4">
                <h2 class="text-center"><strong>Search a house of your choice</strong></h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <form action="{{ route('search') }}" method="GET">
                        @csrf
                        <div class="row justify-content-center">
                            @if(session('search'))
                                <div class="alert alert-danger mt-3" id="alert" roles="alert">
                                    {{ session('search') }} 
                                </div> 
                            @endif 
                        </div> 
                        <div class="row">
                            <div class="form-group col-md-4">
                                <input type="text" name="address" placeholder="Search an area" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                {{-- <input type="text" name="room" placeholder="Rooms" class="form-control"> --}}
                                <select name="room"  class="form-control">
                                    <option value="" >rooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                {{-- <input type="text" name="bathroom" placeholder="Bathrooms" class="form-control"> --}}
                                <select name="bathroom"  class="form-control">
                                    <option value="" >bathroom</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" name="rent" placeholder="Price Rent" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="content">
       <div class="container">

       <!-- this is to show marker or the map-->
        <div class="row justify-content-center py-5">
            <div style="width:100%; height:400px" id="map"></div>
        </div>

        <div class="row justify-content-center py-5">
            <h1><strong>Available Houses</strong></h1>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-12">
                
                   <div class="row">
                        @forelse ($houses as $house)
                            <div class="col-md-4">
                                <div class="card m-4 house-card">
                                    <!-- this to show the image of the house -->
                                    <div class="card-header">
                                        <img  src="{{ asset('/storage/featured_house/'. $house->featured_image) }}" width="100%" class="img-fluid" alt="Card image">
                                    </div>
                                    <!-- this is to get all the details of the house-->
                                    <div class="card-body">
                                        <p><h4><strong><i class="fas fa-map-marker-alt"> {{ $house->area->name }}</i> </strong></h4></p>
                                    
                                        <p class="grey"><a class="address" href="{{ route('house.details', $house->id) }}"><i class="fas fa-warehouse"> {{ $house->address }}</i></a> </p>
                                        <hr>
                                        <p class="grey"><i class="fas fa-bed"></i> {{ $house->number_of_room }} Bedrooms  <i class="fas fa-bath float-right"> {{ $house->number_of_toilet }} Bathrooms</i> </p>
                                        <p class="grey"><h4>RM {{ $house->rent }}</i></h4> </p>
                                    </div>

                                    <!-- action to take which is to show the details of the house-->
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <a href="{{ route('house.details', $house->id) }}" class="btn btn-info">Details</a>
                                            </div>
                                            <div>
                                                
                                            </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        @empty 
                            <h2 class="m-auto py-2 text-white bg-dark p-3">House Not Available right now</h2>
                        @endforelse
                   </div>
                   
                   <div class="panel-heading my-4" style="display:flex; justify-content:center;align-items:center;">
                       <a href="{{ route('house.all') }}" class="btn btn-dark">See All Houses</a>
                    </div>
                    
                   
            </div>
            
        </div>
       
       </div>
    </div>
@endsection

@section('scripts')
<script>
    function initMap() {
        //dd($houses);
        var locations =  [
            @foreach($houses as $house)
               [{{$house->id}},{{$house->address_latitude}}, {{$house->address_longitude}},'{{$house->name_house}}','{{$house->address}}'],
            @endforeach
        ];
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: new google.maps.LatLng(2.2214,102.4531),  //lat and lang uitm jasin
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                return function() {
                    infowindow.setContent(
                        "<h6><a href=houses/details/"+locations[i][0]+">"+locations[i][3]+"</a></h6>" +
                        "<p> Name : "+locations[i][3]+"</p>"+
                        "<p> Address : "+locations[i][4]+"</p>");

                    infowindow.open(map, marker);                               
                }
                })(marker, i));
            }              
    }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap"  type="text/javascript"></script>
@endsection