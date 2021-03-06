<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SolutionVideoModel;
use App\WebsiteLangModel;
use App\SolutionVideoLangModel;
use Ramsey\Uuid\Uuid;
use DB;
use App\SolutionContentModel;
use App\SolutionContentLangModel;
use Illuminate\Support\Str;
use App\SolutionAspectModel;
use App\SolutionAspectLangModel;
use App\SolutionKeyfeatureModel;
use App\SolutionKeyfeatureLangModel;
use App\SolutionTitleModel;
use App\SolutionTitleLangModel;
use App\SolutionApplicationModel;
use App\SolutionApplicationLangModel;
use App\SolutionServiceModel;
use App\SolutionServiceLangModel;
use Intervention\Image\ImageManagerStatic as Image;



class SolutionController extends Controller 
{
    /***主題維護***/
    public function title(Request $request) 
    {
        $title = SolutionTitleModel::with('lang')->find(1);
        $web_langList = WebsiteLangModel::where('is_enable',1)->get();
        if($request->isMethod('post')){    
            if($request->uuid == $title->uuid){
                $title->uuid = Uuid::uuid1();
                $title->save();
                foreach ($request->titlelangs as $titleKey => $titleValue) {
                    $title = SolutionTitleLangModel::where('langId',$titleValue['langId'])->where('tId',1)->get();
                    
                    $dm_file = $this->upload_dm($request,'titlelangs.'.$titleValue['langId'].'.dm_file',1,$title,'dm_file');

                    DB::table('tb_solution_title_lang')
                    ->where('langId',$titleValue['langId'])
                    ->update(array('langId' => $titleValue['langId'], 'title' => $titleValue['title'],'down_title' => $titleValue['down_title'],'dm_file' => $dm_file));
                }
                
                return redirect('backend/solution/title');
            }
        }

        //讀出主題的語系資料
        foreach ($title->lang as $titleKey => $titleValue) {
            foreach ($web_langList as $langKey => $langValue) {
                if($titleValue->langId == $langValue->langId){
                    $langdata[$langValue->langId] = $titleValue;
                }
            }
        }

        $data = array(
            'title' => $title,
            'langdata' => $langdata
        );

        return $this->set_view('backend.solution.title',$data);
    }

    /***影片區維護***/
    public function video(Request $request) 
    {
        $video = SolutionVideoModel::with('lang')->find(1);
        $web_langList = WebsiteLangModel::where('is_enable',1)->get();
        if($request->isMethod('post')){       
            if($request->uuid == $video->uuid){
                $video->uuid = Uuid::uuid1();
                $video->save();
                foreach ($request->videolangs as $videoKey => $videoValue) {
                    $video = SolutionVideoLangModel::where('langId',$videoValue['langId'])->where('vId',1)->get();                                   
                    DB::table('tb_solution_video_lang')
                    ->where('langId',$videoValue['langId'])
                    ->update(array('langId' => $videoValue['langId'], 'youtube' => $videoValue['youtube'], 'content'=> $videoValue['content']));
                }
               
                return redirect('backend/solution/video');                  
            }
        }

        //讀出影音的語系資料
        foreach ($video->lang as $videoKey => $videoValue) {
            foreach ($web_langList as $langKey => $langValue) {
                if($videoValue->langId == $langValue->langId){
                    $langdata[$langValue->langId] = $videoValue;
                }
            }
        }
        $data = array(
            'video' => $video,
            'langdata' => $langdata
        );

        return $this->set_view('backend.solution.video',$data);
    }

    /***Application Range***/
    public function application() 
    {
        $contentList = SolutionApplicationModel::with('lang')->where('is_enable',1)->orderby('order','asc')->get();
        $data = array(
            'contentList' => $contentList
        );
        return view('backend.solution.application',$data);
    }

