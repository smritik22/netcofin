@extends('dashboard.layouts.master')
<?php
$title_var = 'title_' . @Helper::currentLanguage()->code;
$title_var2 = 'title_' . env('DEFAULT_LANGUAGE');
?>
@section('title', __('backend.cms'))
@push('after-styles')
    <link href="{{ asset('assets/dashboard/js/iconpicker/fontawesome-iconpicker.min.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
@endpush
@section('content')
    <div class="padding edit-package">
        <div class="box">
            <div class="box-header dker">
                <?php
                $title_var = 'title_' . @Helper::currentLanguage()->code;
                $title_var2 = 'title_' . env('DEFAULT_LANGUAGE');
                ?>
                <h3><i class="material-icons">
                        &#xe02e;</i> {{ __('backend.topicNew') }}{{ __('backend.cms') }}
                </h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="{{ route('cms') }}">{{ __('backend.cms') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{ route('cms') }}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{ Form::open(['route' => ['cms.update', 'id' => $cms->id], 'method' => 'POST', 'files' => true,'enctype' => 'multipart/form-data']) }}
                <div class="personal_informations">
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!! __('backend.newpage') !!}</label>
                        <div class="col-sm-10">
                            <input type="text" name="page_name" id="page_name" class="form-control" placeholder="Name"
                                value="{{ $cms->page_name }}">
                        </div>
                    </div>
                    @if($cms->id != 1)
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!! __('backend.pagecontent') !!}</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="page_content" name="page_content"
                                autofocus>{{ isset($cms->description) ? urldecode($cms->description) : old('page_content') }}</textarea>
                        </div>
                    </div>
                    @endif

                    @if($cms->id == 6)
                        <div class="form-group row">
                            <div class="row">
                                
                            <div class="col-sm-8" style="margin-left: 175px;">
                                @if(isset($cms->image ) && $cms->image  != "")
                                        <img id="image_pre" src="{{ $image_url . $cms->image }}"  width="100px" height="100px"/>
                                        <!-- <button type="button" class="btn btn-dark removeImage"><span class="glyphicon glyphicon-trash"></span> </button> -->
                                @else
                                    <img src="{{ asset('uploads/contacts/noimage.png') }}"  width="100px" height="100px" >
                                @endif
                            </div>
                            </div>
                            <label class="col-sm-2 form-control-label">{{ __('backend.topicPhoto') }}</label>
                            <div class="col-sm-10">
                                {!! Form::file('image', ['class' => 'form-control', 'id' => 'image', 'accept' => 'image/png, image/gif, image/jpeg']) !!}
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!! __('backend.imagesTypes') !!}
                                </small>
                                <!-- <input type="hidden" name="image" value="{{ isset($entity->image)?$entity->image:old('image') }}" > -->
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.other_title') !!}</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_title" id="other_title" class="form-control" placeholder="Name"
                                    value="{{ $cms->other_title }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.other_description') !!}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="other_description" name="other_description"
                                    autofocus>{{ isset($cms->other_description) ? urldecode($cms->other_description) : old('other_description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="row">
                                
                            <div class="col-sm-8" style="margin-left: 175px;">
                                @if(isset($cms->other_image ) && $cms->other_image  != "")
                                        <img id="image_pre" src="{{ $image_url . $cms->other_image }}"  width="100px" height="100px"/>
                                         <!-- <button type="button" class="btn btn-dark removeImage"><span class="glyphicon glyphicon-trash"></span> </button> -->
                                @else
                                    <img src="{{ asset('uploads/contacts/noimage.png') }}"  width="100px" height="100px" >
                                @endif
                            </div>
                            </div>
                            <label class="col-sm-2 form-control-label">{{ __('backend.topicPhoto') }}</label>
                            <div class="col-sm-10">
                                {!! Form::file('other_image', ['class' => 'form-control', 'id' => 'other_image', 'accept' => 'other_image/png, other_image/gif, other_image/jpeg']) !!}
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!! __('backend.imagesTypes') !!}
                                </small>
                                <!-- <input type="hidden" name="image" value="{{ isset($entity->other_image)?$entity->other_image:old('other_image') }}" > -->
                            </div>
                            
                        </div>
                    @endif

                    @if($cms->id == 9)
                    {{-- feature_1 --}}
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.feature_1_title') !!}</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_title" id="other_title" class="form-control" placeholder="Name"
                                    value="{{ $cms->other_title }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.feature_1_highlight') !!}</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_highlight" id="other_highlight" class="form-control" placeholder="Highlight"
                                    value="{{ $cms->other_highlight }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.feature_1_description') !!}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="other_description" name="other_description"
                                    autofocus>{{ isset($cms->other_description) ? urldecode($cms->other_description) : old('other_description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="row">
                                
                            <div class="col-sm-8" style="margin-left: 175px;">
                                @if(isset($cms->other_image ) && $cms->other_image  != "")
                                        <img id="image_pre" src="{{ $image_url . $cms->other_image }}"  width="100px" height="100px"/>
                                         <!-- <button type="button" class="btn btn-dark removeImage"><span class="glyphicon glyphicon-trash"></span> </button> -->
                                @else
                                    <img src="{{ asset('uploads/contacts/noimage.png') }}"  width="100px" height="100px" >
                                @endif
                            </div>
                            </div>
                            <label class="col-sm-2 form-control-label">{{ __('backend.feature_1_image') }}</label>
                            <div class="col-sm-10">
                                {!! Form::file('other_image', ['class' => 'form-control', 'id' => 'other_image', 'accept' => 'other_image/png, other_image/gif, other_image/jpeg']) !!}
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!! __('backend.imagesTypes') !!}
                                </small>
                                <!-- <input type="hidden" name="image" value="{{ isset($entity->other_image)?$entity->other_image:old('other_image') }}" > -->
                            </div>
                            
                        </div>

                        <div class="col-sm-8" style="margin-left: 175px;">
                            @if(isset($cms->other_url ) && $cms->other_url  != "")
                                    <img id="image_pre" src="{{ $image_url . $cms->other_url }}"  width="100px" height="100px"/>
                                     <!-- <button type="button" class="btn btn-dark removeImage"><span class="glyphicon glyphicon-trash"></span> </button> -->
                            @else
                                <img src="{{ asset('uploads/contacts/noimage.png') }}"  width="100px" height="100px" >
                            @endif
                        </div>
                        </div>
                        <label class="col-sm-2 form-control-label">{{ __('backend.other_url') }}</label>
                        <div class="col-sm-10">
                            {!! Form::file('other_url', ['class' => 'form-control', 'id' => 'other_url', 'accept' => 'other_url/mp4, other_url/3gp, other_url/mov']) !!}
                            <small>
                                <i class="material-icons">&#xe8fd;</i>
                                {!! __('backend.imagesTypes') !!}
                            </small>
                            <!-- <input type="hidden" name="image" value="{{ isset($entity->other_url)?$entity->other_url:old('other_url') }}" > -->
                        </div>
                        
                    </div>

                        {{-- feature_2 --}}
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.feature_2_title') !!}</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_title1" id="other_title1" class="form-control" placeholder="Name"
                                    value="{{ $cms->other_title1 }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.feature_2_highlight') !!}</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_highlight1" id="other_highlight1" class="form-control" placeholder="Highlight"
                                    value="{{ $cms->other_highlight1 }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.feature_2_description') !!}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="other_description1" name="other_description1"
                                    autofocus>{{ isset($cms->other_description1) ? urldecode($cms->other_description1) : old('other_description1') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="row">
                                
                            <div class="col-sm-8" style="margin-left: 175px;">
                                @if(isset($cms->other_image1 ) && $cms->other_image1  != "")
                                        <img id="image_pre" src="{{ $image_url . $cms->other_image1 }}"  width="100px" height="100px"/>
                                         <!-- <button type="button" class="btn btn-dark removeImage"><span class="glyphicon glyphicon-trash"></span> </button> -->
                                @else
                                    <img src="{{ asset('uploads/contacts/noimage.png') }}"  width="100px" height="100px" >
                                @endif
                            </div>
                            </div>
                            <label class="col-sm-2 form-control-label">{{ __('backend.feature_2_image') }}</label>
                            <div class="col-sm-10">
                                {!! Form::file('other_image1', ['class' => 'form-control', 'id' => 'other_image1', 'accept' => 'other_image1/png, other_image1/gif, other_image1/jpeg']) !!}
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!! __('backend.imagesTypes') !!}
                                </small>
                                <!-- <input type="hidden" name="image" value="{{ isset($entity->other_image1)?$entity->other_image1:old('other_image1') }}" > -->
                            </div>
                            
                        </div>

                        {{-- feature_3 --}}
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.feature_3_title') !!}</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_title2" id="other_title2" class="form-control" placeholder="Name"
                                    value="{{ $cms->other_title2 }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.feature_3_highlight') !!}</label>
                            <div class="col-sm-10">
                                <input type="text" name="other_highlight2" id="other_highlight2" class="form-control" placeholder="Highlight"
                                    value="{{ $cms->other_highlight2 }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">{!! __('backend.feature_3_description') !!}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="other_description2" name="other_description2"
                                    autofocus>{{ isset($cms->other_description2) ? urldecode($cms->other_description2) : old('other_description2') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="row">
                                
                            <div class="col-sm-8" style="margin-left: 175px;">
                                @if(isset($cms->other_image2 ) && $cms->other_image2  != "")
                                        <img id="image_pre" src="{{ $image_url . $cms->other_image2 }}"  width="100px" height="100px"/>
                                         <!-- <button type="button" class="btn btn-dark removeImage"><span class="glyphicon glyphicon-trash"></span> </button> -->
                                @else
                                    <img src="{{ asset('uploads/contacts/noimage.png') }}"  width="100px" height="100px" >
                                @endif
                            </div>
                            </div>
                            <label class="col-sm-2 form-control-label">{{ __('backend.feature_3_image') }}</label>
                            <div class="col-sm-10">
                                {!! Form::file('other_image2', ['class' => 'form-control', 'id' => 'other_image2', 'accept' => 'other_image2/png, other_image2/gif, other_image2/jpeg']) !!}
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!! __('backend.imagesTypes') !!}
                                </small>
                                <!-- <input type="hidden" name="image" value="{{ isset($entity->other_image2)?$entity->other_image2:old('other_image2') }}" > -->
                            </div>
                            
                        </div>
                    @endif
                   
                    
                </div>

                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">&#xe31b;</i>
                            {!! __('backend.update') !!}</button>
                        <a href="{{ route('cms') }}" class="btn btn-default m-t">
                            <i class="material-icons">&#xe5cd;</i> {!! __('backend.cancel') !!}
                        </a>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script src="{{ asset('assets/dashboard/js/iconpicker/fontawesome-iconpicker.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/summernote/dist/summernote.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


    <script>
        $(function() {
            $('.icp-auto').iconpicker({
                placement: '{{ @Helper::currentLanguage()->direction == 'rtl' ? 'topLeft' : 'topRight' }}'
            });
        });

        
        // update progress bar
        function progressHandlingFunction(e) {
            if (e.lengthComputable) {
                $('progress').attr({
                    value: e.loaded,
                    max: e.total
                });
                // reset progress on complete
                if (e.loaded == e.total) {
                    $('progress').attr('value', '0.0');
                }
            }
        }
    </script>
    <script>
        {{-- CKEDITOR.on('instanceReady', function(ev) {
            document.getElementById('eMessage').innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';

            document.getElementById('eButtons').style.display = 'block';
        }); --}}

        {{-- function InsertHTML() {
            var editor = CKEDITOR.instances.editor1;
            var value = document.getElementById('htmlArea').value;

            if (editor.mode == 'wysiwyg') {
                editor.insertHtml(value);
            } else
                alert('You must be in WYSIWYG mode!');
        }

        function InsertText() {
            var editor = CKEDITOR.instances.editor1;
            var value = document.getElementById('txtArea').value;

            if (editor.mode == 'wysiwyg') {
                editor.insertText(value);
            } else
                alert('You must be in WYSIWYG mode!');
        }

        function SetContents() {
            var editor = CKEDITOR.instances.editor1;
            var value = document.getElementById('htmlArea').value;

            editor.setData(value);
        }

        function GetContents() {
            var editor = CKEDITOR.instances.editor1;
            alert(editor.getData());
        }

        function ExecuteCommand(commandName) {
            var editor = CKEDITOR.instances.editor1;

            if (editor.mode == 'wysiwyg') {
                editor.execCommand(commandName);
            } else
                alert('You must be in WYSIWYG mode!');
        }

        function CheckDirty() {
            var editor = CKEDITOR.instances.editor1;
            alert(editor.checkDirty());
        }

        function ResetDirty() {
            var editor = CKEDITOR.instances.editor1;
            editor.resetDirty();
            alert('The "IsDirty" status has been reset');
        }

        function Focus() {
            CKEDITOR.instances.editor1.focus();
        }

        function onFocus() {
            document.getElementById('eMessage').innerHTML = '<b>' + this.name + ' is focused </b>';
        }

        function onBlur() {
            document.getElementById('eMessage').innerHTML = this.name + ' lost focus';
        } --}}
        
        {{-- CKEDITOR.replace('page_content', {
            on: {
                focus: onFocus,
                blur: onBlur,
                pluginsLoaded: function(evt) {
                    var doc = CKEDITOR.document,
                        ed = evt.editor;
                    if (!ed.getCommand('bold')) doc.getById('exec-bold').hide();
                    if (!ed.getCommand('link')) doc.getById('exec-link').hide();
                }
            }
        }); --}}


        CKEDITOR.replace('page_content');

    </script>


<script>
    {{-- CKEDITOR.on( 'instanceReady', function( ev ) {
document.getElementById( 'eMessage' ).innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';
                                                                                                                                                    
document.getElementById( 'eButtons' ).style.display = 'block';
});

function InsertHTML() {
var editor = CKEDITOR.instances.editor1;
var value = document.getElementById( 'htmlArea' ).value;

if ( editor.mode == 'wysiwyg' )
{
    editor.insertHtml( value );
}
else
    alert( 'You must be in WYSIWYG mode!' );
}

function InsertText() {
var editor = CKEDITOR.instances.editor1;
var value = document.getElementById( 'txtArea' ).value;

if ( editor.mode == 'wysiwyg' )
{
    editor.insertText( value );
}
else
    alert( 'You must be in WYSIWYG mode!' );
}

function SetContents() {
var editor = CKEDITOR.instances.editor1;
var value = document.getElementById( 'htmlArea' ).value;

editor.setData( value );
}

function GetContents() {
var editor = CKEDITOR.instances.editor1;
alert( editor.getData() );
}

function ExecuteCommand( commandName ) {
var editor = CKEDITOR.instances.editor1;

if ( editor.mode == 'wysiwyg' )
{
    editor.execCommand( commandName );
}
else
    alert( 'You must be in WYSIWYG mode!' );
}

function CheckDirty() {
var editor = CKEDITOR.instances.editor1;
alert( editor.checkDirty() );
}

function ResetDirty() {
var editor = CKEDITOR.instances.editor1;
editor.resetDirty();
alert( 'The "IsDirty" status has been reset' );
}

function Focus() {
CKEDITOR.instances.editor1.focus();
}

function onFocus() {
document.getElementById( 'eMessage' ).innerHTML = '<b>' + this.name + ' is focused </b>';
}

function onBlur() {
document.getElementById( 'eMessage' ).innerHTML = this.name + ' lost focus';
}
    
CKEDITOR.replace('other_description', {
    on: {
        focus: onFocus,
        blur: onBlur,
        pluginsLoaded: function(evt) {
            var doc = CKEDITOR.document,
                ed = evt.editor;
            if (!ed.getCommand('bold')) doc.getById('exec-bold').hide();
            if (!ed.getCommand('link')) doc.getById('exec-link').hide();
        }
    }
}); --}}

CKEDITOR.replace('other_description');

</script>


<script>
    {{-- CKEDITOR.on( 'instanceReady', function( ev ) {
document.getElementById( 'eMessage' ).innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';
                                                                                                                                                    
document.getElementById( 'eButtons' ).style.display = 'block';
});

function InsertHTML() {
var editor = CKEDITOR.instances.editor1;
var value = document.getElementById( 'htmlArea' ).value;

if ( editor.mode == 'wysiwyg' )
{
    editor.insertHtml( value );
}
else
    alert( 'You must be in WYSIWYG mode!' );
}

function InsertText() {
var editor = CKEDITOR.instances.editor1;
var value = document.getElementById( 'txtArea' ).value;

if ( editor.mode == 'wysiwyg' )
{
    editor.insertText( value );
}
else
    alert( 'You must be in WYSIWYG mode!' );
}

function SetContents() {
var editor = CKEDITOR.instances.editor1;
var value = document.getElementById( 'htmlArea' ).value;

editor.setData( value );
}

function GetContents() {
var editor = CKEDITOR.instances.editor1;
alert( editor.getData() );
}

function ExecuteCommand( commandName ) {
var editor = CKEDITOR.instances.editor1;

if ( editor.mode == 'wysiwyg' )
{
    editor.execCommand( commandName );
}
else
    alert( 'You must be in WYSIWYG mode!' );
}

function CheckDirty() {
var editor = CKEDITOR.instances.editor1;
alert( editor.checkDirty() );
}

function ResetDirty() {
var editor = CKEDITOR.instances.editor1;
editor.resetDirty();
alert( 'The "IsDirty" status has been reset' );
}

function Focus() {
CKEDITOR.instances.editor1.focus();
}

function onFocus() {
document.getElementById( 'eMessage' ).innerHTML = '<b>' + this.name + ' is focused </b>';
}

function onBlur() {
document.getElementById( 'eMessage' ).innerHTML = this.name + ' lost focus';
}
    
CKEDITOR.replace('other_description1', {
    on: {
        focus: onFocus,
        blur: onBlur,
        pluginsLoaded: function(evt) {
            var doc = CKEDITOR.document,
                ed = evt.editor;
            if (!ed.getCommand('bold')) doc.getById('exec-bold').hide();
            if (!ed.getCommand('link')) doc.getById('exec-link').hide();
        }
    }
}); --}}

CKEDITOR.replace('other_description1');

</script>


<script>
    {{-- CKEDITOR.on( 'instanceReady', function( ev ) {
document.getElementById( 'eMessage' ).innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';
                                                                                                                                                    
document.getElementById( 'eButtons' ).style.display = 'block';
});

function InsertHTML() {
var editor = CKEDITOR.instances.editor1;
var value = document.getElementById( 'htmlArea' ).value;

if ( editor.mode == 'wysiwyg' )
{
    editor.insertHtml( value );
}
else
    alert( 'You must be in WYSIWYG mode!' );
}

function InsertText() {
var editor = CKEDITOR.instances.editor1;
var value = document.getElementById( 'txtArea' ).value;

if ( editor.mode == 'wysiwyg' )
{
    editor.insertText( value );
}
else
    alert( 'You must be in WYSIWYG mode!' );
}

function SetContents() {
var editor = CKEDITOR.instances.editor1;
var value = document.getElementById( 'htmlArea' ).value;

editor.setData( value );
}

function GetContents() {
var editor = CKEDITOR.instances.editor1;
alert( editor.getData() );
}

function ExecuteCommand( commandName ) {
var editor = CKEDITOR.instances.editor1;

if ( editor.mode == 'wysiwyg' )
{
    editor.execCommand( commandName );
}
else
    alert( 'You must be in WYSIWYG mode!' );
}

function CheckDirty() {
var editor = CKEDITOR.instances.editor1;
alert( editor.checkDirty() );
}

function ResetDirty() {
var editor = CKEDITOR.instances.editor1;
editor.resetDirty();
alert( 'The "IsDirty" status has been reset' );
}

function Focus() {
CKEDITOR.instances.editor1.focus();
}

function onFocus() {
document.getElementById( 'eMessage' ).innerHTML = '<b>' + this.name + ' is focused </b>';
}

function onBlur() {
document.getElementById( 'eMessage' ).innerHTML = this.name + ' lost focus';
}
    
CKEDITOR.replace('other_description2', {
    on: {
        focus: onFocus,
        blur: onBlur,
        pluginsLoaded: function(evt) {
            var doc = CKEDITOR.document,
                ed = evt.editor;
            if (!ed.getCommand('bold')) doc.getById('exec-bold').hide();
            if (!ed.getCommand('link')) doc.getById('exec-link').hide();
        }
    }
}); --}}

CKEDITOR.replace('other_description2');

</script>
@endpush
