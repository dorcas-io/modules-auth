@extends('layouts.tabler')
@section('body')
<div class="page-single">
    <div class="container" id="register_page">

        <div class="row justify-content-left p-3">
            <div class="text-left mb-6">
                <!-- <img src="{{ cdn('/images/dorcas.jpeg') }}" class="h-6" alt=""> -->
                <img src="{{ !empty($appUiSettings['product_logo']) ? $appUiSettings['product_logo'] : cdn('images/logo/login-logo_dorcas.png') }}" alt="" class="h-6" style="height: auto !important; width:auto !important; max-width: 250px !important; max-height: 150px !important;">
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-md-12 col-lg-8">

                @include('layouts.blocks.tabler.alert')
                <form class="card" action="{{ route('register') }}" method="post">
                    {{ csrf_field() }}
                    <div class="card-body p-6">
                        <div class="card-title">Get Started with {{ !empty($appUiSettings['product_name']) ? $appUiSettings['product_name'] : config('app.name') }}</div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Your Business Name</label>
                                <input type="text" class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company" id="company" value="{{ old('company') }}"
                                placeholder="Business Name" maxlength="30" required>
                                @if ($errors->has('company'))
                                <div class="invalid-feedback">{{ $errors->first('company') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Your Mobile Number</label>
                                <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone" id="phone"
                                placeholder="Mobile Phone" maxlength="30" value="{{ old('phone') }}" required>
                                @if ($errors->has('phone'))
                                <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Your Email Address</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email"
                                maxlength="80" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">
                                    Choose Password
                                </label>
                                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                id="password" name="password" placeholder="Password" minlength="6" required>
                                @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Your First Name</label>
                                <input type="text" class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" name="firstname" id="firstname" value="{{ old('firstname') }}"
                                placeholder="First Name" maxlength="30" required>
                                @if ($errors->has('firstname'))
                                <div class="invalid-feedback">{{ $errors->first('firstname') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Your Last Name</label>
                                <input type="text" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" name="lastname" id="lastname"
                                placeholder="Last Name" maxlength="30" value="{{ old('lastname') }}" required>
                                @if ($errors->has('lastname'))
                                <div class="invalid-feedback">{{ $errors->first('lastname') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-footer">
                            <input type="hidden" name="plan" value="{{ $plan }}" />
                            <input type="hidden" name="plan_type" value="{{ $plan_type }}" />
                            <input type="hidden" name="module" value="{{ $module }}" />
                            <button type="submit" class="btn btn-primary btn-block">Create Hub Account</button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted">
                    <p>
                        Already have a {{ !empty($appUiSettings['product_name']) ? $appUiSettings['product_name'] : config('app.name') }} account?
                    </p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Sign In to {{ !empty($appUiSettings['product_name']) ? $appUiSettings['product_name'] : config('app.name') }}</a>
                    <!-- <a href="{{ route('login') }}">Sign In</a> -->
                </div>
            </div>


            <div class="col-md-12 col-lg-4">
                <div class="card p-3">
                    <a :href="authMedia.image_link || '#'" class="mb-3">
                        <img v-if="authMedia.media=='image'" :src="authMedia.image || '/images/background/all_in_one_3.png'" :alt="authMedia.title" class="rounded">
                    </a>
                    <div class="px-2">
                        <div>
                            <a v-if="authMedia.button_text.length>0" :href="authMedia.button_link || '#'" type="button" class="btn btn-secondary btn-sm pull-right">@{{ authMedia.button_text || 'Learn More' }}</a>
                            <div>@{{ authMedia.title || 'All-In-One Business Management Software Platform' }}</div>
                            <small class="d-block text-muted">@{{ authMedia.description || 'Get Started FREE' }}</small>
                        </div>

                    </div>
                </div>

                <div class="text-left text-muted">
                    <p class="my-6">
                        The <strong>{{ !empty($appUiSettings['product_name']) ? $appUiSettings['product_name'] : 'Hub' }}</strong> is a FREE all-in-one platform that helps you automate your business e-commerce sales, finance, payroll, customer management and much more
                    </p>
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
                Copyright © {{ date('Y') }} <a href="#">{{ config('app.name') }}</a>. All rights reserved.
            </div>
        </div>
    </div>
</footer>
@endsection
@section('body_js')
    <script type="text/javascript">
        var vm = new Vue({
            el: '#register_page',
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