@extends('layouts.tabler')
@section('body')
<div class="page-single">
    <div class="container" id="index_community_page">

        <div class="row justify-content-center p-3">
            <div class="text-left mb-6">
                <img src="{{ !empty($header['logo']) ? $header['logo'] : cdn('images/logo/login-logo_dorcas.png') }}" alt="" class="h-6" style="height: auto !important; width:auto !important; max-width: 250px !important; max-height: 150px !important;">
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-md-12">

                @include('layouts.blocks.tabler.alert')

                <div class="card">
                    {{ csrf_field() }}
                    <div class="card-body p-6">
                        <div class="card-title text-center">
                            {{ !empty($header['title']) ? $header['title'] : 'Welcome' }}
                        </div>
                    </div>
                </div>
                @if (config('dorcas.edition','business') != "community")

                @endif

            </div>
        </div>

        <div class="row justify-content-center">
            <?php $monitorHealthStatus = []; ?>
            @foreach($dorcasHealthLookUp as $index => $healthStatus)
                <div class="alert @if($healthStatus['status']) alert-info @else alert-danger @endif col-md-12" role="alert" >
                        @if($healthStatus['status'])
                        <i class="fa fa-check" aria-hidden="true"></i>
                        @else 
                        <i class="fa fa-ban" aria-hidden="true"></i> 
                        @endif
                     {{$healthStatus['message']}}

                     @if(!$healthStatus['status'])
                     <ul>
                        @foreach($healthStatus['issues'] as $index => $issue)
                            <li>{{ $issue }}</li>
                        @endforeach
                        <?php array_push($monitorHealthStatus , 'false'); ?>
                     </ul>
                     @else
                     <?php array_push($monitorHealthStatus , 'true'); ?>
                     @endif
                </div>
              @endforeach
        </div>
        <div class="row justify-content-center">
            <a href="{{ url('cache-health-result') }}">
              <input type="submit" class="btn @if(in_array('false' ,$monitorHealthStatus )) btn-danger @else btn-success @endif" @if(in_array('false' ,$monitorHealthStatus )) disabled value="Ensure All Issues Are Fixed !!!" @else value="Confirm Health Status Check"@endif >
            </a>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item"><a href="#">FAQ</a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                Copyright &copy; {{ date('Y') }} <a href="#">{{ config('app.name') }}</a>. All rights reserved.
            </div>
        </div>
    </div>
</footer>
@endsection
{{-- @section('body_js')
    <script src="https://kit.fontawesome.com/25b5b2f8f7.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var vm = new Vue({
            el: '#index_community_page',
            data: {
                authIndexes: {!! json_encode(!empty($authIndexes) ? $authIndexes : []) !!},
            },
            computed: {

            },
            mounted: function () {
               //console.log(this.authMedia);
           },
            methods: {
                getImage: function (image) {
                    return "hello";
                }
            }
        });
    </script>
@endsection --}}