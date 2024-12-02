<!DOCTYPE html>
<html lang="en" id="your-element-selector">
<head>
    <meta charset="utf-8">
    <title>403 - Forbidden</title>

    <style>
        html{
            height: 100%;
        }
        div.logo {
            height: 200px;
            width: 155px;
            display: inline-block;
            opacity: 0.08;
            position: absolute;
            top: 2rem;
            left: 50%;
            margin-left: -73px;
        }
        body {
            background: #fafafa;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #777;
            font-weight: 300;
            padding: 0;
        }
        h1 {
            font-weight: lighter;
            letter-spacing: normal;
            font-size: 3rem;
            margin-top: 0;
            margin-bottom: 0;
            color: #222;
        }
        .wrap {
            max-width: 1024px;
            margin: 5rem auto;
            padding: 2rem;
            text-align: center;
            position: relative;
        }
        pre {
            white-space: normal;
            margin-top: 1.5rem;
        }
        code {
            background: #fafafa;
            border: 1px solid #efefef;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            display: block;
        }
        p {
            margin-top: 3rem;
            font-size: 38px;
            color: black;
            position: relative;
        }
        .error_img {
	position: relative;
}
        .footer {
            margin-top: 2rem;
            border-top: 1px solid #efefef;
            padding: 1em 2em 0 2em;
            font-size: 85%;
            color: #999;
        }
        a {
	        color: black !important;
	        font-size: 24px;
	        text-decoration: none;
        }
        a:active,
        a:link,
        a:visited {
            color: #dd4814;
        }
            .effect::after {
	            content: "";
	            width: 100%;
	            height: 30px;
	            position: absolute;
	            left: 0;
	            bottom: -30px;
	            background: black;
	            border-radius: 100%;
                animation: 5s scaleup infinite;
            }
            .effect {
            	width: fit-content;
            	margin: 0 auto;
            	position: relative;
            }
            .effect svg{
                animation: liftup 5s infinite;
            }
            @keyframes scaleup {
                0%{
                    transform: scaleX(1.1);
                }
                50%{
                    transform: scaleX(1);
                }
                100%{
                    transform: scaleX(1.1);
                }
            }
            @keyframes liftup {
                0%{
                    transform: translateY(0);
                }
                50%{
                    transform: translateY(-50px);
                }
                100%{
                    transform: translateY(0);
                }
            }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="error_img">
            <div class="effect">
                <svg height="256px" width="256px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 275 319.8" enable-background="new 0 0 275 319.8" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#D49D26" d="M257.4,139.6c-10.3-1.1-20.5-2-30.7-2.8V82.4c0-57-35-81.7-88.9-82.4C84,0.7,49,25.4,49,82.4v53.9 c-10.5,0.9-20.9,2-31.4,3.3c-9.7,0-17.6,7.1-17.6,16v142c0,8.9,6.3,13,17.6,16c84.7,8.2,156.3,8.3,239.9,0c9.2-1.3,17.6-7.1,17.6-16 v-142C275,146.8,267.2,139.6,257.4,139.6z M137.5,36.1h0.8c56,0,52.3,46.3,52.3,60.7v37.6c-35.2-1.8-70.4-2.1-105.3-0.5V96.7 C85.2,82.4,81.4,36.1,137.5,36.1z"></path> </g></svg>
            </div>
        </div>
        <p>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                <?= lang('Errors.sorryCannotFind') ?>
            <?php endif; ?>
        </p>
        <div class="button d-flex">
            <?php if (!empty($_SERVER['HTTP_REFERER'])): ?>
                <a href="<?= $_SERVER['HTTP_REFERER']; ?>">Vissza az előző oldalra</a>
            <?php else: ?>
                <a href="<?= base_url(); ?>">Vissza a kezdőlapra</a>
            <?php endif; ?>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@0.5.24/dist/vanta.clouds.min.js"></script>
<script>
        VANTA.CLOUDS({
          el: "#your-element-selector",
          mouseControls: false,
          touchControls: false,
          gyroControls: false,
          minHeight: 200.00,
          minWidth: 200.00,
          speed: 1
        });
</script>
</html>
