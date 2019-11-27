@extends('backend.shared._layout')

@section('title', 'Bikonnect')

@section('content')
<div id="content">

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-collapsed="false" data-widget-sortable="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil-square-o"></i> </span>
                        <h2>編輯內文</h2>
                        
                        <ul class="nav nav-tabs pull-right in"><?php $i=1; ?>
                            <li class='active'>
                                <a data-toggle="tab" href="#hb_<?= $i++ ?>"> <span class="hidden-mobile hidden-tablet">基本資料</span> </a>
                            </li>
                            @foreach($web_langList as $langKey => $langValue)
                                <li>
                                    <a data-toggle="tab" href="#hb_<?= $i++ ?>"> <span class="hidden-mobile hidden-tablet"> {{ $langValue->name }} </span> </a>
                                </li>
                            @endforeach
                            
                        </ul>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body">
                            
                            <form id="form" method="post" class="form-horizontal" enctype="multipart/form-data" action="{{ route('banner.add') }}"
                            data-bv-message="This value is not valid"
							data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
							data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
							data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                                
                                <div class="tab-content"><?php $i=1; ?>
                                    <div class="tab-pane active" id="hb_<?= $i++ ?>">
                                        <fieldset>
                                            <legend>基本資料</legend>
                                            @csrf
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">顯示</label>
                                                <div class="col-sm-9">
                                                    <label class="radio radio-inline">
                                                        <input type="radio" class="radiobox" name="is_visible" value="1" checked>
                                                        <span>是</span>
                                                    </label>

                                                    <label class="radio radio-inline">
                                                        <input type="radio" class="radiobox" name="is_visible" value="0">
                                                        <span>否</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">圖片</label>
                                                <div class="col-lg-5">
                                                    <p>
                                                        <img id="preview" width="auto" style="max-width:250px" />
                                                    </p>
                                                    <input type="file" class="btn btn-default imageupload" name="bannerImg"
                                                        data-prev="preview"
                                                        data-bv-file="true"
                                                        data-bv-file-extension="png,gif,jpg,jpeg"
                                                        data-bv-file-type="image/png,image/jpg,image/jpeg,image/gif"
                                                        data-bv-file-message="圖檔格式不符">
                                                    <p class="help-block">
                                                        圖片大小：1168 x 588
                                                    </p>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    @foreach($web_langList as $langKey => $langValue)
                                        <div class="tab-pane" id="hb_<?= $i++ ?>">
                                            <fieldset>
                                                <legend>{{ $langValue->name }}</legend>
                                                @csrf
                                                <input type="hidden" name="contentlangs[{{ $langValue->langId }}][langId]" value="{{ $langValue->langId }}">                                                
                                                
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">標題</label>
                                                    <div class="col-lg-5">
                                                        <textarea class="form-control" rows="5" name="contentlangs[{{ $langValue->langId }}][title]" data-bv-notempty="true" data-bv-notempty-message="請輸入標題"></textarea>
                                                    </div>
                                                </div>                                                                                     
                                            </fieldset>
                                        </div>
                                    @endforeach                                    
                                </div>
                                
                                <div class="form-actions">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="btn btn-default" href="{{ route('banner.index') }}">
                                                Back
                                            </a>
                                            <button class="btn btn-primary" type="submit" id="save">
                                                <i class="fa fa-save"></i>
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
                <!-- end widget -->

            </article>
            <!-- WIDGET END -->

        </div>
        <!-- end row -->

    </section>
    <!-- end widget grid -->

</div>
@endsection

@section('script')

@endsection