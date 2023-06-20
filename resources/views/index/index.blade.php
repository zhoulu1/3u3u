<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta name="viewport" content="width = 1050, user-scalable = no" />
    <script type="text/javascript" src="{{ asset('/turnjs4/extras/jquery.min.1.7.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/turnjs4/extras/modernizr.2.5.3.min.js') }}"></script>
</head>
    <style>
        html,body{
            width: 100%;
            height: 100%;
        }
    </style>
<body>

    <div class="flipbook-viewport">
        <div class="container">
            <div class="flipbook">
                <div style="background-image:url(pages/1.jpg)"></div>
                <div style="background-image:url(pages/2.jpg)"></div>
                <div style="background-image:url(pages/3.jpg)"></div>
                <div style="background-image:url(pages/4.jpg)"></div>
                <div style="background-image:url(pages/5.jpg)"></div>
                <div style="background-image:url(pages/6.jpg)"></div>
                <div style="background-image:url(pages/7.jpg)"></div>
                <div style="background-image:url(pages/8.jpg)"></div>
                <div style="background-image:url(pages/9.jpg)"></div>
                <div style="background-image:url(pages/10.jpg)"></div>
                <div style="background-image:url(pages/11.jpg)"></div>
                <div style="background-image:url(pages/12.jpg)"></div>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        function loadApp() {

            // Create the flipbook
            var w = document.documentElement.clientWidth;
            var h = document.documentElement.clientHeight;
            console.log(w);
            console.log(h)
            $('.flipbook').turn({
                // Width
                width: w,
                height: h,
                display: 'single',
                // Enable gradients
                gradients: true,
                // Auto center this flipbook
                autoCenter: true

            });
        }

    // Load the HTML4 version if there's not CSS transform

        yepnope({
            test : Modernizr.csstransforms,
            yep: ['../../lib/turn.js'],
            nope: ['../../lib/turn.html4.min.js'],
            both: ['css/basic.css'],
            complete: loadApp
        });

    </script>

</body>
</html>