@extends('layouts.backend.app')
@section('title')
   Edit House - {{ $house->address }}
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Edit House Details</strong></h3>
                  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @include('partial.errors')

                    <form action="{{ route('landlord.house.update', $house->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
					          <label for="name_house">House Name: </label>
					          <input type="text" class="form-control" placeholder="Eg: Flat Taman Seroja" id="name_house" name="name_house" value="{{ old('name_house', $house->name_house) }}">
                            </div>

                            <!-- calling and update new input address connect with map-->
					        <div class="form-group">
					          <label for="address">Address: </label>
					          <input type="text" class="form-control map-input" placeholder="Eg: JB 7345 Taman Merlimau Utara" id="address" name="address" value="{{ old('address',$house->address) }}">
                            </div>

                            <!-- hidden the latitude from input address connect with map-->
                            <div class="form-group">
                                <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                            </div>

                            <!-- hidden the longitudefrom input address connect with map-->
                            <div class="form-group">
                                <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                            </div>

                            <!--show address on map-->
                            <div id="address-map-container" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>

                            <div class="form-group">
                                <label for="area_id">Area </label>
                                <select name="area_id" class="form-control" id="area_id">
                                    <option value="">select an area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}"  {{ old('area_id') == $area->id ? 'selected' : '' }} 
                                                @isset($house)
                                                    {{ $house->area_id == $area->id ? 'selected' : '' }}
                                                @endisset     
                                            >
                                        {{ $area->name }}
                                    </option>
                                    @endforeach
                                </select>
                              </div>
                            
                            <div class="form-group">
                                <label for="number_of_room">Number of  rooms: </label>
                                <input type="text" class="form-control" placeholder="number of rooms" id="number_of_room" name="number_of_room" value="{{ old('number_of_room',$house->number_of_room) }}">
                            </div>

                            <div class="form-group">
                                <label for="number_of_toilet">Bathrooms: </label>
                                <input type="text" class="form-control" placeholder="number of toilet" id="number_of_toilet" name="number_of_toilet" value="{{ old('number_of_toilet',$house->number_of_toilet) }}">
                            </div>

                            <div class="form-group">
                                <label for="rent">Price Rent (RM): </label>
                                <input type="text" class="form-control" placeholder="Eg: RM 700" id="rent" name="rent" value="{{ old('rent', $house->rent) }}">
                            </div>

                            <div class="form-group">
                                <label for="desc">Description Details: </label>
                                <input type="text" class="form-control" placeholder="Enter any details description about the house and its surrounding" id="number_of_toilet" name="desc" value="{{ old('desc', $house->desc) }}">
                            </div>

                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                                <input type="file" name="featured_image" class="form-control" id="featured_image">
                            </div>
        
                            <div class="form-group">
                                <label for="images">House Images</label>
                                <input type="file" name="images[]" class="form-control" multiple>
                            </div>
					      

                            <div class="form-group">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ URL::previous() }}" class="btn btn-danger wave-effect" >Back</a>
                            </div> 
                  </form>
                     
                      
                    </div>
                   
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
 @endsection


 @section('scripts')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=places&callback=initialize" async defer></script>
    <script src="/js/mapInput.js"></script>
@stop