    public function editapplication($applicationId,Request $request) 
    {
        $content = SolutionApplicationModel::with('lang')->find($applicationId);
        $web_langList = WebsiteLangModel::where('is_enable',1)->get();

        if($request->isMethod('post')){
            if($request->uuid == $content->uuid){
                $content->uuid = Uuid::uuid1();
                $content->save();

                foreach ($request->contentlangs as $contentKey => $contentValue) {                    
                    $content = SolutionApplicationLangModel::where('langId',$contentValue['langId'])->where('aId',$applicationId)->get();
                    
                    // //上傳圖檔
                    if ($request->hasFile('contentlangs.'.$contentValue['langId'].'.img')) {
                        
                        if($request->file('contentlangs.'.$contentValue['langId'].'.img')->isValid()){
                            if(file_exists(base_path() . '/public/'.$content[0]->img)){
                                @chmod(base_path() . '/public/'.$content[0]->img, 0777);
                                @unlink(base_path() . '/public/'.$content[0]->img);
                            }
                            $destinationPath = base_path() . '/public/uploads/solution/'.$applicationId;

                            if (!file_exists($destinationPath)) { //Verify if the directory exists
                                mkdir($destinationPath, 0777, true); //create it if do not exists
                            }

                            // getting image extension
                            $extension = $request->file('contentlangs.'.$contentValue['langId'].'.img')->getClientOriginalExtension();
                            
                            // uuid renameing image
                            $fileName = Str::uuid() . '_group_.' . $extension;

                            Image::make($request->file('contentlangs.'.$contentValue['langId'].'.img'))->resize(185,null,function($constraint){
                                $constraint->aspectRatio();
                            })->save($destinationPath.'/thumb_'.$fileName);
                            // move file to dest
                            // $request->file('contentlangs.'.$contentValue['langId'].'.img')->move($destinationPath, $fileName);
                            // save data
                            $contentValue['img'] = '/uploads/solution/'.$applicationId.'/thumb_'.$fileName; 
                        }
                    }else{
                        $contentValue['img'] = $content[0]->img;
                    }
                    DB::table('tb_solution_application_lang')
                    ->where('aId',$applicationId)
                    ->where('langId',$contentValue['langId'])
                    ->update(array('langId' => $contentValue['langId'], 'content'=> html_entity_decode($contentValue['content']),'img' => $contentValue['img']));
                }
                return redirect('backend/solution/application');                  
            }
        }
        //讀出圖文的語系資料
        foreach ($content->lang as $contentKey => $contentValue) {
            foreach ($web_langList as $langKey => $langValue) {
                if($contentValue->langId == $langValue->langId){
                    $langdata[$langValue->langId] = $contentValue;
                }
            }
        }

        $data = array(
            'content' => $content,
            'langdata' => $langdata
        );
        return $this->set_view('backend.solution.editApplication',$data);
    }

    public function application_order_save(Request $request){
        if($order = $request->order){
            foreach ($order as $orderKey => $orderValue) {
                $content = SolutionApplicationModel::find($orderValue['cId']);
                $content->order = $orderValue['order'];
                $content->save();
            }
        }
        return redirect('backend/solution/application');
    }

    /***圖文區維護***/
    public function content() 
    {
        $contentList = SolutionContentModel::with('lang')->where('is_enable',1)->orderby('order','asc')->get();
        $data = array(
            'contentList' => $contentList
        );
        return view('backend.solution.content',$data);
    }

    public function editcontent($contentId,Request $request) 
    {
        $content = SolutionContentModel::with('lang')->find($contentId);
        $web_langList = WebsiteLangModel::where('is_enable',1)->get();

        if($request->isMethod('post')){
            if($request->uuid == $content->uuid){
                $content->uuid = Uuid::uuid1();
                $content->save();

                foreach ($request->contentlangs as $contentKey => $contentValue) {                    
                    $content = SolutionContentLangModel::where('langId',$contentValue['langId'])->where('cId',$contentId)->get();
                    
                    // //上傳圖檔
                    if ($request->hasFile('contentlangs.'.$contentValue['langId'].'.img')) {
                        
                        if($request->file('contentlangs.'.$contentValue['langId'].'.img')->isValid()){
                            if(file_exists(base_path() . '/public/'.$content[0]->img)){
                                @chmod(base_path() . '/public/'.$content[0]->img, 0777);
                                @unlink(base_path() . '/public/'.$content[0]->img);
                            }
                            $destinationPath = base_path() . '/public/uploads/solution/'.$contentId;
                            // getting image extension
                            $extension = $request->file('contentlangs.'.$contentValue['langId'].'.img')->getClientOriginalExtension();
                            
                            // uuid renameing image
                            $fileName = Str::uuid() . '_group_.' . $extension;
                        
                            // move file to dest
                            $request->file('contentlangs.'.$contentValue['langId'].'.img')->move($destinationPath, $fileName);
                            // save data
                            $contentValue['img'] = '/uploads/solution/'.$contentId.'/'.$fileName;                             
                        }
                    }else{
                        $contentValue['img'] = $content[0]->img;
                    }
                    DB::table('tb_solution_content_lang')
                    ->where('cId',$contentId)
                    ->where('langId',$contentValue['langId'])
                    ->update(array('langId' => $contentValue['langId'], 'title' => $contentValue['title'], 'content'=> html_entity_decode($contentValue['content']),'img' => $contentValue['img']));
                }
                return redirect('backend/solution/content');                  
            }
        }
        //讀出圖文的語系資料
        foreach ($content->lang as $contentKey => $contentValue) {
            foreach ($web_langList as $langKey => $langValue) {
                if($contentValue->langId == $langValue->langId){
                    $langdata[$langValue->langId] = $contentValue;
                }
            }
        }

        $data = array(
            'content' => $content,
            'langdata' => $langdata
        );
        return $this->set_view('backend.solution.editcontent',$data);
    }

