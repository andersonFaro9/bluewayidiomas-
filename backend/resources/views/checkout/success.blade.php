<?php
use Illuminate\Support\Facades\Lang;
?>
    <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    >
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Blueway</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Raleway:100,600"
        rel="stylesheet"
        type="text/css"
    >

    <!-- Styles -->
    <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    header {
        background-color: #9C27B0;
        box-shadow: 0 0 10px 2px rgba(0,0,0,0.2), 0 0px 10px rgba(0,0,0,0.24);
        height: 60px;
        overflow-y: hidden;
        display: flex;
        align-items: center;
        padding: 0 12px;
    }

    header img {
        height: 40px;
        margin: 0 10px;
    }

    main {
        height: calc(100vh - 60px);
        align-items: center;
        display: flex;
        justify-content: center;
        position: relative;
    }

    main .content {
        text-align: center;
        padding: 20px;
    }

    main .content .title {
        font-size: 3em;
        margin-bottom: 30px;
    }

    main .content img {
        height: 8em;
        margin-bottom: 1em;
    }
    </style>
</head>
<body>
    <header>
        <img
            src="<?php echo asset('/image/header-logo.png') ?>"
            alt=""
        >
    </header>
    <main>
        <div class="content">
            <img
                src="<?php echo asset('/image/success.svg') ?>"
                alt=""
            >
            <div class="title">
                <?php echo Lang::get('gateway/transaction/message.success') ?>
            </div>
        </div>
    </main>
</body>
</html>
