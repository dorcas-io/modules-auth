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

            <!-- Loop available home menus -->
            <div v-for="authIndex in authIndexes" class="col-md-6 col-lg-4">
                <div class="card p-3" data-title='width="128" height="128"'>
                    <a :href="authIndex.image_link || '#'" class="mb-3">
                        <img v-if="authIndex.media=='image'" :src="'/vendor/modules-auth/images/' + authIndex.image" alt="authIndex.title" class="rounded">
                    </a>
                    <div class="px-2">
                        <div>
                            
                            <div>@{{ authIndex.title || 'Option 1' }}</div>
                            <small class="d-block text-muted">@{{ authIndex.description || 'Description 1' }}</small>
                        </div>
                    </div>
                </div>
            </div>

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
@section('body_js')
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
@endsection