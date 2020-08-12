<?php

namespace Dorcas\ModulesAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dorcas\ModulesAuth\Models\ModulesAuth;
use App\Dorcas\Hub\Utilities\UiResponse\UiResponse;
use App\Http\Controllers\HomeController;
use Hostville\Dorcas\Sdk;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\HubController;
use Illuminate\Support\Facades\Cookie;
use GuzzleHttp\Exception\ServerException;
use Dorcas\ModulesAssistant\Http\Controllers\ModulesAssistantController as Assistant;
use Illuminate\Support\Facades\Redis;


class ModulesAuthController extends HubController
{

    public function __construct()
    {
        parent::__construct();
        $this->data = [
            'page' => ['title' => config('modules-auth.title')],
            'header' => ['title' => config('modules-auth.title')],
            //'selectedMenu' => 'addons',
            //'submenuConfig' => 'navigation-menu.addons.sub-menu.modules-auth.sub-menu',
            'submenuAction' => ''
        ];
    }


    public static function getAuthMedia(Request $request, Sdk $sdk, string $page = "all", string $module = "all", string $type = "image")
    {
        $mediaArray = [
            "media" => $type,
            "image" => cdn('/images/background/all_in_one_3.png'),
            "image_link" => "",
            "video" => "",
            "title" => "All-In-One Business Management Software Platform.",
            "description" => "Get Started FREE.",
            "button_text" => "",
            "button_link" => ""
        ];

        //dd($mediaArray);

        $hub = new HubController();

        $resources = $hub->getAuthResources($request, $sdk);
        //dd($resources);
        //$view->with('isoCurrencies', $currencies->values()->sortBy('currency'));

        $media = [];

        if ($resources->count()>0) {
            $mediaFilter = $resources->filter(function ($resource, $key) use($page, $module, $type) {
                return in_array($page, $resource->resource_page)  && in_array($module, $resource->resource_module) && $resource->resource_type==$type;
            });
            if ($mediaFilter->count()>0) {
                $media = $mediaFilter->random();
            }
        }

        //dd($media);

        if (!empty($media)) {
            //$mediaA = $media->toArray();
            if ($type=="image") {
                $mediaArray["image"] = cdn('/vendor/modules-auth/images/'.$media->resource_image);
            } elseif ($type=="video") {
                $mediaArray["video"] = $media->resource_video;
            }
            $mediaArray["image_link"] = $media->resource_link;
            $mediaArray["title"] = $media->resource_title;
            $mediaArray["description"] = $media->resource_description;
            $mediaArray["button_text"] = $media->resource_button;
            $mediaArray["button_link"] = $media->resource_button_link;

        }

        return $mediaArray;

    }

    public function offloadMemoryConfig(Request $request, Sdk $sdk)
    {
        Redis::set('posts.all', $posts);
        $this->data['company'] = $company = $request->user()->company(true, true);
        $configuration = !empty($company->extra_data) ? $company->extra_data : [];
    }

    public function uploadMemoryConfig(Request $request, Sdk $sdk)
    {
        Redis::get('posts.all');
    }

}
