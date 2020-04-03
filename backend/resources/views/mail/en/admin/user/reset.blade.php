@extends('mail.default', [
    'image' => '/mail/img/imgHeader_05.png',
    'header' => 'Reset Password',
    'title' => 'Thank you for registration at Futura Genetics.',
    'data' => $data,
])

@section('content')
    <p style="color: #666666; font-family: 'Raleway', 'Roboto', sans-serif; font-size: 14px; font-weight: normal; line-height: 1.3;
    margin: 0 0 10px;padding: 0; text-align: left;">
        You have recently requested a password reset. In order to do so you need to click on the below URL: </p>
    <div style="-moz-hyphens: auto; -webkit-hyphens: auto; background: #2eb9c5; border: none; border-collapse: collapse !important;
    border-radius: 3px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); color: #fefefe; cursor: pointer;
    font-family: 'Raleway', 'Roboto', sans-serif; font-size: 12px; font-weight: normal; hyphens: auto; line-height: 1.3; margin: 0;
    outline: none; padding: 5px 10px 5px 10px; text-align: left; transition: all 0.3s ease 0s; vertical-align: top; word-wrap: break-word;
    display: inline-block">
        <a href="{{ $data->reset_link }}" style="border: 0 solid #2199e8; color: #fefefe; display: inline-block; font-family: 'Raleway', sans-serif; font-size: 12px;
           font-weight: normal; line-height: 1.3; margin: 0; padding: 5px 10px 5px 10px; text-align: left; text-decoration: none;">
            Reset Password
        </a>
    </div>
    <br><br>

    <p style="color: #666666; font-family: 'Raleway', 'Roboto', sans-serif; font-size: 14px; font-weight: normal; line-height: 1.3;
    margin: 0 0 10px;padding: 0; text-align: left;">
        If the button does not work, please copy and paste the following link into your web browser.</p>
    <br>
    <p style="color: #666666; font-family: 'Raleway', 'Roboto', sans-serif; font-size: 14px; font-weight: normal; line-height: 1.3;
    margin: 0 0 10px;padding: 0; text-align: left;">
        <a href="#"
           style="color: #2eb9c5; font-family: 'Raleway', 'Roboto', sans-serif; font-weight: normal; line-height: 1.3; margin: 0; padding: 0; text-align: left; text-decoration: underline;">
            {{ $data->reset_link }}
        </a>
    </p>

    <p style="color: #666666; font-family: 'Raleway', 'Roboto', sans-serif; font-size: 14px; font-weight: normal; line-height: 1.3;
    margin: 0 0 10px;padding: 0; text-align: left;">
        If you did not request the password reset, please ignore this email. If you have any questions or need assistance, please do not
        hesitate to contact us via <a href="#"
                                      style="color: #2eb9c5; font-family: 'Raleway', 'Roboto', sans-serif; font-weight: normal; line-height: 1.3; margin: 0; padding: 0; text-align: left; text-decoration: underline;">
            hello@futuragenetics.com
        </a>. </p>
    <br><br><br>
@endsection