<?php
include('src/includes/constant.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bit Mine Pool </title>
        <link type="image/x-icon" href="img/tab.png" rel="icon">

        <!-- responsive meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- master stylesheet -->
        <link rel="stylesheet" href="css/style.css">
        <!-- responsive stylesheet -->
        <link rel="stylesheet" href="css/bootstrap-margin-padding.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="vendor/slider/css/nivo-slider.css" type="text/css">
        <link rel="stylesheet" href="vendor/slider/css/preview.css" type="text/css" media="screen">


    </head>
    <body id="top" class="page-wrapper">


        <section class="top-bar">
            <div class="container">

                <div class="left-text pull-left">
                    <p><span>Support Us :</span> support@bitminepool.com</p>
                </div> <!-- /.left-text -->

                <div class="social-icons pull-right">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div> <!-- /.social-icons -->
            </div>
        </section> <!-- /.top-bar -->

        <header class="header">
            <div class="container">
                <div class="logo pull-left">
                    <a href="<?php echo BASE_URL; ?>">
                        <img src="img/resources/logo.png" alt="Awesome Image"/>
                    </a>
                </div>
                <div class="header-right-info pull-right clearfix">
                    <div class="single-header-info">
                        <div class="icon-box">
                            <div class="inner-box">
                                <i class="flaticon-interface-2"></i>
                            </div>
                        </div>
                        <div class="content">
                            <p>support@bitminepool.com</p>
                        </div>
                    </div>
                    <div class="single-header-info">
                        <div class="icon-box">
                            <div class="inner-box">
                                <i class="flaticon-telephone"></i>
                            </div>
                        </div>
                        <div class="content">
                            <p><b>(732) 803-010-03</b></p>
                        </div>
                    </div>
                    <div class="single-header-info">
                        <!-- Modal: donate now Starts -->
                        <a class="thm-btn"  href="src/login">Login</a>
                        <a class="thm-btn" href="src/register?account=24rgxpwex1b4ko88owko">Signup</a>
                        <a class="thm-btn" href="src/register?account=24rgxpwex1b4ko88owko&is_wallet=1">Create wallet</a>
                        <!-- Modal: donate now Ends -->
                    </div>
                </div>
            </div>
        </header> <!-- /.header -->


        <nav class="mainmenu-area stricky">
            <div class="container">
                <div class="navigation">
                    <div class="nav-header">
                        <ul>
                            <li class="dropdown">
                                <a href="#top">Home</a>
                                <ul class="submenu">
                                    <!-- <li><a href="index.html">Home One</a></li>
                                    <li><a href="index2.html">Home Two</a></li> -->
                                </ul>
                            </li>
                            <li></li>						
                            <!--<li class="dropdown">
                                    <a href="#services">Services</a>
                                    <ul class="submenu">
                                    </ul>
                            </li>	-->					
                            <!--<li class="dropdown">
                                    <a href="#">Events</a>
                                    <ul class="submenu">
                                            <li><a href="events-grid.html">Events Grid</a></li>
                                            <li><a href="events-list.html">Events List</a></li>
                                            <li><a href="events-single.html">Event Single</a></li>
                                    </ul>
                            </li>-->
                            <li class="dropdown">
                                <a href="#about-us">About Us</a>
                                <ul class="submenu">
                                    <!--<li><a href="team-style-one.html">Team Style One</a></li>
                                    <li><a href="team-style-two.html">Team Style Two</a></li>
                                    <li><a href="team-profile.html">Team Profile</a></li>-->
                                </ul>
                            </li>
                            <li><a href="#pricing-table">Pricing table</a></li>
                            <li class="dropdown">

                                <ul class="submenu">
                                    <!--<li><a href="about.html">About</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="faq.html">FAQ</a></li>-->
                                </ul> 
                            </li> 
                            <li class="dropdown">
                                <a href="#contact-us">Contact us</a>
                                <ul class="submenu">
                                    <!-- <li><a href="blog-style-one.html">Blog Style One</a></li>
                                    <li><a href="blog-style-two.html">Blog Style Two</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li> -->
                                </ul>
                            </li>
                            <li><a href="#faq">Faq</a></li>
                        </ul>
                    </div>
                    <div class="nav-footer">
                        <button><i class="fa fa-bars"></i></button>
                    </div>
                </div>
            </div>
        </nav> <!-- /.mainmenu-area -->


        <div class="slider1-area overlay-default index1">
            <div class="bend niceties preview-1">
                <div id="ensign-nivoslider-3" class="slides nivoSlider">   
                    <img src="img/slides/1.jpg" alt="slider" title="#slider-direction-1">
                    <img src="img/slides/2.jpg" alt="slider" title="#slider-direction-2">
                </div>
                <!-- <div class="nivo-controlNav nivo-thumbs-enabled"></div>  -->
                <div id="slider-direction-1" class="t-cn slider-direction">
                    <div class="slider-content s-tb slide-1">
                        <div class="title-container s-tb-c">
                            <h1 class="title1">Welcome to Bit Mine Pool</h1>
                            <p>At bitcoin mine pool you can earn bitcoins through mining. It is very easy <br> Just purchase a mining contract from us and we will handle the rest of the process for you <br> hustle free. Join over 500,000 people with the world's leading bitcoin mining pool today </p>
                            <div class="slider-btn-area">
                                <a href="src/login" class="default-big-btn">Start today</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="slider-direction-2" class="t-cn slider-direction">
                    <div class="slider-content s-tb slide-2">
                        <div class="title-container s-tb-c">
                            <h1 class="title1">Welcome to Bit Mine Pool</h1>
                            <p>At bitcoin mine pool you can earn bitcoins through mining. It is very easy <br> Just purchase a mining contract from us and we will handle the rest of the process for you <br> hustle free. Join over 500,000 people with the world's leading bitcoin mining pool today </p>
                            <div class="slider-btn-area">
                                <a href="src/login" class="default-big-btn">Start today</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        <section id='about-us' class="sec-padding about-content full-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="full-sec-content mb-md-30">
                            <div class="sec-title style-two colored">
                                <h2>More about us</h2>
                                <span class="decor">
                                    <span class="inner"></span>
                                </span>
                            </div>
                            <h3>Discover more about the mission, vision, <br>current year plans and the people behind the Bitcoin mining Foundation  </h3>
                            <br>
                            <p>Bit Mine Pool (BMP) was founded in January 2016. The founders of BMP got to know each other through trading of cryptocurrencies. As the cryptocurrency trading grew over time several traders teamed up to form a team and pull their resources together to start mining cryptocurrency together and share the proceeds.</p> 
                            <br>
                            <p> As a result BMP was born. The current members of our bitcoin mining team come from different scientific disciplines, but our common faith in cryptocurrencies has brought us together. We are all strong believers in the future of digital currencies and we love being part of this growing community!</p>

                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <img class="full-width" src="img/resources/about-1.jpg" alt="Awesome Image"/>
                    </div>
                </div>
            </div>
        </section>





        <section class="home-serivce sec-padding pb-40">
            <div class="container">
                <div class="sec-title text-center colored">
                    <h2>Our Mission</h2>

                    <span class="decor"><span class="inner"></span></span>
                </div>
                <div class="row single-service-style">
                    <div class="col-md-4 col-sm-6">
                        <div class="single-service-home">
                            <div class="content">
                                <img src="img/bit/671474.svg" alt="">
                                <h3>Efficient Hardware Management</h3>
                                <p>We take the hustle of mining from you and just give the one thing you need which is Bitcoin. Most people get challenges in acquiring, setup, running and maintaining the mining equipment hence making individual mining a very expensive affair. We purchase, install, run, manage and maintain all the mining equipment on your behalf. Hence you just receive Bitcoin in your Bitcoin wallet. This eliminates equipment running.e </p>
                                <a class="btn-details" href="bitcoin_system/production/Register.php?Account=8ygwmun45uskowwkg0w4 ">Sign up now!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-service-home">
                            <div class="content">
                                <img src="img/bit/671475.svg" alt="">
                                <h3>Alternative Cryptocurrencies Mining</h3>
                                <p>We allow our members to switch their mining power to any cryptocurrency that is available on our catalogue. This enables them to get the returns they want hence increased flexibility. This feature give the member total control over mining and enables him or her to mine the most profitable cryptocurrency at the time. However, the system can also automatically mine the most profitable cryptocurrency on behalf of the member. </p>
                                <a class="btn-details" href="bitcoin_system/production/Register.php?Account=8ygwmun45uskowwkg0w4 ">Sign up now!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-service-home">
                            <div class="content">
                                <img src="img/bit/671476.svg" alt="">
                                <h3>Get Daily Payouts</h3>
                                <p>At BMH members get a daily payout in form of Bitcoin from the daily mining activity. This enables the member to track his or her earning effectively and efficiently through our systems. The payment is real time hence no delays.  The Bitcoin can be withdrawn to the member designated wallet which he or she registered during the registration process. All the other cryptocurrencies mined are converted into Bitcoin. </p>
                                <a class="btn-details" href="bitcoin_system/production/Register.php?Account=8ygwmun45uskowwkg0w4 ">Sign up now! </a>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-4 col-sm-6">
                            <div class="single-service-home">
                                    <div class="content">
                                            <img src="img/bit/671477.svg" alt="">
                                            <h3>Health</h3>
                                            <p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
                                            <a class="btn-details" href="service-details.html">Read More</a>
                                    </div>
                            </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                            <div class="single-service-home">
                                    <div class="content">
                                            <img src="img/bit/671478.svg" alt="">
                                            <h3>Hunger</h3>
                                            <p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
                                            <a class="btn-details" href="service-details.html">Read More</a>
                                    </div>
                            </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                            <div class="single-service-home">
                                    <div class="content">
                                            <img src="img/bit/671479.svg" alt="">
                                            <h3>Emergencies</h3>
                                            <p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
                                            <a class="btn-details" href="service-details.html">Read More</a>
                                    </div>
                            </div>
                    </div>-->
                </div>
            </div>
        </section>


        <section class="sec-padding faq-home">
            <div class="container">
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="sec-title style-two colored">
                            <h2>Why Choose us?</h2>
                            <span class="decor">
                                <span class="inner"></span>
                            </span>
                        </div>
                        <div class="accrodion-grp" data-grp-name="faq-accrodion">
                            <div class="accrodion active">
                                <div class="accrodion-title">
                                    <h4>
                                        <span class="decor">
                                            <span class="inner"></span>
                                        </span>
                                        <span class="text">We provide tailor-made solutions </span>
                                    </h4>
                                </div>
                                <div class="accrodion-content">
                                    <p>We have specialized in mining alternative coins and converting the coins into Bitcoin for our clients instead of mining Bitcoin directly in the overcrowded Bitcoin mining space. These enable our clients to get a faster rate on return of investment and also make more profits.</p> 
                                    <p> We also have invested in smart systems that can be able to select the most profitable coin to mine in the last 10 minutes. </p>
                                </div>
                            </div>
                            <div class="accrodion ">
                                <div class="accrodion-title">
                                    <h4>
                                        <span class="decor">
                                            <span class="inner"></span>
                                        </span>
                                        <span class="text">Increased profitability in mining </span>
                                    </h4>
                                </div>
                                <div class="accrodion-content">
                                    <p>We ensure that no matter which package the client chooses he or she can get proper return on investment. This is because we are using the current and most advanced systems to mine cryptocurrency which guarantees profitability to our client.</p>
                                    <p> We also ensure that we minimize the cost of mining and maximize revenue. Cost minimization can come in through using efficient machines that use low power and are high in performance. </p>

                                </div>
                            </div>
                            <div class="accrodion ">
                                <div class="accrodion-title">
                                    <h4>
                                        <span class="decor">
                                            <span class="inner"></span>
                                        </span>
                                        <span class="text">Simplified Cloud mining</span>
                                    </h4>
                                </div>
                                <div class="accrodion-content">
                                    <p>It is an uphill task to setup and run a mining rig hence most of our clients don’t have to worry about buying or put ting up a rig in order to mine cryptocurrency.</p>
                                    <p>We take care of all the hustle, expenses, maintenance and daily running of the equipment hence the client will only receive revenue or income from the operation.</p>
                                    <p> Additionally, with our systems there is no down time or any wastage of time in terms of operations the whole system is automated and enables the client to have time to concentrate on other activities while earning from his or her investment.</p>
                                </div>
                            </div>
                            <div class="accrodion ">
                                <div class="accrodion-title">
                                    <h4>
                                        <span class="decor">
                                            <span class="inner"></span>
                                        </span>
                                        <span class="text">Dedicated Staff</span>
                                    </h4>
                                </div>
                                <div class="accrodion-content">
                                    <p>At Bit Mine Pool, we have dedicated staff to ensure that we deliver to our clients our promise. Additionally, we are more than ready to help our client whenever they need assistance or need any clarification. </p>
                                    <p> Our excellent customer care service enables us to solve all issues that can arise from any of our client. Similarly, our online system is very simple and easy to navigate and understand with ease. </p>							
                                </div>
                            </div>
                            <div class="accrodion ">
                                <div class="accrodion-title">
                                    <h4>
                                        <span class="decor">
                                            <span class="inner"></span>
                                        </span>
                                        <span class="text">Competitive Pricing</span>
                                    </h4>
                                </div>
                                <div class="accrodion-content">
                                    <p>Our products are very competitive in terms of pricing. Additionally, there are no pool fees for our clients hence making it more efficient and easy to use. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 hidden-md hidden-sm hidden-xs">
                        <div class="img-masonary">
                            <div class="img-w1">
                                <img src="img/faq/1.jpg" height="450" width="280" alt="">
                            </div>
                            <div class="img-w1 img-h1">
                                <img src="img/faq/2.jpg" height="450" width="280" alt="">
                            </div>
                            <div class="img-w1 img-h1">
                                <img src="img/faq/3.jpg" height="450" width="280" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <!-- <section id ='services' class="recent-causes sec-padding pb_60">
                <div class="container">
                        <div class="sec-title text-center colored">
                                <h2>Services</h2>
                                <p>Lorem ipsum is a dummy text it will use for subtitle here</p>
                                <span class="decor"><span class="inner"></span></span>
                        </div>
                        <div class="row causes-style piechart-style">
                  <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="causes sm-col5-center mb_30">
                      <div class="thumb">
                        <img class="full-width" alt="" src="img/causes/service-6.png">
                        
                      </div>
                        <div class="causes-details clearfix">
                                <h4 class="title"><a href="#">Bitcoin Transaction</a></h4>
                                <ul class="about-causes list-inline clearfix">
                                  
                                  <li class="causes-goal">Price: $2500</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur ambo elit. Numquam repellendus est rerum sed, aliquid atup inventore, voluptate, eveniet, soluta nostrum sint.</p>
                                <div>
                                 <a class="thm-btn btn-xs" href="src/login">Buy now</a>
                                 
                                </div>
                            </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="causes sm-col5-center mb_30">
                      <div class="thumb">
                        <img class="full-width" alt="" src="img/causes/service-5.png">
                        
                      </div>
                      <div class="causes-details clearfix">
                                <h4 class="title"><a href="#">Bitcoin Exchange</a></h4>
                                <ul class="about-causes list-inline clearfix">
                                  
                                  <li class="causes-goal">Price: $2500</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur ambo elit. Numquam repellendus est rerum sed, aliquid atup inventore, voluptate, eveniet, soluta nostrum sint.</p>
                                <div>
                                 <a class="thm-btn btn-xs" href="src/login">Buy now</a>
                                 
                                </div>
                            </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="causes sm-col5-center mb_30">
                      <div class="thumb">
                        <img class="full-width" alt="" src="img/causes/service-4.png">
                        
                      </div>
                      <div class="causes-details clearfix">
                                <h4 class="title"><a href="#">Bitcoin Investment</a></h4>
                                <ul class="about-causes list-inline clearfix">
                                  
                                  <li class="causes-goal">Price: $2500</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur ambo elit. Numquam repellendus est rerum sed, aliquid atup inventore, voluptate, eveniet, soluta nostrum sint.</p>
                                <div>
                                 <a class="thm-btn btn-xs" href="src/login">Buy now</a>
                                 
                                </div>
                            </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="causes sm-col5-center mb_30">
                      <div class="thumb">
                        <img class="full-width" alt="" src="img/causes/service-3.png">
                        
                      </div>
                      <div class="causes-details clearfix">
                                <h4 class="title"><a href="#">Bitcoin Escrow Service</a></h4>
                                <ul class="about-causes list-inline clearfix">
                                  
                                  <li class="causes-goal">Price: $2500</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur ambo elit. Numquam repellendus est rerum sed, aliquid atup inventore, voluptate, eveniet, soluta nostrum sint.</p>
                                <div>
                                 <a class="thm-btn btn-xs" href="src/login">Buy now</a>
                                 
                                </div>
                            </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="causes sm-col5-center mb_30">
                      <div class="thumb">
                        <img class="full-width" alt="" src="img/causes/service-2.png">
                        
                      </div>
                      <div class="causes-details clearfix">
                                <h4 class="title"><a href="#">Bitcoin Mining</a></h4>
                                <ul class="about-causes list-inline clearfix">
                                  
                                  <li class="causes-goal">Price: $2500</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur ambo elit. Numquam repellendus est rerum sed, aliquid atup inventore, voluptate, eveniet, soluta nostrum sint.</p>
                                <div>
                                 <a class="thm-btn btn-xs" href="src/login">Buy now</a>
                                 
                                </div>
                            </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="causes sm-col5-center mb_30">
                      <div class="thumb">
                        <img class="full-width" alt="" src="img/causes/service-1.png">
                      </div>
                      <div class="causes-details clearfix">
                                <h4 class="title"><a href="#">Bitcoin Shopping</a></h4>
                                <ul class="about-causes list-inline clearfix">
                                  
                                  <li class="causes-goal">Price: $2500</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur ambo elit. Numquam repellendus est rerum sed, aliquid atup inventore, voluptate, eveniet, soluta nostrum sint.</p>
                                <div>
                                 <a class="thm-btn btn-xs" href="src/login">Buy now</a>
                                 
                                </div>
                            </div>
                    </div>
                  </div>
                  <div class="col-sm-12">

                  </div>
                </div>
                </div>
        </section> -->
        <section class="fact-counter-wrapper sec-padding parallax-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 md-text-center">
                        <h2>We are served since <b>35 years</b> <br>to helpless people with trust and <br>we are happy</h2>
                        <a href="src/login" class="thm-btn inverse mb-md-40">Be a part of us</a>
                    </div>
                    <div class="col-lg-8 col-md-12 md-text-center">
                        <div class="single-fact">
                            <div class="icon-box">
                                <i class="flaticon-shapes-2"></i>
                            </div>
                            <span class="timer" data-from="10" data-to="1368" data-speed="5000" data-refresh-interval="50">136800</span>
                            <p>Total Trainings</p>
                        </div>
                        <div class="single-fact">
                            <div class="icon-box">
                                <i class="flaticon-people-3"></i>
                            </div>
                            <span class="timer" data-from="10" data-to="5000" data-speed="5000" data-refresh-interval="50">5000</span>
                            <p>Total Members</p>
                        </div>
                        <div class="single-fact">
                            <div class="icon-box">
                                <i class="flaticon-hands"></i>
                            </div>
                            <span class="timer" data-from="10" data-to="7800" data-speed="5000" data-refresh-interval="50">7800</span>
                            <p>Total Staffs</p>
                        </div>
                        <div class="single-fact">
                            <div class="icon-box">
                                <i class="flaticon-people-3"></i>
                            </div>
                            <span class="timer" data-from="10" data-to="5000" data-speed="5000" data-refresh-interval="50">5000</span>
                            <p>Customer Care</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>











        <!--<section class="sec-padding our-team">
                <div class="container">
                        <div class="row">
                                <div class="col-xs-12">
                                        <div class="sec-title text-center colored">
                                                <h2>Our Experts</h2>
                                                <p>Lorem ipsum is a dummy text it will use for subtitle here</p>
                                                <span class="decor"><span class="inner"></span></span>
                                        </div>
                                </div>
                        </div>
                        <div class="clearfix">
                                <div class="team-carousel owl-carousel owl-theme">
                                        <div class="item">
                                                <div class="single-team-member">
                                                        <div class="img-box">
                                                                <img src="img/team/1.jpg" alt="">
                                                                <div class="overlay">
                                                                        <div class="box">
                                                                                <div class="content">
                                                                                        <ul>
                                                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                                                        </ul>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <h3>Muhibbur Rashid</h3>
                                                        <span>Businessman</span>
                                                </div>
                                        </div>
                                        <div class="item">
                                                <div class="single-team-member">
                                                        <div class="img-box">
                                                                <img src="img/team/2.jpg" alt="">
                                                                <div class="overlay">
                                                                        <div class="box">
                                                                                <div class="content">
                                                                                        <ul>
                                                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                                                        </ul>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <h3>Rashed Kabir</h3>	
                                                        <span>Businessman</span>					
                                                </div>
                                        </div>
                                        <div class="item">
                                                <div class="single-team-member">
                                                        <div class="img-box">
                                                                <img src="img/team/3.jpg" alt="">
                                                                <div class="overlay">
                                                                        <div class="box">
                                                                                <div class="content">
                                                                                        <ul>
                                                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                                                        </ul>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <h3>Jannatul Ferdous</h3>						
                                                        <span>Businessman</span>
                                                        
                                                </div>
                                        </div>
                                        <div class="item">
                                                <div class="single-team-member">
                                                        <div class="img-box">
                                                                <img src="img/team/4.jpg" alt="">
                                                                <div class="overlay">
                                                                        <div class="box">
                                                                                <div class="content">
                                                                                        <ul>
                                                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                                                        </ul>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <h3>Ashikur Rahman</h3>
                                                        <span>Businessman</span>
                                                        
                                                </div>
                                        </div>
                                        <div class="item">
                                                <div class="single-team-member">
                                                        <div class="img-box">
                                                                <img src="img/team/1.jpg" alt="">
                                                                <div class="overlay">
                                                                        <div class="box">
                                                                                <div class="content">
                                                                                        <ul>
                                                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                                                        </ul>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <h3>Muhibbur Rashid</h3>
                                                        <span>Businessman</span>
                                                        
                                                </div>
                                        </div>
                                        <div class="item">
                                                <div class="single-team-member">
                                                        <div class="img-box">
                                                                <img src="img/team/2.jpg" alt="">
                                                                <div class="overlay">
                                                                        <div class="box">
                                                                                <div class="content">
                                                                                        <ul>
                                                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                                                        </ul>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <h3>Rashed Kabir</h3>						
                                                        <span>Businessman</span>
                                                        
                                                </div>
                                        </div>
                                        <div class="item">
                                                <div class="single-team-member">
                                                        <div class="img-box">
                                                                <img src="img/team/3.jpg" alt="">
                                                                <div class="overlay">
                                                                        <div class="box">
                                                                                <div class="content">
                                                                                        <ul>
                                                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                                                        </ul>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <h3>Jannatul Ferdous</h3>						
                                                        <span>Businessman</span>
                                                        
                                                </div>
                                        </div>
                                        <div class="item">
                                                <div class="single-team-member">
                                                        <div class="img-box">
                                                                <img src="img/team/4.jpg" alt="">
                                                                <div class="overlay">
                                                                        <div class="box">
                                                                                <div class="content">
                                                                                        <ul>
                                                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                                                        </ul>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <h3>Ashikur Rahman</h3>
                                                        <span>Businessman</span>
                                                        
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </section>
        -->




        <section id="pricing-table" class="blog-home sec-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="sec-title text-center colored">
                            <h2>Pricing table</h2>
                            <p>Below are our packs that you can purchase and start mining with us <br> They also show which coins you have the ability to switch between</p>
                            <span class="decor"><span class="inner"></span></span>
                        </div>
                    </div>
                </div>
                <div class="row events-grid">
                    <div class="col-sm-6 col-md-4">
                        <div class="event-post">
                            <div class="thumb">
                                <img src="img/event/ue1.jpg" alt="">
                                <div class="overlay">
                                    <a href="src/login">Join Us</a>

                                </div>
                            </div>
                            <div class="caption custom-price-table">
                                <h3 class="title"><a href="src/login">Pool 1</a></h3>
                                <p class="event-location">
                                <ul >
                                    <li>

                                        <p>&#36; 300</p>
                                    </li>
                                    <li><p>Bitcoin (Available)</p></li>
                                    <li><p>Ethereum (Unavailable)</p></li>
                                    <li><p>Ethereum Classic (Unavailable)</p></li>
                                    <li><p>Litecoin (Unavailable)</p></li>
                                    <li><p>Monero (Unavailable)</p></li>
                                    <li><p>Zcash (Unavailable)</p></li>

                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="event-post">
                            <div class="thumb">
                                <img src="img/event/ue2.jpg" alt="">
                                <div class="overlay">
                                    <a href="src/login">Join Us</a>

                                </div>
                            </div>
                            <div class="caption custom-price-table">
                                <h3 class="title"><a href="src/login">Pool 2</a></h3>
                                <p class="event-location">
                                <ul >
                                    <li>

                                        <p>&#36; 600</p>
                                    </li>
                                    <li><p>Bitcoin (Available)</p></li>
                                    <li><p>Ethereum (Available)</p></li>
                                    <li><p>Ethereum Classic (Unavailable)</p></li>
                                    <li><p>Litecoin (Unavailable)</p></li>
                                    <li><p>Monero (Unavailable)</p></li>
                                    <li><p>Zcash (Unavailable)</p></li>

                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="event-post">
                            <div class="thumb">
                                <img src="img/event/ue3.jpg" alt="">
                                <div class="overlay">
                                    <a href="src/login">Join Us</a>

                                </div>
                            </div>
                            <div class="caption custom-price-table">
                                <h3 class="title"><a href="src/login">Pool 3</a></h3>
                                <p class="event-location">
                                <ul >
                                    <li>

                                        <p>&#36; 1,200</p>
                                    </li>
                                    <li><p>Bitcoin (Available)</p></li>
                                    <li><p>Ethereum (Available)</p></li>
                                    <li><p>Ethereum Classic (Available)</p></li>
                                    <li><p>Litecoin (Unavailable)</p></li>
                                    <li><p>Monero (Unavailable)</p></li>
                                    <li><p>Zcash (Unavailable)</p></li>

                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="event-post">
                            <div class="thumb">
                                <img src="img/event/ue1.jpg" alt="">
                                <div class="overlay">
                                    <a href="src/login">Join Us</a>

                                </div>
                            </div>
                            <div class="caption custom-price-table">
                                <h3 class="title"><a href="src/login">Pool 4</a></h3>
                                <p class="event-location">
                                <ul >
                                    <li>

                                        <p>&#36; 2,400</p>
                                    </li>
                                    <li><p>Bitcoin (Available)</p></li>
                                    <li><p>Ethereum (Available)</p></li>
                                    <li><p>Ethereum Classic (Available)</p></li>
                                    <li><p>Litecoin (Available)</p></li>
                                    <li><p>Monero (Unavailable)</p></li>
                                    <li><p>Zcash (Unavailable)</p></li>

                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="event-post">
                            <div class="thumb">
                                <img src="img/event/ue2.jpg" alt="">
                                <div class="overlay">
                                    <a href="src/login">Join Us</a>

                                </div>
                            </div>
                            <div class="caption custom-price-table">
                                <h3 class="title"><a href="src/login">Pool 5</a></h3>
                                <p class="event-location">
                                <ul >
                                    <li>

                                        <p>&#36; 4,800</p>
                                    </li>
                                    <li><p>Bitcoin (Available)</p></li>
                                    <li><p>Ethereum (Available)</p></li>
                                    <li><p>Ethereum Classic (Available)</p></li>
                                    <li><p>Litecoin (Available)</p></li>
                                    <li><p>Monero (Available)</p></li>
                                    <li><p>Zcash (Available)</p></li>

                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id='contact-us' class="contact-content upcoming-event sec-padding bg-pattern pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="sec-title text-center colored">
                            <h2 class="text-white">Contact Us</h2>
                            <p class="text-white">For any inquiries please contact us by writing to us <br> and interact with us. we will be pleased to serve you better.</p>
                            <span class="decor"><span class="inner"></span></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div id="contact_result" class="alert alert-danger fade alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span></span>
                        </div>


                    </div>
                    <div class="col-md-12 col-xs-12">
                        <form id="contact-page-contact-form" action="bitcoin_system/production/send_form_email" class="contact-form row" action="" novalidate="novalidate">
                            <div class="col-md-6">
                                <input type="text" placeholder="Name" name="name">
                                <input type="text" placeholder="Email" name="email">
                                <input type="text" placeholder="Phone" name="phone">

                            </div>
                            <div class="col-md-6">
                                <textarea rows="10" cols="30" placeholder="Message" name="message"></textarea>
                            </div>
                            <div class="col-md-12"><button type="submit" class="thm-btn mb-sm-60">Send</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section id='faq' class="blog-home sec-padding">
            <div class="container">
                <div class="sec-title text-center colored">
                    <h2>FAQ</h2>
                    <p>These are some of the Frequently Asked Questions in various forums<br> some of them are adressed below</p>
                    <span class="decor">
                        <span class="inner"></span>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 sm-col5-center mb-sm-40">
                        <div class="single-blog-post">
                            <div class="img-box">
                                <img class="full-width" src="img/blog/1.jpg" alt="">
                                <div class="overlay">
                                    <div class="box">
                                        <div class="content">
                                            <ul>
                                                <li><a href="src/login"><i class="fa fa-link"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="date-box">
                                    <div class="inner">
                                        <div class="date">
                                            <b>18</b>
                                            Sept
                                        </div>
                                        <!--<div class="comment">
                                                <i class="flaticon-interface-1"></i> 8
                                        </div>-->
                                    </div>
                                </div>
                                <div class="content">
                                    <!-- <a href="blog-details.html"><h3>Lates blog post with image</h3></a>
                                    <p>There are many variations passages available, but the lorem, ipsum... </p>
                                    <a class="btn-details" href="blog-details.html">Read More</a> -->
                                    <h3>What is Bitcoin Mine Pool?</h3>
                                    <h4>By James </h4>
                                    <p>
                                        Bitcoin Mine Pool (BMP) is a cloud mining service that enables people to get involved in mining without having to deal with purchase of the mining hardware, maintenance, installation and support. We offer a vast range of cryptocurrency mining solution all in one platform. 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 sm-col5-center mb-sm-40">
                        <div class="single-blog-post">
                            <div class="img-box">
                                <img class="full-width" src="img/blog/2.jpg" alt="">
                                <div class="overlay">
                                    <div class="box">
                                        <div class="content">
                                            <ul>
                                                <li><a href="src/login"><i class="fa fa-link"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="date-box">
                                    <div class="inner">
                                        <div class="date">
                                            <b>12</b>
                                            Nov
                                        </div>
                                        <!--<div class="comment">
                                                <i class="flaticon-interface-1"></i> 8
                                        </div>-->
                                    </div>
                                </div>
                                <div class="content">
                                    <!-- <a href="blog-details.html"><h3>Lates blog post with image</h3></a>
                                    <p>There are many variations passages available, but the lorem, ipsum... </p>
                                    <a class="btn-details" href="blog-details.html">Read More</a> -->
                                    <h3>Which pool do you use to mine?</h3>
                                    <h4>By Freeman </h4>
                                    <p>
                                        At Bitcoin Mine Pool we use different pools to mine. We do not use any specific pool to mine this is because we want reliability and consistency in terms of having a good mining portfolio. We look at several aspects in order to select which pool to mine from. However, we ensure profitability. 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 sm-col5-center mb-sm-40">
                        <div class="single-blog-post">
                            <div class="img-box">
                                <img class="full-width" src="img/blog/3.jpg" alt="">
                                <div class="overlay">
                                    <div class="box">
                                        <div class="content">
                                            <ul>
                                                <li><a href="src/login"><i class="fa fa-link"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="date-box">
                                    <div class="inner">
                                        <div class="date">
                                            <b>11</b>
                                            Jan
                                        </div>
                                        <!--<div class="comment">
                                                <i class="flaticon-interface-1"></i> 8
                                        </div>-->
                                    </div>
                                </div>
                                <div class="content">
                                    <!-- <a href="blog-details.html"><h3>Lates blog post with image</h3></a>
                                    <p>There are many variations passages available, but the lorem, ipsum... </p>
                                    <a class="btn-details" href="blog-details.html">Read More</a> -->
                                    <h3>How does Mining work with BMP?</h3>
                                    <h4>By Frida </h4>
                                    <p>
                                        You register yourself and create an account. Through this account, you can purchase a mining contract which you will get returns according to the specifications of the contract and the current mining rate. However, you can choose from our five different contracts as to which one you will like. 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="p_35">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="clients-carousel owl-carousel owl-theme">
                            <div class="item">
                                <div class="img-box">
                                    <img src="img/clients/logo-1.png" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-box">
                                    <img src="img/clients/logo-2.png" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-box">
                                    <img src="img/clients/logo-3.png" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-box">
                                    <img src="img/clients/logo-4.png" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-box">
                                    <img src="img/clients/logo-5.png" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-box">
                                    <img src="img/clients/logo-1.png" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-box">
                                    <img src="img/clients/logo-2.png" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-box">
                                    <img src="img/clients/logo-3.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <footer class="footer sec-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="footer-widget about-widget">
                            <a href="#">
                                <img src="img/resources/footer-logo.png" alt="Awesome Image"/>
                            </a>
                            <ul class="contact">
                                <li><i class="fa fa-map-marker"></i> <span>60 Grant Ave. Carteret NJ 0708</span></li>
                                <li><i class="fa fa-phone"></i> <span>(880) 1723801729</span></li>
                                <li><i class="fa fa-envelope-o"></i> <span>support@bitminepool.com</span></li>
                            </ul>
                            <ul class="social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="footer-widget quick-links">
                            <h3 class="title">Site Map</h3>
                            <ul>
                                <li><a href="#home">Home</a></li>
                                <!-- <li><a href="#services">Services</a></li> -->
                                <li><a href="#about-us">About us</a></li>
                                <li><a href="#pricing-table">Pricing table</a></li>
                                <li><a href="#contact-us">Contact us</a></li>
                                <li><a href="#faq">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--<div class="col-md-3 latest-post col-sm-6">
                            <div class="footer-widget latest-post">
                                    <h3 class="title">Latest News</h3>
                                    <ul>
                                            <li>
                                                    <span class="border"></span>
                                                    <div class="content">
                                                            <a href="blog-details.html">If you need a crown or lorem an implant you will pay it </a>
                                                            <span>July 2, 2014</span>
                                                    </div>
                                            </li>
                                            <li>
                                                    <span class="border"></span>
                                                    <div class="content">
                                                            <a href="blog-details.html">If you need a crown or lorem an implant you will pay it </a>
                                                            <span>July 2, 2014</span>
                                                    </div>
                                            </li>
                                            <li>
                                                    <span class="border"></span>
                                                    <div class="content">
                                                            <a href="blog-details.html">If you need a crown or lorem an implant you will pay it </a>
                                                            <span>July 2, 2014</span>
                                                    </div>
                                            </li>
                                    </ul>
                            </div>
                    </div>-->
                    <div class="col-md-4 col-sm-6">
                        <div class="footer-widget contact-widget">
                            <h3 class="title">Contact Form</h3>
                            <p></p>
                            <form id="footer-cf" class="contact-form" action="" novalidate="novalidate">
                                <input type="text" placeholder="Email Address" name="email">
                                <button type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script> -->
        </footer>


        <section class="footer-bottom">
            <div class="container text-center">
                <p>©<?php echo date("Y"); ?> All Rights Reserved. <a href="<?php echo BASE_URL; ?>">Bit Mine Pool</a></p>
            </div>
        </section>

        <!--Scroll to top-->
        <div class="scroll-to-top"><span class="fa fa-arrow-up"></span></div>


        <!-- main jQuery -->
        <script src="js/jquery-2.1.4.js"></script>
        <!-- bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <!-- bx slider -->
        <!--<script src="js/jquery.bxslider.min.js"></script>-->
        <!-- owl carousel -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- validate -->
        <script src="js/jquery-parallax.js"></script>
        <!-- validate -->
        <script src="js/validate.js"></script>
        <!-- mixit up -->
        <script src="js/jquery.mixitup.min.js"></script>
        <!-- fancybox -->
        <script src="js/jquery.fancybox.pack.js"></script>
        <!-- easing -->
        <script src="js/jquery.easing.min.js"></script>
        <!-- circle progress -->
        <script src="js/circle-progress.js"></script>
        <!-- appear js -->
        <script src="js/jquery.appear.js"></script>
        <!-- count to -->
        <script src="js/jquery.countTo.js"></script>

        <!-- isotope script -->
        <script src="js/isotope.pkgd.min.js"></script>
        <!-- jQuery ui js -->
        <script src="js/jquery-ui-1.11.4/jquery-ui.js"></script>


        <!-- Nivo slider js -->     
        <script src="vendor/slider/js/jquery.nivo.slider.js" type="text/javascript"></script>
        <script src="vendor/slider/home.js" type="text/javascript"></script>




        <!-- thm custom script -->
        <script src="js/custom.js"></script>


    </body>
</html>