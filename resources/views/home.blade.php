<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - XCODE</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <div class="logo">
        <img src="{{ asset('images/logoxcode.png') }}" alt="XCODE Logo" style="width: 100px;">
    </div>

    <div class="container">
        <div class="illustration">
            <img src="{{ asset('images/welcome.png') }}" data-aos="fade-right" data-aos-duration="1500" alt="Welcome Character" class="character-img">
        </div>

        <div class="content">
        <h1>
            <a href="" class="typewrite" data-period="2000" data-type='[ "Welcome!", "Selamat Datang!"]'>
                <span class="wrap"></span>
            </a>
        </h1>
            <p class="welcome-text">
                Dapatkan pengalaman kerja nyata, belajar langsung dari para profesional, dan tunjukkan potensimu. Mulailah perjalanan magangmu hari ini dan temukan peluang yang sesuai dengan passionmu.
            </p>
            <div class="buttons">
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                <a href="{{ route('login') }}" class="btn btn-secondary">Masuk</a>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 1000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #777}";
        document.body.appendChild(css);
    };
    </script>
</body>
</html>