<?php
    use App\Helpers\Helper;
    $language_id = Helper::currentLanguage()->id;
    $labels = Helper::LabelList($language_id);

    $PageTitle = $labels['404_not_found'];
    $PageDescription = '';
    $PageKeywords = '';
    $WebmasterSettings = '';
    $url = explode("/",url()->current());
    // echo '<pre>';
    // print_r($url[3]);
    // exit;
?>

        <section class="inner-pading thank-you-outer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="thank-you">
                            <h2>{{$labels['404']}}</h2>
                            <h1>{{$labels['oops_that_page_cant_be_found']}}</h1>

                            <p>{{$labels['the_page_you_were_looking_for_not_exists']}}</p>
                            <a href="{{($url[3] != 'admin') ? route('frontend.homePage') : env('APP_URL').'/login'}}" class="comman-btn">{{$labels['back_to_home']}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

