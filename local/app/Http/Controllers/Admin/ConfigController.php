<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Http\Requests\UploadBannerRequest;
use App\Helpers\UploadImage;

class ConfigController extends Controller
{
    protected $config;

    public function __construct()
    {
        $this->config = new Config;
    }

    public function index()
    {
        $banner = $this->config->getBanner();
        $info = $this->config->getInfo();
        $term = $this->config->getTerm();
        $policy = $this->config->getPolicy();
        return view('admin.config.index', compact('banner', 'info', 'term', 'policy'));
    }

    public function updateBanner(UploadBannerRequest $rq)
    {
        $banner = $this->config->getBanner();
        $arr = unserialize($banner->value);

        if ($rq->file('value')->isValid()) {
            $image = new UploadImage($rq->file('value'));
            $arr[] = $image->handleUploadAndResize(200);
            $banner->value = serialize($arr);
            $banner->save();

            // Thành công, show thành công
            return back()->with('success', 'Upload files thành công!');
        } else {
            // Lỗi file
            return back()->with('error', 'Upload files thất bại!');
        }
    }

    public function updateInfo(Request $rq)
    {
        $this->config->getInfo()->update($rq->all());
        return back();
    }

    public function updateTerm(Request $rq)
    {
        $this->config->getTerm()->update($rq->all());
        return back();
    }

    public function updatePolicy(Request $rq)
    {
        $this->config->getPolicy()->update($rq->all());
        return back();
    }
}
