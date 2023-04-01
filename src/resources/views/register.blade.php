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
                        <div class="card-title">Get Started with {{ !empty($appUiSettings['product_name']) ? $appUiSettings['product_name'] : config('app.name') }} {{ $userHostString }}</div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label">Which Business Features Do You Need?</label>
                                <select name="feature_select" id="feature_select" required="" readonly="readonly" class="form-control custom-select">
                                  <!-- <option value="" data-data='{"image": "{{ cdn('images/flags/br.svg') }}"}'>Please Select...</option> -->
                                  <!-- <option value="selling_online" data-data='{"image": "{{ cdn('images/flags/br.svg') }}"}'>Selling Online</option>
                                  <option value="payroll" data-data='{"image": "{{ cdn('images/flags/cz.svg') }}"}'>Payroll</option> -->
                                  <option value="all" data-data='{"image": "{{ cdn('images/flags/de.svg') }}"}' selected>Everything!</option>
                                </select>
                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Enter Your Business Name</label>
                                <input type="text" class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company" id="company" value="{{ old('company') }}"
                                placeholder="e.g. ABC Limited" maxlength="30" required>
                                @if ($errors->has('company'))
                                <div class="invalid-feedback">{{ $errors->first('company') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Provide Your Mobile Number</label>
                                <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone" id="phone"
                                placeholder="Mobile Phone" maxlength="30" value="{{ old('phone') }}" required>
                                @if ($errors->has('phone'))
                                <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Provide Your Email Address</label>
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
                                <label class="form-label">Enter Your First Name</label>
                                <input type="text" class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" name="firstname" id="firstname" value="{{ old('firstname') }}"
                                placeholder="First Name" maxlength="30" required>
                                @if ($errors->has('firstname'))
                                <div class="invalid-feedback">{{ $errors->first('firstname') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Enter Your Last Name</label>
                                <input type="text" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" name="lastname" id="lastname"
                                placeholder="Last Name" maxlength="30" value="{{ old('lastname') }}" required>
                                @if ($errors->has('lastname'))
                                <div class="invalid-feedback">{{ $errors->first('lastname') }}</div>
                                @endif
                            </div>
                        </div>

                        @if ( (env("DORCAS_EDITION", "business") == "community" || env("DORCAS_EDITION", "business") == "enterprise") && $userHostMode == "partner" )
                            <div class="row">
                                <label class="form-label" for="domain">Choose and reserve a unique prefix (short name) for your business <em>(e.g. abc for ABC Limited)</em></label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" required v-on:keyup="removeStatus()" placeholder="Entered desired prefix..." id="domain" name="domain" maxlength="80" v-model="domain">
                                    <button  v-on:click.prevent="checkAvailability()" class="btn btn-primary" :class="{'btn-loading': is_querying}" type="button">Check Availability</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-status card-status-left" v-bind:class="{ 'bg-green': is_available, 'bg-red': !is_available && is_queried }"></div>
                                        <div class="card-body">
                                            <p :class="{'card-alert alert alert-success mb-0': is_available, 'card-alert alert alert-danger mb-0': !is_available && is_queried, '': is_querying }">
                                                https://@{{ actual_domain }}.{{ get_dorcas_parent_domain() }}
                                            </p>
                                            <p id="domain_result" style="font-weight: bold;"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="custom-switch">
                                    <input type="checkbox" name="dorcas_terms_check" id="dorcas_terms_check" value="dorcas_terms_agree" class="custom-switch-input" onchange="vm.toggleTerms()">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">I agree with <a href="#" target="_blank">the terms and conditions</a></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-footer">
                            <input type="hidden" name="plan" value="{{ $plan }}" />
                            <input type="hidden" name="plan_type" value="{{ $plan_type }}" />
                            <input type="hidden" name="module" value="{{ $module }}" />
                            <button type="submit" id="register_page_submit" class="btn btn-primary btn-block">Create Hub Account</button>
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
                accept_terms: false,
                domain_chosen: false,
                domain: '',
                is_available: false,
                is_queried: false,
                is_querying: false,
                dorcasEdition:  '{!! $dorcasEdition !!}',
                userHostMode: '{{ $userHostMode }}'
            },
            computed: {
                actual_domain: function () {
                    return this.domain.replace(' ', '').toLowerCase().trim();
                }
            },
            mounted: function () {
                $('#register_page_submit').prop('disabled', true);
               //console.log(this.authMedia);
           },
            methods: {
                removeStatus: function () {
                    this.is_available = false;
                    this.is_queried = false;
                    this.is_querying = false;
                    this.domain_chosen = false;
                    $('#domain_result').html('...');
                },
                createGroup: function () {
                    this.group = {name: '', description: ''};
                    //$('#manage-group-modal').modal('show');
                },
                toggleTerms: function() {
                    if ($('#dorcas_terms_check').is(":checked")) {
                        if (this.userHostMode == 'partner' && this.domain_chosen) {
                            $('#register_page_submit').prop('disabled', false);
                        } else if (this.userHostMode != 'partner') {
                            $('#register_page_submit').prop('disabled', false);
                        }
                        
                    } else {
                        $('#register_page_submit').prop('disabled', true);
                    }
                },
                checkAvailability: function () {
                    var context = this;

                    if (context.actual_domain == '' ) {
                        swal("Error", "Please choose and reserve a unique prefix (short name) for your business", "warning");
                    } else {
                        this.is_querying =  true;
                        $('#domain_result').html('...');
                        axios.get("/mec/ecommerce-domains-issuances-availability-register", {
                            params: { id: context.actual_domain }
                        })
                        .then(function (response) {
                            //console.log(response);
                            context.is_querying = false;
                            context.is_queried = true;
                            context.is_available = response.data.is_available;
                            if (context.is_available) {
                                context.domain_chosen = true;
                                vm.toggleTerms();
                            } else {
                                context.domain_chosen = false;
                                vm.toggleTerms();
                            }
                            //Materialize.toast(context.is_available ? 'The subdomain is available' : 'The subdomain is unavailable', 4000);
                            $('#domain_result').html(context.is_available ? 'This choice is available' : 'The choice is unavailable');
                        })
                        .catch(function (error) {
                            var message = '';
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
                                //var e = error.response.data.errors[0];
                                //message = e.title;
                                var e = error.response;
                                message = e.data.message;
                            } else if (error.request) {
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                message = 'The request was made but no response was received';
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                message = error.message;
                            }
                            context.is_querying = false;
                            //Materialize.toast('Error: '+message, 4000);
                            swal("Error", message, "warning");
                        });

                    }
                }
            }
        });


    </script>
    <script src="{{ cdn('apps/tabler/js/vendors/selectize.min.js') }}"></script>
    <script type="text/javascript">

        $('#dorcas-feature-select').selectize({
            render: {
                option: function (data, escape) {
                    return '<div>' +
                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                        '<span class="title">' + escape(data.text) + '</span>' +
                        '</div>';
                },
                item: function (data, escape) {
                    return '<div>' +
                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                        escape(data.text) +
                        '</div>';
                }
            }
        });


    </script>

@endsection