    public function content_order_save(Request $request){
        if($order = $request->order){
            foreach ($order as $orderKey => $orderValue) {
                $content = SolutionContentModel::find($orderValue['cId']);
                $content->order = $orderValue['order'];
                $content->save();
            }
        }
        return redirect('backend/solution/content');
    }

    /***服務架構維護***/
    public function service(Request $request) 
    {
        $service = SolutionServiceModel::with('lang')->find(1);
        $web_langList = WebsiteLangModel::where('is_enable',1)->get();
        if($request->isMethod('post')){       
            if($request->uuid == $service->uuid){
                $service->uuid = Uuid::uuid1();
                $service->save();
                foreach ($request->servicelangs as $serviceKey => $serviceValue) {
                    $service = SolutionServiceLangModel::where('langId',$serviceValue['langId'])->where('sId',1)->get();
                    $img = $service[0]->img;
                    //上傳圖檔
                    if ($request->hasFile('servicelangs.'.$serviceValue['langId'].'.img')) {                                        
                        if($request->file('servicelangs.'.$serviceValue['langId'].'.img')->isValid()){
                            if(@file_exists(base_path() . '/public/'.@$service[0]->img)){
                                @chmod(base_path() . '/public/'.@$service[0]->img, 0777);
                                @unlink(base_path() . '/public/'.@$service[0]->img);
                            }

                            $destinationPath = base_path() . '/public/uploads/service';

                            // getting image extension
                            $extension = $request->file('servicelangs.'.$serviceValue['langId'].'.img')->getClientOriginalExtension();
                            
                            if (!file_exists($destinationPath)) { //Verify if the directory exists
                                mkdir($destinationPath, 0777, true); //create it if do not exists
                            }
                            
                            // uuid renameing image
                            $fileName = Str::uuid() . '.' .$extension;
            
                            Image::make($request->file('servicelangs.'.$serviceValue['langId'].'.img'))->resize('1110',null,function($constraint){
                                $constraint->aspectRatio();
                            })->save($destinationPath.'/thumb_'.$fileName);
                            $img = '/uploads/service/thumb_'.$fileName;
                        }
                    }

                    DB::table('tb_solution_service_lang')
                    ->where('langId',$serviceValue['langId'])
                    ->update(array('langId' => $serviceValue['langId'], 'title' => $serviceValue['title'],'img' => $img));
                }
                
                return redirect('backend/solution/service');                  
            }
        }

        //讀出主題的語系資料
        foreach ($service->lang as $serviceKey => $serviceValue) {
            foreach ($web_langList as $langKey => $langValue) {
                if($serviceValue->langId == $langValue->langId){
                    $langdata[$langValue->langId] = $serviceValue;
                }
            }
        }

        $data = array(
            'service' => $service,
            'langdata' => $langdata
        );

        return $this->set_view('backend.solution.service',$data);
    }

    /**** 特點維護 ****/
    public function aspect() 
    {
        $aspectList = SolutionAspectModel::where('is_enable',1)->with('lang')->orderby('order','asc')->get();
        // $lang = SolutionAspectLangModel::where('aId',$aspectList[0]->Id)->get();
        $data = array(
            'aspectList' => $aspectList
        );
        return view('backend.solution.aspect',$data);
    }

    public function addaspect(Request $request)
    {
        $aspectList = SolutionAspectModel::limit(1)->orderby('order','desc')->get();
        if($request->isMethod('post')){
            $uuid = Uuid::uuid1();
            $aspect = new SolutionAspectModel();
            $aspect->is_enable = 1;
            $aspect->id = $uuid;
            $aspect->uuid = $uuid;
            $aspect->category = $request->category;
            $aspect->order = $aspectList[0]->order+1;
            $aspect->save();
            foreach ($request->aspect as $langKey => $langValue) {
                $lang = new SolutionAspectLangModel();
                $lang->langId = $langValue['langId'];
                $lang->aId = $uuid;
                $lang->title = $langValue['title'];
                $lang->content = $langValue['content'];
                $lang->save();
            }
            return redirect('backend/solution/aspect');            
        }

        return $this->set_view('backend.solution.addaspect');
    }

