@extends('mail.default', [
    'image' => '/mail/img/imgHeader_01.png',
    'header' => $data->activation_link ? 'Thank you for registration, please confirm your email' : 'Thank you for registration',
    'title' => 'Thank you for registration at Futura Genetics. <br> You are in one step from a healthier life!',
    'data' => $data,
])

@section('content')
    @if($data->activation_link)
        <p style="color: #666666; font-family: 'Raleway', 'Roboto', sans-serif; font-size: 14px; font-weight: normal; line-height: 1.3;
        margin: 0 0 10px;padding: 0; text-align: left;">
            In order to complete the process, please, follow the link and set a
            password. Then press “Continue” and enter your personal data.</p>
        <br>
        <div style="-moz-hyphens: auto; -webkit-hyphens: auto; background: #2eb9c5; border: none; border-collapse: collapse !important;
        border-radius: 3px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); color: #fefefe; cursor: pointer;
        font-family: 'Raleway', 'Roboto', sans-serif; font-size: 12px; font-weight: normal; hyphens: auto; line-height: 1.3; margin: 0;
        outline: none; padding: 5px 10px 5px 10px; text-align: left; transition: all 0.3s ease 0s; vertical-align: top; word-wrap: break-word;
        display: inline-block">
            <a href="{{ $data->activation_link }}" style="border: 0 solid #2199e8; color: #fefefe; display: inline-block; font-family: 'Raleway', sans-serif; font-size: 12px;
               font-weight: normal; line-height: 1.3; margin: 0; padding: 5px 10px 5px 10px; text-align: left; text-decoration: none;">
                Confirm my Email
            </a>
        </div>
    @else
        <p style="color: #666666; font-family: 'Raleway', 'Roboto', sans-serif; font-size: 14px; font-weight: normal; line-height: 1.3;
    margin: 0 0 10px; text-align: left; padding: 0; ">
            Go to "My Account" to see everything we have to offer for you </p>
        <br>
        <div style="-moz-hyphens: auto; -webkit-hyphens: auto; background: #2eb9c5; border: none; border-collapse: collapse !important;
    border-radius: 3px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); color: #fefefe; cursor: pointer;
    font-family: 'Raleway', 'Roboto', sans-serif; font-size: 12px; font-weight: normal; hyphens: auto; line-height: 1.3; margin: 0;
    outline: none; padding: 5px 10px 5px 10px; text-align: left; transition: all 0.3s ease 0s; vertical-align: top; word-wrap: break-word;
    display: inline-block">
            <a href="{{ url(env('APP_CLIENT') . '/admin/account') }}" style="border: 0 solid #2199e8; color: #fefefe;
            display: inline-block; font-family: 'Raleway', sans-serif; font-size: 12px;
           font-weight: normal; line-height: 1.3; margin: 0; padding: 5px 10px 5px 10px; text-align: left; text-decoration: none;">
                My Account
            </a>
        </div>
    @endif
    <br><br><br>
@endsection