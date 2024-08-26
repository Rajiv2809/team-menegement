<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function create(BannerRequest $request){
        $path = $request->file('bannerImage')->store('images', 'public');
        Banner::create([
            'banner_title' => $request->bannerTitle,
            'banner_image' => $path,
            'status' => 'active',
        ]);
        return response()->json([
            'message' => 'create success'
        ], 200);
    }
    public function get(){
        $banners = Banner::where('status', 'active')->get();
        return response()->json([
            'banner' => $banners
        ], 200);
    }
    public function update(UpdateBannerRequest $request, $bannerID)
    {

        
        $banner = Banner::find($bannerID);
    
        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }
        $banner->update($request->all());
        

        return response()->json(['message' => 'Banner updated successfully', 'banner' => $banner], 200);
    }
    public function delete($bannerID){
        $banner = Banner::find($bannerID);
        $banner->delete();
        return response()->json(['message' => 'Banner deleted successfully', ], 200);
    }
    

}