    public function editaspect($aspectid,Request $request) 
    {
        $content = SolutionAspectModel::with('lang')->find($aspectid);
        $web_langList = WebsiteLangModel::where('is_enable',1)->get();

        if($request->isMethod('post')){
            if($request->uuid == $content->uuid){
                $content->uuid = Uuid::uuid1();
                $content->category = $request->category;
                $content->save();

                foreach ($request->aspectlangs as $contentKey => $contentValue) {
                    $content = SolutionAspectLangModel::where('langId',$contentValue['langId'])->where('aId',$aspectid)->get();
                    DB::table('tb_solution_aspect_lang')
                    ->where('aId',$aspectid)
                    ->where('langId',$contentValue['langId'])
                    ->update(array('langId' => $contentValue['langId'], 'title' => $contentValue['title'], 'content'=> $contentValue['content']));
                }
                return redirect('backend/solution/aspect');                  
            }
        }
        //讀出特點的語系資料
        foreach ($content->lang as $contentKey => $contentValue) {
            foreach ($web_langList as $langKey => $langValue) {
                if($contentValue->langId == $langValue->langId){
                    $langdata[$langValue->langId] = $contentValue;
                }
            }
        }

        $data = array(
            'content' => $content,
            'langdata' => $langdata
        );
        return $this->set_view('backend.solution.editaspect',$data);
    }

    public function aspect_order_save(Request $request){
        if($order = $request->order){
            foreach ($order as $orderKey => $orderValue) {
                $aspect = SolutionAspectModel::find($orderValue['aId']);
                $aspect->order = $orderValue['order'];
                $aspect->save();
            }
        }
        return redirect('backend/solution/aspect');
    }


    public function aspect_delete($aId){
        $aspect = SolutionAspectModel::find($aId);
        $aspect->is_enable = 0;
        $aspect->save();
        return redirect('backend/solution/aspect');        
    }


    /**** key-feature *****/
    public function key_feature()
    {
        $keyfeatureList = SolutionKeyfeatureModel::with('keyfeaturelang')->where('is_enable',1)->get();
        $data = array(
            'keyfeatureList' => $keyfeatureList
        );

        return view('backend.solution.keyfeature',$data);
    }

