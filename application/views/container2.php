<!DOCTYPE html>
<html lang="en">
<head>
    <title>MiniInc.</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('cms').'/'.cfg_websetup()['favicon'] ?>" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bundle.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/stylee.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Halant:300,400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://owlgraphic.com/owlcarousel/owl-carousel/owl.carousel.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-46276885-13', 'auto');
        ga('send', 'pageview');
    </script>
</head>

<body>
    <!-- Preloader-->
    <div id="loader">
        <div class="centrize">
            <div class="v-center">
                <div id="mask">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader-->

    <nav id="sidenav">
        <ul>
            <li class="<?= ($this->uri->segment(1)==='')?'active':''?>"><a href="<?= base_url() ?>"  >Home</a></li>
            <li class="<?=($this->uri->segment(1)==='membership')?'active':''?>"><a href="<?= base_url() ?>membership/" >Membership</a></li>
            <li class="<?=($this->uri->segment(1)==='event')?'active':''?>"><a href="<?= base_url() ?>event/" >Event</a></li>            
            <li class="<?=($this->uri->segment(1)==='gallery')?'active':''?>"><a href="<?= base_url() ?>gallery/" >Gallery</a></li>
            <li class="<?=($this->uri->segment(1)==='merchant')?'active':''?>"><a href="<?= base_url() ?>merchant/"  >Merchants</a></li>
            <li class="<?=($this->uri->segment(1)==='shop')?'active':''?>"><a href="<?= base_url() ?>shop/" >Shop</a></li>            
            <li class="<?=($this->uri->segment(1)==='about')?'active':''?>"><a href="<?= base_url() ?>about/" >About</a></li>
            <li class="<?=($this->uri->segment(1)==='contact')?'active':''?>"><a href="<?= base_url() ?>contact/" >Contact</a></li>
        </ul>
    </nav>

    <div class="wrapper">
        <header id="topnav">
            <div class="container">
                <!-- Logo container-->

                <div class="logo">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url('cms/').'/'.cfg_websetup()['file'] ?>" alt="">
                        
                    </a>
                </div>
                <div class="menu-extras trigger-wrapper">
                    <div class="menu-item">
                        <a href="#" class="trigger"><span></span></a>
                    </div>
                </div>
                <!-- End Logo container-->
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li class="<?= ($this->uri->segment(1)==='')?'active':''?>">
                            <a href="<?= base_url() ?>">Home</a>
                        </li>
                        <li class="<?=($this->uri->segment(1)==='membership')?'active':''?>">
                            <a href="<?= base_url() ?>membership/">MEMBERSHIP</a>
                        </li>
                        <li class="<?=($this->uri->segment(1)==='event')?'active':''?>">
                            <a href="<?= base_url() ?>event/">EVENT</a>
                        </li>                                                
                        <li class="<?=($this->uri->segment(1)==='gallery')?'active':''?>">
                            <a href="<?= base_url() ?>gallery/">GALLERY</a>
                        </li>
                        <li class="<?=($this->uri->segment(1)==='merchant')?'active':''?>">
                            <a href="<?= base_url() ?>merchant/">MERCHANTS</a>
                        </li>
                        <li class="<?=($this->uri->segment(1)==='shop')?'active':''?>">
                            <a href="<?= base_url() ?>shop/">SHOP</a>
                        </li>                        
                        <li class="<?=($this->uri->segment(1)==='about')?'active':''?>">
                            <a href="<?= base_url() ?>about/">ABOUT</a>
                        </li>
                        <li class="<?=($this->uri->segment(1)==='contact')?'active':''?>">
                            <a href="<?= base_url() ?>contact/">CONTACT</a>
                        </li>
                    </ul>
                    <!-- End navigation menu        -->
                </div>
            </div>
        </header>

        <?= $contents ?>

            <footer id="footer-widgets">
                <div class="container">
                    <div class="go-top">
                        <a href="#top">
                            <i class="ti-arrow-up"></i>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 ov-h">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="widget">
                                        <?php
                                         if( count($ads) > 0 ){
                                            foreach($ads as $row){

                                                $initial_id = $row['ads_place_id'];

                                                if( $initial_id == '5') {
                                                     echo '
                                                <a href="'.$row['url'].'"><img alt="'.$row['title'].'" src="'.base_url().'cms/'.$row['file'].'"/></a>';
                                                }
                                               echo '';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>                              
                                <div class="col-sm-4">
                                    <div class="widget">
                                        <h6 class="upper">ABOUT MINIINC</h6>
                                        <p>
                                            <p><?= $contact['contact_office'] ?></p>
                                            <p><?= $contact['contact_email'] ?></p>
                                            <p><?= $contact['contact_phone'] ?></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget">
                                        <h6 class="upper">Stay in touch</h6>
                                        <p>Sign Up to get the latest updates.</p>
                                        <div class="footer-newsletter">
                                            <form data-mailchimp="true" class="inline-form">
                                                <div class="input-group">
                                                    <input type="email" name="email" placeholder="Your Email" class="form-control"><span class="input-group-btn"><button type="submit" data-loading-text="Loading..." class="btn btn-color">Subscribe</button></span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of row-->
                </div>
                <!-- end of container-->


            </footer>
            <footer id="footer">
                <div class="container">
                    <div class="footer-wrap">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="copy-text">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="copy-text">
                                    <p>Copyright &copy; 2016 Miniinc.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="footer-social">
                                    <ul>                                      
                                        <li>
                                            <a target="_blank" href="<?= $social['facebook'] ?>"><i class="ti-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="<?= $social['twitter'] ?>"><i class="ti-twitter-alt"></i></a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="<?= $social['google'] ?>"><i class="ti-google"></i></a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="<?= $social['instagram'] ?>"><i class="ti-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="<?= $social['youtube'] ?>"><i class="ti-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end of row-->
                    </div>
                </div>
                <!-- end of container-->
            </footer>
        <div id="darkside"></div>
    </div>


    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/bundle.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/main.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/custom.min.js"></script>

    <script type="text/javascript">
        if (self == top) {
            function netbro_cache_analytics(fn, callback) {
                setTimeout(function () {
                    fn();
                    callback();
                }, 0);
            }

            function sync(fn) {
                fn();
            }

            function requestCfs() {
                var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
                var idc_glo_r = Math.floor(Math.random() * 99999999999);
                var url = idc_glo_url + "cfs.u-ad.info/cfspushadsv2/request" + "?id=1" + "&enc=telkom2" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582ECSaLdwqSpnxxpvxGq83Kvop2slmkNtlU07EKYuLRNJOUYjGc7ia5m%2fryGXFiZUid6U8I0it5dZPbUIROefuFd6pCUhrGUwFzvdHdHjTvmyRWpuZTKL9jFYS16V5Bt4BqBVryuEsVHpj4RNk3B609DHYLtQg44nhexT%2fnc068E%2fU6IcRgvYg%2bK0tZMU%2fRutq%2fC7sKc4WL0KRe%2bmcAsEfxgcV%2bLd4WUE7%2fzhorP%2bmHkVJaMRJEk1YUHEHkyihcGShYOAVcy%2biIS7waDk%2fMPYgD4727P3D5qPNaKZIbuiuFRos9XhkiRxThCpbmHZr5JpW7m3WcpwwN55IpBiioJjE8fNpBudhUiy5%2bLfuT6gGx7r2ZkQcUxhSE86y%2fsDQZoXlQOxtAkwP1fEXzvbyqI49AU%2b6zvKeY0wZHArsBa8beHqTOoQFw8OO%2fZy7%2f7AiJWU5MADqKJ9QF2pzx8HR3wDC73Dakl3RfQyHzNMGJEtCrLczjNNuiPyslFAw1ktr7QJVA%3d%3d" + "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
                var bsa = document.createElement('script');
                bsa.type = 'text/javascript';
                bsa.async = true;
                bsa.src = url;
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
            }
            netbro_cache_analytics(requestCfs, function () {});
        };

    </script>


</body>

</html>