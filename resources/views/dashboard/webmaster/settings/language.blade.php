<div class="tab-pane {{ Session::get('active_tab') == 'languageSettingsTab' || Session::get('active_tab') == '' ? 'active' : '' }}"
    id="tab-2">
    <div class="p-a-md">
        <h5>{!! __('backend.languageSettings') !!}</h5>
    </div>

    <div class="p-a-md col-md-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>{{ __('backend.defaultLanguage') }} : </label>
                    <div>
                        <select name="languages_by_default" class="form-control c-select">
                            @foreach (Helper::languagesList() as $ActiveLanguage)
                                    <option value="{{ $ActiveLanguage->code }}"
                                        {{ $WebmasterSetting->languages_by_default == $ActiveLanguage->code ? "selected='selected'" : '' }}>
                                        {{ $ActiveLanguage->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <label>{{ __('backend.dateFormat') }} : </label>
                <select name="date_format" class="form-control select2 select2-hidden-accessible" ui-jp="select2"
                    ui-options="{theme: 'bootstrap'}">
                    <option value="YY-mm-dd" {{ env('DATE_FORMAT', 'YY-mm-dd') == 'YY-mm-dd' ? 'selected' : '' }}>YY-mm-dd
                    </option>
                    <option value="dd-mm-YY" {{ env('DATE_FORMAT', 'YY-mm-dd') == 'dd-mm-YY' ? 'selected' : '' }}>dd-mm-YY
                    </option>
                    <option value="mm-dd-YY" {{ env('DATE_FORMAT', 'YY-mm-dd') == 'mm-dd-YY' ? 'selected' : '' }}>mm-dd-YY
                    </option>
                    <option value="dd/mm/YY" {{ env('DATE_FORMAT', 'YY-mm-dd') == 'dd/mm/YY' ? 'selected' : '' }}>dd/mm/YY
                    </option>
                    <option value="mm/dd/YY" {{ env('DATE_FORMAT', 'YY-mm-dd') == 'mm/dd/YY' ? 'selected' : '' }}>mm/dd/YY
                    </option>

                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6" id="phone">
                <div class="form-group">
                    <label>Phone</label>
                    {!! Form::text('phone', old('phone', $setting->phone ? $setting->phone : ''), ['id' => '   ', 'class' => 'form-control', 'dir' => 'ltr']) !!}
                </div>
            </div>

            <div class="col-sm-6" id="twitter_link">
                <div class="form-group">
                    <label>Address</label>
                    {!! Form::textarea('address', old('address', $setting->address ? $setting->address : ''), ['id' => 'address', 'class' => 'form-control', 'dir' => 'ltr', 'rows' => 2]) !!}
                </div>
            </div>
        </div>

        {{--  <div class="row">
            <div class="col-sm-6" id="support_name">
                <div class="form-group">
                    <label>Support Name</label>
                    {!! Form::text('support_name', env('SUPPORT_NAME'), ['id' => 'support_name', 'class' => 'form-control', 'dir' => 'ltr']) !!}
                </div>
            </div>
            <div class="col-sm-6" id="support_email">
                <div class="form-group">
                    <label>Support Email</label>
                    {!! Form::text('support_email', env('SUPPORT_EMAIL'), ['id' => 'support_email', 'class' => 'form-control', 'dir' => 'ltr']) !!}
                </div>
            </div>
        </div>  --}}
        <div class="row">
            <div class="col-sm-6" id="facebook_link">
                <div class="form-group">
                    <label>Facebook Link</label>
                    {!! Form::url('facebook_link', env('FACEBOOK_LINK'), ['id' => 'facebook_link', 'class' => 'form-control', 'dir' => 'ltr']) !!}
                </div>
            </div>
            <div class="col-sm-6" id="twitter_link">
                <div class="form-group">
                    <label>Twitter Link</label>
                    {!! Form::url('twitter_link', env('TWITTER_LINK'), ['id' => 'twitter_link', 'class' => 'form-control', 'dir' => 'ltr']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6" id="youtube_link">
                <div class="form-group">
                    <label>Youtube Link</label>
                    {!! Form::url('youtube_link', env('YOUTUBE_LINK'), ['id' => 'youtube_link', 'class' => 'form-control', 'dir' => 'ltr']) !!}
                </div>
            </div>
            <div class="col-sm-6" id="instagram_link">
                <div class="form-group">
                    <label>Instagram Link</label>
                    {!! Form::url('instagram_link', env('INSTAGRAM_LINK'), ['id' => 'instagram_link', 'class' => 'form-control', 'dir' => 'ltr']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6" id="copyright_en">
                <div class="form-group">
                    <label>Copy Right</label>
                    {!! Form::text('copyright_en', old('copyright_en', $WebmasterSetting->copyright_en ? $WebmasterSetting->copyright_en : ''), ['id' => 'copyright_en', 'class' => 'form-control', 'dir' => 'ltr']) !!}
                </div>
            </div>
            <div class="col-sm-6" id="site_title_en">
                <div class="form-group">
                    <label>Site Title</label>
                    {!! Form::text('site_title_en', old('site_title_en', @$WebmasterSetting->site_title_en ? $WebmasterSetting->site_title_en : ''), ['id' => 'site_title_en', 'class' => 'form-control', 'dir' => 'ltr']) !!}
                </div>
            </div>
        </div>
       

        {{-- <div class="m-t-2">
            <h5>{{ __('backend.languages') }}</h5>
            <div class="box">
                <table class="table table-striped b-t">
                    <thead class="dker">
                    <tr>
                        <th>{{ __('backend.languageTitle') }}</th>
                        <th class="text-center">{{ __('backend.languageCode') }}</th>
                        <th class="text-center">{{ __('backend.languageDirection') }}</th>
                        <th class="text-center">{{ __('backend.status') }}</th>
                        <th class="text-center">{{ __('backend.options') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Languages as $Language)
                        <tr>
                            <td>
                                @if ($Language->icon != '')
                                    <img
                                        src="{{ asset('assets/dashboard/images/flags/'.$Language->icon.".svg") }}"
                                        alt="" class="w-20">
                                @endif
                                &nbsp; {{ $Language->title }}</td>
                            <td class="text-center">{{ $Language->code }}</td>
                            <td class="text-center">{{ $Language->direction }}</td>
                            <td class="text-center"><i
                                    class="fa {{ ($Language->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                            </td>
                            <td class="text-center">
                                @if (@Auth::user()->permissionsGroup->edit_status)
                                    <button type="button" class="btn btn-sm success"
                                            data-toggle="modal"
                                            data-target="#edit_language_{{ $Language->id }}">
                                        <small><i
                                                class="material-icons">&#xe3c9;</i> {{ __('backend.edit') }}
                                        </small>
                                    </button>
                                @endif
                                @if (count($Languages) > 1)
                                    @if (@Auth::user()->permissionsGroup->delete_status)
                                        <button type="button" class="btn btn-sm warning"
                                                data-toggle="modal"
                                                data-target="#delete_language_{{ $Language->id }}"
                                                ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small><i
                                                    class="material-icons">&#xe872;</i> {{ __('backend.delete') }}
                                            </small>
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn primary" data-toggle="modal"
                    data-target="#add_language">
                <i class="material-icons">&#xe145;</i> {{ __('backend.addNewLanguage') }}
            </button>
            <a class="btn info " target="_blank"
               href="{{ url(env('BACKEND_PATH').'/webmaster/translations') }}">
                <i class="material-icons">&#xe8e2;</i> {{ __('backend.updateTranslation') }}
            </a>
        </div> --}}
    </div>
</div>