    /**
     * Show the form for creating a new resource.
     *@param Request $request
     * @return \Illuminate\Http\Response
     */
    public function addkey_feature(Request $request)
    {
        if($request->isMethod('post')){
            $Id = Str::uuid();
            $uuid = Str::uuid(); 
            $keyfeatureList = SolutionKeyfeatureModel::orderby('order','desc')->first();
            if($request->hasFile('Img')){
                if($request->file('Img')->isValid()){
                    $destinationPath = base_path() . '/public/uploads/key_feature/'.$Id;

                    // getting image extension
                    $extension = $request->file('Img')->getClientOriginalExtension();
                    
                    if (!file_exists($destinationPath)) { //Verify if the directory exists
                        mkdir($destinationPath, 0777, true); //create it if do not exists
                    }
                    
                    // uuid renameing image
                    $fileName = Str::uuid() . '.' .$extension;
    
                    Image::make($request->file('Img'))->resize('320',null,function($constraint){
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/thumb_'.$fileName);
                    $Img = '/uploads/key_feature/'.$Id.'/thumb_'.$fileName;
                }
            }

            $row = new SolutionKeyfeatureModel();            
            $row->is_enable = 1;
            $row->is_visible = $request->is_visible;            
            $row->Id = $Id;
            $row->Img = $Img;
            $row->order = isset($keyfeatureList[0]->order) ? $keyfeatureList[0]->order+1 : 1;
            $row->uuid = $uuid;
            $row->save();
            foreach ($request->contentlangs as $langKey => $langValue) {
                $lang = new SolutionKeyfeatureLangModel();
                $lang->langId = $langValue['langId'];
                $lang->fId = $Id;
                $lang->title = $langValue['title'];  
                $lang->content = $langValue['content'];
            
                $lang->save();
            }            
            return redirect(action('Backend\SolutionController@editkey_feature',[$Id]));
        }
        
        return $this->set_view('backend.solution.addkeyfeature',array());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editkey_feature($Id,Request $request)
    {
        $row = SolutionKeyfeatureModel::with('keyfeaturelang')->find($Id);
        $web_langList = WebsiteLangModel::where('is_enable',1)->get();

        if($request->isMethod('post')){
            if($request->uuid == $row->uuid){
                $row->uuid = Uuid::uuid1();
                //上傳圖檔
                if ($request->hasFile('Img')) {                                        
                    if($request->file('Img')->isValid()){
                        if(file_exists(base_path() . '/public/'.$row->Img)){
                            @chmod(base_path() . '/public/'.$row->Img, 0777);
                            @unlink(base_path() . '/public/'.$row->Img);
                        }

                        $destinationPath = base_path() . '/public/uploads/key_feature/'.$Id;

                        // getting image extension
                        $extension = $request->file('Img')->getClientOriginalExtension();
                        
                        if (!file_exists($destinationPath)) { //Verify if the directory exists
                            mkdir($destinationPath, 0777, true); //create it if do not exists
                        }
                        
                        // uuid renameing image
                        $fileName = Str::uuid() . '.' .$extension;
        
                        Image::make($request->file('Img'))->resize('320',null,function($constraint){
                            $constraint->aspectRatio();
                        })->save($destinationPath.'/thumb_'.$fileName);
                        $row->Img = '/uploads/key_feature/'.$Id.'/thumb_'.$fileName;                  
                    }
                }
                $row->is_visible = $request->is_visible;
                $row->save();
                foreach ($request->contentlangs as $langKey => $langValue) {
                    $lang = SolutionKeyfeatureLangModel::where('fId',$Id)->where('langId',$langValue['langId'])->first();
                    $lang->langId = $langValue['langId'];
                    $lang->fId = $Id;
                    $lang->title = $langValue['title'];  
                    $lang->content = $langValue['content'];
                    $lang->save();
                }
                return redirect(action('Backend\SolutionController@editkey_feature',[$Id]));                  
            }
        }

        //讀出keyfeature的語系資料
        foreach ($row->keyfeaturelang as $rowKey => $rowValue) {
            foreach ($web_langList as $langKey => $langValue) {
                if($rowValue->langId == $langValue->langId){
                    $langdata[$langValue->langId] = $rowValue;
                }
            }
        }
        $data = array(
            'row' => $row,
            'langdata' => $langdata
        );

        return $this->set_view('backend.solution.editkeyfeature',$data);
    }

    /**
     * order
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function key_feature_order_save(Request $request){
        if($order = $request->order){
            foreach ($order as $orderKey => $orderValue) {
                $content = SolutionKeyfeatureModel::find($orderValue['Id']);
                $content->order = $orderValue['order'];
                $content->save();
            }
        }
        return redirect(action('Backend\SolutionController@key_feature'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $Id
     * @return \Illuminate\Http\Response
     */
    public function key_feature_delete($Id)
    {
        $row = SolutionKeyfeatureModel::find($Id);
        $row->is_enable = 0;
        if(file_exists(base_path() . '/public/'.$row->Img)){
            @chmod(base_path() . '/public/'.$row->Img, 0777);
            @unlink(base_path() . '/public/'.$row->Img);
        }
        @rmdir(base_path() . '/public/uploads/key_feature/'.$bannerId);
        $row->save();
        return redirect(action('Backend\SolutionController@key_feature'));
    }

    /**
     * 上傳DM檔案
     */
    public function upload_dm($request,$name,$uuid,$content = false,$file_name = ''){
        if($request->hasFile($name)){
            if($request->file($name)->isValid()){

                $destinationPath = base_path() . '/public/uploads/solution/title';
                // getting image extension
                $extension = $request->file($name)->getClientOriginalExtension();
                $filename = $request->file($name)->getClientOriginalName();
                if (!file_exists($destinationPath)) { //Verify if the directory exists
                    mkdir($destinationPath, 0777, true); //create it if do not exists
                }

                // uuid renameing image
                $fileName = $filename;
            
                // Image::make($request->file($name))->resize($width,null,function($constraint){
                //     $constraint->aspectRatio();
                // })->save($destinationPath.'/thumb_'.$fileName);

                // move file to dest
                $request->file($name)->move($destinationPath, $fileName);
                // save data

                $img = '/uploads/solution/title/'.$fileName;
                if(isset($content[0]->$file_name)){
                    if(file_exists(base_path() . '/public/'.@$content[0]->$file_name)){
                        @chmod(base_path() . '/public/'.$content[0]->$file_name, 0777);
                        @unlink(base_path() . '/public/'.$content[0]->$file_name);
                    }
                }
            }else{
                if($content){
                    $img = $content[0]->$file_name;
                }else{
                    $img = '';
                }
            }
        }else{
            if($content){
                $img = $content[0]->$file_name;
            }else{
                $img = '';
            }
        }
        return $img;
    }
}
