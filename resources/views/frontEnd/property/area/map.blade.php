@extends('frontEnd.layout')
@section('content')
    <section class="property-address">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="property-address-heading">
                        <div class="property-address-left">
                            {{-- <h4>{{ $labels['property_address'] }}</h4>
                        <p class="mb-0"><img src="{{ asset('assets/img/detail-location.svg') }}"
                                alt="icon" /><span>{{ $property->property_address }}</span></p> --}}
                        </div>
                        {{-- <a href="https://maps.google.com/?q={{ $property->property_address }}" class="comman-btn"
                        target="_blank">{{ $labels['get_directions'] }}</a> --}}
                    </div>

                    {{-- <div class="detail-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13907.208347722504!2d47.97311198876576!3d29.376083612766713!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fcf9c83ce455983%3A0xc3ebaef5af09b90e!2sKuwait%20City%2C%20Kuwait!5e0!3m2!1sen!2sin!4v1646396752284!5m2!1sen!2sin"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div> --}}
                    <div class="detail-map" id="detail_map">

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('after-scripts')
    <script>
        function getData() {
            var property_address = "{{ $property->property_address }}";
            var latitude = "{{ $property->property_address_latitude }}";
            var longitude = "{{ $property->property_address_longitude }}";

            if(latitude && longitude) {
                var dataArr = [];
                dataArr['latitude'] = latitude;
                dataArr['longitude'] = longitude;
                dataArr['formatted_address'] = property_address;

                init_map(dataArr);

            } else{
                $.ajax({
                    url: "{{ route('frontend.getPropMapData') }}",
                    async: true,
                    type: 'post',
                    data: {
                        'address': property_address
                    },
                    dataType: 'json',
                    success: function(data) {
                        //load map
                        init_map(data);
                    }
                });
            }
        }

        function init_map(data) {
            var map_options = {
                zoom: 14,
                center: new google.maps.LatLng(data['latitude'], data['longitude'])
            }
            map = new google.maps.Map(document.getElementById("detail_map"), map_options);
            marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(data['latitude'], data['longitude'])
            });
            infowindow = new google.maps.InfoWindow({
                content: data['formatted_address']
            });
            google.maps.event.addListener(marker, "click", function() {
                infowindow.open(map, marker);
            });
            infowindow.open(map, marker);
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY', 'AIzaSyC3ksZwnrjrnMtiZXZJ7cx9YEckAlt3vh4') }}&callback=getData"
        async defer></script>
@endpush
