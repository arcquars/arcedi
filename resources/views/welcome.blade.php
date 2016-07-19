@extends('layouts.essential')

@section('content')
    <div class="container">
        <div class="row">
            <div class="span12">
                <!-- slider -->
                <div class="flexslider">
                    <ul class="slides">
                        <li> <img src="assets/codester/img/slide-1.jpg" alt="" > </li>
                        <li> <img src="assets/codester/img/slide-2.jpg" alt="" > </li>
                        <li> <img src="assets/codester/img/slide-3.jpg" alt="" > </li>
                        <li> <img src="assets/codester/img/slide-4.jpg" alt="" > </li>
                        <li> <img src="assets/codester/img/slide-5.jpg" alt="" > </li>
                    </ul>
                </div>
                <span id="responsiveFlag"></span>
                <div class="block-slogan">
                    <h2>GUIUT</h2>
                    <div>
                        <p>El mejor edificio Comercial para su negocio o empresa. Nos encontramos hubicados en la mejor zona comercial de la cuidad de Cochabamba</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content -->

    <div id="content" class="content-extra"><div class="ic"></div>
        <div class="row-1">
            <div class="container">
                <div class="row">
                    <article class="span12">
                        <h4>Nuestros Ambientes</h4>
                    </article>
                    <div class="clear"></div>
                    <ul class="portfolio clearfix">
                        <li class="box"><a href="assets/codester/img/image-blank.png" class="magnifier" ><img alt="" src="assets/codester/img/work/1.jpg"></a></li>
                        <li class="box"><a href="assets/codester/img/image-blank.png" class="magnifier" ><img alt="" src="assets/codester/img/work/2.jpg"></a></li>
                        <li class="box"><a href="assets/codester/img/image-blank.png" class="magnifier" ><img alt="" src="assets/codester/img/work/3.jpg"></a></li>
                        <li class="box"><a href="assets/codester/img/image-blank.png" class="magnifier" ><img alt="" src="assets/codester/img/work/4.jpg"></a></li>
                        <li class="box"><a href="assets/codester/img/image-blank.png" class="magnifier" ><img alt="" src="assets/codester/img/work/5.jpg"></a></li>
                        <li class="box"><a href="assets/codester/img/image-blank.png" class="magnifier" ><img alt="" src="assets/codester/img/work/6.jpg"></a></li>
                        <li class="box"><a href="assets/codester/img/image-blank.png" class="magnifier" ><img alt="" src="assets/codester/img/work/7.jpg"></a></li>
                        <li class="box"><a href="assets/codester/img/image-blank.png" class="magnifier" ><img alt="" src="assets/codester/img/work/8.jpg"></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row-2">
            <div class="container">
                <h3>Ambientes Comerciales comodos y vistosos</h3>
                <p>Algo mas para hacer crecer su negocio</p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <article class="span6">
                    <h3>Algo acerca de nosotros</h3>
                    <div class="wrapper">
                        <figure class="img-indent"><img src="assets/codester/img/15.jpg " alt="" /></figure>
                        <div class="inner-1 overflow extra">
                            <div class="txt-1">
                                Empresa constructora "A&I 23" mas de 10 años trabajando en los mas grandes proyectos de contruccion.
                            </div>
                            Algo mas de la constructora.
                        </div>
                    </div>
                </article>
                <article class="span6">
                    <h3>Links importantes</h3>
                    <div class="wrapper">
                        <ul class="list list-pad">
                            <li><a href="#">Campaigns</a></li>
                            <li><a href="#">Portraits</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Fine Art</a></li>
                        </ul>
                        <ul class="list list-pad">
                            <li><a href="#">Campaigns</a></li>
                            <li><a href="#">Portraits</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Fine Art</a></li>
                        </ul>
                        <ul class="list list-pad">
                            <li><a href="#">Campaigns</a></li>
                            <li><a href="#">Portraits</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Fine Art</a></li>
                        </ul>
                        <ul class="list">
                            <li><a href="#">Advertising</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Love story</a></li>
                            <li><a href="#">Landscapes</a></li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
