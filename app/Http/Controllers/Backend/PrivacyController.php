<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\WebsiteLangModel;
use Ramsey\Uuid\Uuid;
use App\PrivacyModel;
use App\PrivacyLangModel;


class PrivacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $content = PrivacyModel::with('privacylang')->find(1);
        $web_langList = WebsiteLangModel::where('is_enable',1)->get();
        if($request->isMethod('post')){
            if($request->uuid == $content->uuid){
                $content->uuid = Uuid::uuid1();
                $content->save();

                foreach ($request->contentlangs as $langKey => $langValue) {
                    $lang = PrivacyLangModel::where('pId',1)->where('langId',$langValue['langId'])->first();
                    $lang->langId = $langValue['langId'];                    
                    $lang->title = $langValue['title'];  
                    $lang->content = html_entity_decode($langValue['content']);
                    $lang->save();
                }
                return redirect(action('Backend\PrivacyController@index'));                  
            }
        }

        //讀出語系資料
        foreach ($content->privacylang as $content1Key => $content1Value) {
            foreach ($web_langList as $langKey => $langValue) {
                if($content1Value->langId == $langValue->langId){
                    $langdata[$langValue->langId] = $content1Value;
                }
            }
        }
        
        $data = array(
            'content' => $content,
            'langdata' => $langdata,
            'web_langList' => $web_langList
        );

        return $this->set_view('backend.privacy.index',$data);
    }
}
