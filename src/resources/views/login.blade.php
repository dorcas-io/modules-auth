@extends('layouts.tabler')
@section('body')
<div class="page-single">
    <div class="container" id="login_page">

        <div class="row justify-content-left p-3">
            <div class="text-left mb-6">
                <!-- <img src="{{ cdn('/images/dorcas.jpeg') }}" class="h-6" alt=""> -->
                <img src="{{ !empty($appUiSettings['product_logo']) ? $appUiSettings['product_logo'] : cdn('images/logo/login-logo_dorcas.png') }}" alt="" class="h-6" style="height: auto !important; width:auto !important; max-width: 250px !important; max-height: 150px !important;">
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-4">

                @include('layouts.blocks.tabler.alert')

                <form class="card" action="{{ route('login-post') }}" method="POST">
                    @csrf
                    <div class="card-body p-6">
                        <div class="card-title text-center">
                            Login to the {{ !empty($appUiSettings['product_name']) ? $appUiSettings['product_name'] : config('app.name') }} {{ $userHostString }}
                            <!-- {{ $page['login_product_name'] }} -->
                        </div>
                        <div class="form-group">
                            <label class="form-label">Your Email address</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                Your Password
                                <a href="{{ url('/forgot-password') }}" class="float-right small">Forgot Password?</a>
                            </label>
                            <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" value="1" />
                                <span class="custom-control-label">Remember me</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        </div>
                    </div>
                </form>
                @if (config('dorcas.edition','business') != "business")
                <div class="text-center text-muted">
                    <p>
                        Don't have a {{ !empty($appUiSettings['product_name']) ? $appUiSettings['product_name'] : config('app.name') }} account yet?
                    </p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-block">Get Started with the {{ !empty($appUiSettings['product_name']) ? $appUiSettings['product_name'] : config('app.name') }}</a>
                    <!-- <a href="{{ route('register') }}">Get Started with {{ !empty($appUiSettings['product_name']) ? $appUiSettings['product_name'] : config('app.name') }}</a> -->
                </div>
                @endif
                <div class="text-left text-muted">
                    <p class="my-6">
                        The <strong>{{ !empty($appUiSettings['product_name']) ? $appUiSettings['product_name'] : 'Hub' }}</strong> is a FREE all-in-one platform that helps you automate your business e-commerce sales, finance, payroll, customer management and much more
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-8">
                <div class="card p-3">
                    <a :href="authMedia.image_link || '#'" class="mb-3">
                        <img v-if="authMedia.media=='image'" :src="authMedia.image || '/images/background/all_in_one_3.png'" alt="authMedia.title" class="rounded">
                    </a>
                    <div class="px-2">
                        <div>
                            <a v-if="authMedia.button_text.length>0" :href="authMedia.button_link || '#'" type="button" class="btn btn-secondary btn-sm pull-right">@{{ authMedia.button_text || 'Learn More' }}</a>
                            <div>@{{ authMedia.title || 'All-In-One Business Management Software Platform' }}</div>
                            <small class="d-block text-muted">@{{ authMedia.description || 'Get Started FREE' }}</small>
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
    <script type="text/javascript">
        var vm = new Vue({
            el: '#login_page',
            data: {
                authMedia: {!! json_encode(!empty($authMedia) ? $authMedia : []) !!},
                group: {name: '', description: ''},
            },
            computed: {

            },
            mounted: function () {
               //console.log(this.authMedia);
           },
            methods: {
                createGroup: function () {
                    this.group = {name: '', description: ''};
                    //$('#manage-group-modal').modal('show');
                }
            }
        });
    </script>
@endsection