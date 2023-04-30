<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$args = array(
    'header_class' => 'header-absolute',
);

get_header('', $args );



?>


    <!-- hero -->
    <section class="py-0 no-overflow vh-100">
      <div class="image image-scroll" style="background-image:url(https://demo.htmlhunters.com/shopy/assets/images/demo/background-1.jpg)"
      data--100-bottom-top="transform: translateY(0%);"
      data-top-bottom="transform: translateY(25%);"></div>
      <div class="container">
        <div class="row justify-content-center vh-100">
          <div class="col-md-8 col-lg-4 align-self-center">
            <div class="card card-tile">
              <div class="equal bg-red text-white">
                <div class="card-body text-center">
                  <h1 class="display-1 text-uppercase mb-3">Sale up <br>to 50%</h1>
                  <p class="text-muted mb-3">Use code: <span class="text-white">SALE50</span></p>
                  <ul class="list list--horizontal">
                    <li class="mr-2"><a href="" class="underlined">Women</a></li>
                    <li class="mr-2"><a href="" class="underlined">Men</a></li>
                    <li><a href="" class="underlined">Kids</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- tabs -->
    <section>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-4 text-center">
            <ul class="nav nav-tabs nav-fill lavalamp" id="component-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#component-1-1" role="tab" aria-controls="component-1-1" aria-selected="true">Women</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#component-1-2" role="tab" aria-controls="component-1-2" aria-selected="false">Men</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#component-1-3" role="tab" aria-controls="component-1-3" aria-selected="false">Kids</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="tab-content" id="component-1-content">
              <div class="tab-pane fade show active" id="component-1-1" role="tabpanel" aria-labelledby="component-1-1">
                <div class="row gutter-1">
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-1.jpg" alt="Image">
                        <figcaption>Blouses</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-2.jpg" alt="Image">
                        <figcaption>Swimwear</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-3.jpg" alt="Image">
                        <figcaption>Skirts</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-4.jpg" alt="Image">
                        <figcaption>Accessories</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-5.jpg" alt="Image">
                        <figcaption>Dresses</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-6.jpg" alt="Image">
                        <figcaption>Shoes</figcaption>
                      </figure>
                    </a>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="component-1-2" role="tabpanel" aria-labelledby="component-1-2">
                <div class="row gutter-1">
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-1.jpg" alt="Image">
                        <figcaption>Outwear</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-2.jpg" alt="Image">
                        <figcaption>Sweaters</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-3.jpg" alt="Image">
                        <figcaption>Skirts</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-4.jpg" alt="Image">
                        <figcaption>Denim</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-5.jpg" alt="Image">
                        <figcaption>Shoes</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-6.jpg" alt="Image">
                        <figcaption>Accesories</figcaption>
                      </figure>
                    </a>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="component-1-3" role="tabpanel" aria-labelledby="component-1-3">
                <div class="row gutter-1">
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-1.jpg" alt="Image">
                        <figcaption>Outwear</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-2.jpg" alt="Image">
                        <figcaption>Sweaters</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-3.jpg" alt="Image">
                        <figcaption>Skirts</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-4.jpg" alt="Image">
                        <figcaption>Denim</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-5.jpg" alt="Image">
                        <figcaption>Shoes</figcaption>
                      </figure>
                    </a>
                  </div>
                  <div class="col-6 col-md-4 col-lg-2">
                    <a href="">
                      <figure class="category">
                        <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-6.jpg" alt="Image">
                        <figcaption>Accesories</figcaption>
                      </figure>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col text-center">
            <a href="" class="underlined">Discover more</a>
          </div>
        </div>
      </div>
    </section>

    <!-- categories -->
    <section class="py-1">
      <div class="container-full">
        <div class="row gutter-1">
          <div class="col-md-6">
            <div class="card card-tile">
              <figure class="card-image equal vh-75">
                <span class="image image-scroll" style="background-image: url(https://demo.htmlhunters.com/shopy/assets/images/demo/image-3.jpg)"
                  data--100-bottom-top="transform: translateY(0%);"
                  data-top-bottom="transform: translateY(25%);"></span>
              </figure>
              <div class="card-footer p-lg-5">
                <div class="bg-white d-inline-block p-3">
                  <h2 class="card-title"><span class="d-block text-gray">Bold & Modern</span> Summer Looks</h2>
                  <a href="" class="underlined">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-tile">
              <figure class="card-image equal vh-75">
                <span class="image image-scroll" style="background-image: url(https://demo.htmlhunters.com/shopy/assets/images/demo/image-1.jpg)"
                  data--100-bottom-top="transform: translateY(0%);"
                  data-top-bottom="transform: translateY(25%);"></span>
              </figure>
              <div class="card-footer p-lg-5">
                <div class="bg-white d-inline-block p-3">
                  <h2 class="card-title"><span class="d-block text-gray">Feel the summer</span> Tennis Look</h2>
                  <a href="" class="underlined">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- trending -->
    <section class="pb-0">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-sm-8 col-md-6">
            <span class="eyebrow text-muted">Shop by category</span>
            <h2>Trending Items</h2>
          </div>
          <div class="col-sm-4 col-md-6 text-sm-right">
            <a href="" class="underlined">View More</a>
          </div>
        </div>
        <div class="row gutter-1">
          <div class="col-md-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!" class="action"><i class="icon-heart"></i></a>
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-1.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-1-2.jpg" alt="Image">
                </a>
                <span class="badge badge-success">New</span>
              </figure>
              <div class="card-footer">
                <h3 class="card-title"><a href="">Blouse</a></h3>
                <span class="brand">Ralph Lauren</span>
                <span class="price">$19.00</span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!" class="action"><i class="icon-heart"></i></a>
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-6.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-6-1.jpg" alt="Image">
                </a>
                <span class="badge badge-success">New</span>
              </figure>
              <div class="card-footer">
                <h3 class="card-title"><a href="">Shoes</a></h3>
                <span class="brand">Esprit</span>
                <span class="price">$69.00</span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!" class="action"><i class="icon-heart"></i></a>
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-3.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-3-2.jpg" alt="Image">
                </a>
                <span class="badge badge-success">New</span>
              </figure>
              <div class="card-footer">
                <h3 class="card-title"><a href="">Yellow Skirt</a></h3>
                <span class="brand">Zara</span>
                <span class="price">$29.00</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- logo -->
    <section class="no-overflow">
      <div class="container">
        <div class="row gutter-1 align-items-end">
          <div class="col-sm-8 col-md-6">
            <span class="eyebrow text-muted">Shop by brand</span>
            <h2>Trending Brands</h2>
          </div>
          <div class="col-sm-4 col-md-6 text-sm-right">
            <a href="" class="underlined">View More</a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="partners">
              <div class="owl-carousel visible" data-items="[6,4,4,2]" data-nav="true" data-margin="10">
                <a href=""><img src="https://demo.htmlhunters.com/shopy/assets/images/demo/logo/logo-1.png" alt="Logo"></a>
                <a href=""><img src="https://demo.htmlhunters.com/shopy/assets/images/demo/logo/logo-2.png" alt="Logo"></a>
                <a href=""><img src="https://demo.htmlhunters.com/shopy/assets/images/demo/logo/logo-3.png" alt="Logo"></a>
                <a href=""><img src="https://demo.htmlhunters.com/shopy/assets/images/demo/logo/logo-4.png" alt="Logo"></a>
                <a href=""><img src="https://demo.htmlhunters.com/shopy/assets/images/demo/logo/logo-5.png" alt="Logo"></a>
                <a href=""><img src="https://demo.htmlhunters.com/shopy/assets/images/demo/logo/logo-6.png" alt="Logo"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>





<?php
get_footer();
