<?php

namespace Dorcas\ModulesAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dorcas\ModulesAuthController\Models\ModulesAuth;
use App\Dorcas\Hub\Utilities\UiResponse\UiResponse;
use Carbon\Carbon;
use App\Http\Controllers\HomeController;
use Hostville\Dorcas\Sdk;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use GuzzleHttp\Exception\ServerException;
use Dorcas\ModulesAssistant\Http\Controllers\ModulesAssistantController as Assistant;

class ModulesAuthController extends Controller {

    public function __construct()
    {
        $this->middleware( 'auth');
        parent::__construct();
        $this->data = [
        ];
    }

    


}