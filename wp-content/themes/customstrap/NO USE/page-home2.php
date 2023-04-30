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



    <!-- categories -->
    <section class="py-0">
      <div class="container-full">
        <div class="row gutter-0">
          <div class="col-md-6">
            <div class="card card-tile">
              <figure class="card-image equal vh-50 vh-md-100">
                <span class="image image--scroll" style="background-image: url(https://demo.htmlhunters.com/shopy/assets/images/demo/index2-slide-2.jpg)"
                  data--100-bottom-top="transform: translateY(0%);"
                  data-top-bottom="transform: translateY(25%);"></span>
              </figure>
              <div class="card-footer text-white p-lg-5">
                <div class="row gutter-1">
                  <div class="col-md-8">
                    <h2>Cotton Cardigans</h2>
                  </div>
                  <div class="col-md-4 text-md-right">
                    <a href="" class="btn btn-outline-white">Shop Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-tile">
              <figure class="card-image equal vh-50 vh-md-100">
                <span class="image image--scroll" style="background-image: url(https://demo.htmlhunters.com/shopy/assets/images/demo/index2-slide-1.jpg)"
                  data--100-bottom-top="transform: translateY(0%);"
                  data-top-bottom="transform: translateY(25%);"></span>
              </figure>
              <div class="card-footer text-white p-lg-5">
                <div class="row gutter-1">
                  <div class="col-md-8">
                    <h2>Fancy Jewelery</h2>
                  </div>
                  <div class="col-md-4 text-md-right">
                    <a href="" class="btn btn-outline-white">Shop Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- categories -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <span class="eyebrow text-muted">Shop New Look</span>
            <h2>Black Casual Look</h2>
          </div>
        </div>
        <div class="row gutter-1">
          <div class="col-lg-6">
            <figure class="equal">
              <span class="image" style="background-image: url(https://demo.htmlhunters.com/shopy/assets/images/demo/image-5.jpg)"></span>
            </figure>
          </div>

          <div class="col-6 col-lg-3">
            <div class="card card-product mb-1">
              <figure class="card-image equal">
                <a href="#!" class="image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-1.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-1-2.jpg" alt="Image">
                </a>
              </figure>
              <a href="" class="card-body">
                <h3 class="card-title">Black Blazzer</h3>
                <span class="price">$98.00</span>
              </a>
            </div>
            <div class="card card-product">
              <figure class="card-image equal">
                <a href="#!" class="image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-3.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-3-1.jpg" alt="Image">
                </a>
              </figure>
              <a href="" class="card-body">
                <h3 class="card-title">Gold Earrings</h3>
                <span class="price">$260.00</span>
              </a>
            </div>
          </div>

          <div class="col-6 col-lg-3">
            <div class="card card-product mb-1">
              <figure class="card-image equal">
                <a href="#!" class="image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-2.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-2-1.jpg" alt="Image">
                </a>
              </figure>
              <a href="" class="card-body">
                <h3 class="card-title">Black T-Shirt</h3>
                <span class="price">$24.00</span>
              </a>
            </div>
            <div class="card card-product">
              <figure class="card-image equal">
                <a href="#!" class="image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-4.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-4-1.jpg" alt="Image">
                </a>
              </figure>
              <a href="" class="card-body">
                <h3 class="card-title">Sunglass</h3>
                <span class="price">$18.00</span>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col text-center">
            <a href="" class="underlined">View more looks</a>
          </div>
        </div>
      </div>
    </section>


    <!---->
    <!-- cta -->
    <section class="py-0 no-overflow position-relative">
      <div class="image image-scroll" style="background-image:url(https://demo.htmlhunters.com/shopy/assets/images/demo/background-3.jpg)"
      data--100-bottom-top="transform: translateY(0%);"
      data-top-bottom="transform: translateY(25%);"></div>
      <div class="container">
        <div class="row gutter-2 gutter-md-4 justify-content-between vh-75 py-10">
          <div class="col-md-6 align-self-end">
            <div class="bg-white w-50 w-lg-40 d-inline-block p-3">
              <h2 class="fs-24"><span class="d-block text-gray">Gold Jewlery</span>Earrings & Rings</h2>
              <a href="" class="underlined">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- look -->
    <section>
      <div class="container">
        <div class="row align-items-end">
          <div class="col-md-6">
            <span class="eyebrow text-muted">Shop the look</span>
            <h2>Trending Looks</h2>
          </div>
          <div class="col-md-6 text-right">
            <a href="" class="underlined">View More</a>
          </div>
        </div>
        <div class="row gutter-1">
          <div class="col-lg-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-5.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-5-1.jpg" alt="Image">
                </a>
              </figure>
              <a href="" class="card-body">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="card-title font-weight-bold">Look name</h3>
                    <small class="text-muted">3 items</small>
                  </div>
                  <div class="col-4 text-right">
                    <span class="price">$120.00</span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-6.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/look-6-1.jpg" alt="Image">
                </a>
              </figure>
              <a href="" class="card-body">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="card-title font-weight-bold">Brand name</h3>
                    <small class="text-muted">2 items</small>
                  </div>
                  <div class="col-4 text-right">
                    <span class="price">$90.00</span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-3.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-3-3.jpg" alt="Image">
                </a>
              </figure>
              <a href="" class="card-body">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="card-title font-weight-bold">Look name</h3>
                    <small class="text-muted">2 items</small>
                  </div>
                  <div class="col-4 text-right">
                    <span class="price">$110.00</span>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>




<?php
get_footer();
