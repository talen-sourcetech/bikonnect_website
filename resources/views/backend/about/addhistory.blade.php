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
                        <h2>新增沿革</h2>
                        
                        <ul class="nav nav-tabs pull-right in">
                            @foreach($web_langList as $langKey => $langValue)
                                <li {{ $langKey == 0 ? 'class=active' : '' }}>
                                    <a data-toggle="tab" href="#hb_{{ $langValue->langId }}"> <span class="hidden-mobile hidden-tablet"> {{ $langValue->name }} </span> </a>
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
                            
                            <form id="form" method="post" class="form-horizontal" enctype="multipart/form-data" action="{{ route('about.history.add') }}"
                            data-bv-message="This value is not valid"
							data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
							data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
							data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                                
                                <div class="tab-content">
                                    @foreach($web_langList as $langKey => $langValue)
                                        <div class="tab-pane {{ $langKey == 0 ? 'active' : '' }}" id="hb_{{ $langValue->langId }}">
                                            <fieldset>

                                                <legend>{{ $langValue->name }}</legend>
                                                @csrf
                                                <input type="hidden" name="history[{{ $langValue->langId }}][langId]" value="{{ $langValue->langId }}">
                                                
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">時間</label>
                                                    <div class="col-lg-3">
                                                        <input type="text" class="form-control" name="history[{{ $langValue->langId }}][year]" value=""
                                                        data-bv-notempty="true"
                                                        data-bv-notempty-message="請輸入時間"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">標題</label>
                                                    <div class="col-lg-5">
                                                        <input type="text" class="form-control" name="history[{{ $langValue->langId }}][title]" value=""
                                                        data-bv-notempty="true"
                                                        data-bv-notempty-message="請輸入標題"
                                                        >
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">內文</label>
                                                    <div class="col-sm-9">
                                                        <div class="content-edit"></div>
                                                        <input type="hidden" id="content" name="history[{{ $langValue->langId }}][content]">
                                                    </div>
                                                    <!-- <div class="col-lg-5">
                                                        <textarea class="form-control" name="history[{{ $langValue->langId }}][content]" placeholder="內文" rows="8" data-bv-notempty="true" data-bv-notempty-message="請輸入內文"></textarea>
                                                    </div> -->
                                                </div>                                                  
                                            </fieldset>
                                        </div>
                                    @endforeach
                                    
                                </div>
                                
                                <div class="form-actions">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="btn btn-default" href="{{ route('about.history') }}">
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
<script>
document.addEventListener('DOMContentLoaded', function(){ 
    $('div.content-edit').each(function (index, element) {
        $(element).summernote({
            height: 500,
            lang: 'zh-TW',
            toolbar: [
                ['misc', ['codeview']],
                ['para', ['ul']],
                ['font', ['fontname', 'fontsize', 'color', 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subsript', 'clear']],
                ['para', ['style', 'ol', 'ul', 'paragraph', 'height']],
                // ['insert', ['picture']],
                ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
            ],
            callbacks: {
                onImageUpload: function (files) {
                    for (var i = 0; i < files.length; i++) {
                        sendFile(files[i], $(this));
                    }
                }
            }
        });
    });
});
</script>
@endsection