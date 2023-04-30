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

get_header();



?>

    <!-- blog -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h1>Blog</h1>
          </div>
          <div class="col-md-6 text-md-right">
            <div class="nav nav-tabs lavalamp">
              <a class="nav-item nav-link active" data-filter="all">All articles</a>
              <a class="nav-item nav-link" data-filter="1">Fashion</a>
              <a class="nav-item nav-link" data-filter="2">Culture</a>
              <a class="nav-item nav-link" data-filter="3">News</a>
            </div>
          </div>
        </div>


        <!-- posts -->
        <div class="row gutter-2 filtr-blog imagesloaded">
          <div class="col-12 filtr-item" data-category="1" data-sort="value">
            <div class="card card-tile">
              <figure class="card-image equal vh-75">
                <span class="image" style="background-image: url(https://demo.htmlhunters.com/shopy/assets/images/demo/image-2.jpg)"></span>
              </figure>
              <div class="card-footer p-lg-5 text-white">
                <ul class="list list--horizontal list--separated text-uppercase fs-14 mb-1">
                  <li><a href="" class="underline">News</a></li>
                  <li><time datetime="2019-08-24 20:00" class="text-muted">24th Aug, 2019</time></li>
                </ul>
                <h2 class="card-title text-uppercase mb-2">Summer 2019 Release</h2>
                <a href="" class="btn btn-outline-white">Read More</a>
              </div>
            </div>
          </div>

          <div class="col-md-6 filtr-item" data-category="2,3" data-sort="value">
            <div class="card card-post">
              <a href="" class="card-img-top">
                <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/image-1.jpg" alt="Image">
              </a>
              <div class="card-body">
                <ul class="list list--horizontal list--separated text-uppercase fs-14">
                  <li><a href="" class="underline">News</a></li>
                  <li><time datetime="2019-08-24 20:00" class="text-muted">24th Aug, 2019</time></li>
                </ul>
                <h2 class="card-title fs-20"><a href="">Get ready for tennis</a></h2>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 filtr-item" data-category="1,2" data-sort="value">
            <div class="card card-post">
              <a href="" class="card-img-top">
                <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/image-3.jpg" alt="Image">
              </a>
              <div class="card-body">
                <ul class="list list--horizontal list--separated text-uppercase fs-14">
                  <li><a href="" class="underline">News</a></li>
                  <li><time datetime="2019-08-24 20:00" class="text-muted">24th Aug, 2019</time></li>
                </ul>
                <h2 class="card-title fs-20"><a href="">New summer look is here</a></h2>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- pagination -->
        <div class="row">
          <div class="col">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#!">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                <li class="page-item"><a class="page-link" href="#!">Next</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </section>



<?php
get_footer();
