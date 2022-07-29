@extends('layouts.backend.app')
@section('title')
    Landlord Dashboard
@endsection
<style>
    .welcome{
        padding: 10px;
    }
    .icon{
        color: rgb(235, 227, 227) !important;
        font-size:55px !important;
        padding-bottom: 20px;
    }


    .col-md-3{
        background-color: #18355d;
        transition: 1s;
        height: 200px;
        padding: 20px;
        margin: 20px 33px; 
    }
    .number{
        color:azure;
    }
    .boxs{
        margin-top: 30px;
    }

    .col-md-3:hover{
        background: rgb(79, 99, 143)
    }
 </style> 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 welcome text-center my-4">
            <h1 class="name"> Hello {{ Auth::user()->name }}, Welcome to your landlord dashboard</h1>  
        </div>
    </div>

    <div class="row">
            <div class="col-md-9">
                
                   <div class="row">
                        @forelse ($houses as $house)
                            <div class="col-md-6">
                                <div class="card m-3 house-card">
                                    <div class="card-header">
                                        <img  src="{{ asset('/storage/featured_house/'. $house->featured_image) }}" width="100%" class="img-fluid" alt="Card image">
                                    </div>
                                    <div class="card-body">
                                        <p><h4><strong><i class="fas fa-map-marker-alt"> {{ $house->area->name }}</i> </strong></h4></p>
                                    
                                        <p class="grey"><a class="address" href="{{ route('house.details', $house->id) }}"><i class="fas fa-warehouse"> {{ $house->address }}</i></a> </p>
                                        <hr>
                                        <p class="grey"><i class="fas fa-bed"></i> {{ $house->number_of_room }} Bedrooms  <i class="fas fa-bath float-right"> {{ $house->number_of_toilet }} Bathrooms</i> </p>
                                        <p class="grey"><h4>RM {{ $house->rent }}</i></h4> </p>
                                    </div>
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
            </div>
            
        </div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.counterup.min.js') }}"></script>
<script>
    $('.counter').counterUp({
        delay: 100,
        time: 2000
    });
</script>
    
@endsection
