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

$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post_status' => 'publish',
);
$products = get_posts( $args );
$count_all_product = count($products);

?>



    <!-- breadcrumbs -->
    <section class="breadcrumbs bg-light">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#!">Home</a></li>
                <li class="breadcrumb-item"><a href="#!">Women</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dresses</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <!-- listing -->
    <section class="pt-6">
      <div class="container">

        <!-- sort -->
        <div class="row gutter-1 align-items-end">
          <div class="col-md-6">
            <p class="h1">Shop</p>
          </div>
          <div class="col-md-6 text-md-right">
            <ul class="list list--horizontal list--separated text-muted fs-14">
              <li>
                <span class="text-primary">15 from <?php echo $count_all_product; ?> items</span>
              </li>
              <li>
                  <span>Sort by
                  <span class="dropdown">
                    <a class="dropdown-toggle underline" href="#!" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Most popular
                    </a>

                    <span class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="#!">Action</a>
                      <a class="dropdown-item" href="#!">Another action</a>
                      <a class="dropdown-item" href="#!">Something else here</a>
                    </span>
                  </span>
                </span>
              </li>
            </ul>
          </div>
        </div>

        <!-- filters -->
        <div class="row filter">
          <div class="col-md-6 col-lg">
            <div class="dropdown">
              <button class="btn btn-filter btn-block dropdown-toggle" type="button" id="dropdown-filter-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Style
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdown-filter-1">
                <form>
                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck1">
                      <label class="custom-control-label" for="customCheck1">Coats & Jackets</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck2">
                      <label class="custom-control-label" for="customCheck2">Dresses</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck3">
                      <label class="custom-control-label" for="customCheck3">Polo Shirts</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck4">
                      <label class="custom-control-label" for="customCheck4">Sweatshirts</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck5">
                      <label class="custom-control-label" for="customCheck5">T-Shirts & Tops</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck6">
                      <label class="custom-control-label" for="customCheck6">Knitwear</label>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg">
            <div class="dropdown">
              <button class="btn btn-filter btn-block dropdown-toggle" type="button" id="dropdown-filter-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Size
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdown-filter-2">
                <form>
                  <div class="btn-group-toggle btn-group-square" data-toggle="buttons">
                    <label class="btn active">
                      <input type="checkbox" name="options" id="option-1" checked> 35
                    </label>
                    <label class="btn">
                      <input type="checkbox" name="options" id="option-2"> 35.5
                    </label>
                    <label class="btn">
                      <input type="checkbox" name="options" id="option-3"> 36
                    </label>
                    <label class="btn">
                      <input type="checkbox" name="options" id="option-4"> 36.5
                    </label>
                    <label class="btn">
                      <input type="checkbox" name="options" id="option-5"> 37
                    </label>
                    <label class="btn">
                      <input type="checkbox" name="options" id="option-6"> 38
                    </label>
                    <label class="btn">
                      <input type="checkbox" name="options" id="option-7"> 38.5
                    </label>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg">
            <div class="dropdown">
              <button class="btn btn-filter btn-block dropdown-toggle" type="button" id="dropdown-filter-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Color
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdown-filter-3">
                <form>
                  <div class="btn-group-toggle btn-group-square btn-group-colors" data-toggle="buttons">
                    <label class="btn active text-red">
                      <input type="checkbox" name="color-select" id="option-2-1" checked>
                    </label>
                    <label class="btn text-blue">
                      <input type="checkbox" name="color-select" id="option-2-2">
                    </label>
                    <label class="btn text-yellow">
                      <input type="checkbox" name="color-select" id="option-2-3">
                    </label>
                    <label class="btn text-green">
                      <input type="checkbox" name="color-select" id="option-2-4">
                    </label>
                    <label class="btn text-white">
                      <input type="checkbox" name="color-select" id="option-2-5">
                    </label>
                    <label class="btn text-dark">
                      <input type="checkbox" name="color-select" id="option-2-6">
                    </label>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg">
            <div class="dropdown">
              <button class="btn btn-filter btn-block dropdown-toggle" type="button" id="dropdown-filter-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Price Range
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdown-filter-4">
                <form>
                  <input type="text" class="rangeslider" name="Range Slider" value="" />
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- products -->
        <div class="row gutter-1">


          <div class="col-6 col-md-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!" class="action"><i class="icon-heart"></i></a>
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-1.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-1-1.jpg" alt="Image">
                </a>
                <span class="badge badge-success">New</span>
              </figure>
              <div class="card-footer">
                <h3 class="card-title"><a href="">Highwaist Jeans</a></h3>
                <span class="brand">Armani</span>
                <span class="price">$410</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!" class="action"><i class="icon-heart"></i></a>
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-2.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-2-1.jpg" alt="Image">
                </a>
                <span class="badge badge-success">New</span>
              </figure>
              <div class="card-footer">
                <h3 class="card-title"><a href="">Highwaist Jeans</a></h3>
                <span class="price">$410</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!" class="action"><i class="icon-heart"></i></a>
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-3.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-3-1.jpg" alt="Image">
                </a>
                <span class="badge badge-success">New</span>
              </figure>
              <div class="card-footer">
                <h3 class="card-title"><a href="">Highwaist Jeans</a></h3>
                <span class="price text-red"><s>$500</s> $410</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!" class="action"><i class="icon-heart"></i></a>
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-4.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-4-1.jpg" alt="Image">
                </a>
                <span class="badge badge-success">New</span>
              </figure>
              <div class="card-footer">
                <h3 class="card-title"><a href="">Highwaist Jeans</a></h3>
                <span class="brand">Armani</span>
                <span class="price">$410</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!" class="action"><i class="icon-heart"></i></a>
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-5.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-5-1.jpg" alt="Image">
                </a>
                <span class="badge badge-success">New</span>
              </figure>
              <div class="card-footer">
                <h3 class="card-title"><a href="">Highwaist Jeans</a></h3>
                <span class="brand">Armani</span>
                <span class="price">$410</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="card card-product">
              <figure class="card-image">
                <a href="#!" class="action"><i class="icon-heart"></i></a>
                <a href="#!">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-6.jpg" alt="Image">
                  <img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-listing-6-1.jpg" alt="Image">
                </a>
                <span class="badge badge-success">New</span>
              </figure>
              <div class="card-footer">
                <h3 class="card-title"><a href="">Highwaist Jeans</a></h3>
                <span class="brand">Armani</span>
                <span class="price">$410</span>
              </div>
            </div>
          </div>

        </div>

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
