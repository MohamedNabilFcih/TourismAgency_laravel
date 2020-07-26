<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 5.8 - Individual Column Search in Datatables using Ajax</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@hasSection('template_title')@yield('template_title') | @endif
            {{ config('app.name', Lang::get('titles.app')) }}</title>
        <meta name="description" content="">
        <meta name="author" content="Jeremy Kenedy">
        <!-- <link rel="shortcut icon" href="/favicon.ico"> -->

        <!-- Facebook and Twitter integration -->
        <meta property="og:title" content="" />
        <meta property="og:image" content="" />
        <meta property="og:url" content="" />
        <meta property="og:site_name" content="" />
        <meta property="og:description" content="" />
        <meta name="twitter:title" content="" />
        <meta name="twitter:image" content="" />
        <meta name="twitter:url" content="" />
        <meta name="twitter:card" content="" />


        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="shortcut icon" href="favicon.ico">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

        <!-- Animate.css -->
        <link rel="stylesheet" href="{{ asset('travel/css/animate.css') }}">
        <!-- Icomoon Icon Fonts-->
        <link rel="stylesheet" href="{{ asset('travel/css/icomoon.css') }}">
        <!-- Bootstrap  -->
        <link rel="stylesheet" href="{{ asset('travel/css/bootstrap.css') }}">
        <!-- Superfish -->
        <link rel="stylesheet" href="{{ asset('travel/css/superfish.css') }}">
        <!-- Magnific Popup -->
        <link rel="stylesheet" href="{{ asset('travel/css/magnific-popup.css') }}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{ asset('travel/css/bootstrap-datepicker.min.css') }}">
        <!-- CS Select -->
        <link rel="stylesheet" href="{{ asset('travel/css/cs-select.css') }}">
        <link rel="stylesheet" href="{{ asset('travel/css/cs-skin-border.css') }}">

        <link rel="stylesheet" href="{{ asset('travel/css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Product filter in php</title>

        <link rel="stylesheet" href="  {{asset('nav-filter/css/bootstrap.min.css')}} ">
        <link href="{{asset('nav-filter/css/jquery-ui.css')}} " rel="stylesheet">
        <link href="{{asset('comment/css/style.css')}} " rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <style>
            .span4 img {
                margin-right: 10px;
            }
            .span4 .img-left {
                float: left;
            }
            .span4 .img-right {
                float: right;
            }
        </style>

</head>

<body style=".card-horizontal {
    display: flex;
    flex: 1 1 auto;
}">
    @include('partials.header')

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <br />

            <div class="col-md-9">
                <br />
                <div class="row filter_data">

                </div>
            </div>

            <div class="container">
                <div class="row">
                    <h2>Trip Details !</h2>
                </div>

                <div class="block">
                  <div class="row">
                    <div class="span4"  data-animate-effect="fadeIn">
                        <img src="{{ asset('uploads/trips/'.$trip->trip_cover ) }}" alt="image" class="img-left" width="100%" height="100%" >
                      <p></p>

                    </div>

                    <div class="card-body" style="width: 85% ; ">
                        <table class="table table-hover" style="width: 50%">
                            <thead>
                              <tr>
                                <th>trip name</th>
                                <th>{{$trip->name}} </th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><strong>Descriptipn</strong></td>
                                <td>
                                <?php
                        $description =  htmlspecialchars_decode($trip['description']);
                        echo $description;
                    ?>
                                <!-- {{$trip->description }}--></td>
                              </tr>
                              <tr>
                                <td> <strong>Days</strong> </td>
                                <td>{{$trip->days}}</td>
                              </tr>
                           <tr>
                           <td>

                                          @if ($trip->status== 'available')
                                              @php $badgeClass = 'primary' @endphp
                                          @elseif ($trip->status == 'complete')
                                              @php $badgeClass = 'danger' @endphp
                                          @elseif ($trip->status == 'finished')
                                              @php $badgeClass = 'warning' @endphp
                                          @else
                                              @php $badgeClass = 'default' @endphp
                                          @endif
                                          <span class="badge badge-{{$badgeClass}}">{{ $trip->status }}</span>

                                  </td>
                           </tr>
                              <tr>
                                 <td></td>
                                <td class="text-center">
                                @if($trip->status== 'available')
                                    <a class="btn btn-success" href="/trip/reserve/{{$trip->id}}">Reserve trip<i class="icon-arrow-right22"></i></a>
                                @endif
                                </td>
                              </tr>
                            </tbody>
                          </table>

                    </div>



                    </div>


                    <div id="map-canvas" style="margin: 0;padding: 0;height:300"></div>

                    <input type="hidden" id="lat" name="lat" value="0"/>
                    <input type="hidden" id="lng" name="lng" value="0"/>

                    <?php
//                    if(isset($trip->lat) && isset($trip->lng))
//                    {
//
//
//                    }

?>
<!-- <input type="hidden"  id="lat" name="lat" value="'.$trip->id.'">
                    <input type="hidden"  id="lng" name="lng" value="0"> -->


                <div class="block">
                    <hr />

                    <p class="col text-center"> <a class="btn btn-primary btn-outline btn-lg" href="../#section-2">Bact To All Offers <i class="icon-arrow-right22"></i></a></p>

                    <h2 class="text-left" class="content-heading">Display Reviews :</h2>
                    <br><br>
                    <div class="col-md-8">
                    @include('comment.commentsDisplay', ['comments' => $comments, 'trip_id' => $trip->id])
                    <hr />
                    @include('comment.add-comment')

                </div>

                </div>


                 </div>
                </div>

            </div>

            <br><br><br><br><br><br><br><br><br><br>

    </div>

    </div>



    <!--   Core JS Files   -->
    <script src="{{asset('profile/js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('profile/js/bootstrap.min.js')}}" type="text/javascript"></script>


    <script src="{{asset('comment/js/main.js')}}"></script>



    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#editor'
        });
    </script>



    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
        var map;
        var markersArray=[];
        function initialize() {
            var mapOptions = {
                zoom: 8,
                center: new google.maps.LatLng(26.8206,30.8025),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

            deleteOverlays();

            var panPoint = new google.maps.LatLng(26.8206, 30.8025);
            map.setCenter(panPoint)
            var marker = new google.maps.Marker({
                map: map,
                position: {
                    lat: 26.8206,
                    lng: 30.8025
                },
                draggable: true
            });
            markersArray.push(marker);



            function deleteOverlays() {
                if (markersArray) {
                    for (i in markersArray) {
                        markersArray[i].setMap(null);
                    }
                    markersArray.length = 0;
                }
            }

            google.maps.event.addListener(marker, 'dragend', function(ev){
                // alert(marker.getPosition().lat());
                // alert(marker.getPosition().lng());
                document.getElementById("lat").value = marker.getPosition().lat();
                document.getElementById("lng").value = marker.getPosition().lng();
            });

        }

        google.maps.event.addDomListener(window, 'load', initialize);


    </script>


{{--      @include('partials.demo-map')--}}


</body>

</html>
