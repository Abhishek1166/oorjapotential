<?php
echo '<pre>';
print_r($data['content']);
//die();
echo '</pre>';
?>
<!-- end: Page title -->
<!-- Shop products -->
<section>
    <div class="container">
        <div class="row m-b-20">

            <div class="col-lg-3">
                <div class="order-select">

                    <p>Showing 1&ndash;12 of 25 results</p>
                    <form method="get">
                        <select class="form-control">
                            <option value="order" selected="selected">Default sorting</option>
                            <option value="popularity">Sort by popularity</option>
                            <option value="rating">Sort by average rating</option>
                            <option value="date">Sort by newness</option>
                            <option value="price">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="order-select">
                    <h6>Sort by Price</h6>
                    <p>From 0 - 190$</p>
                    <form method="get">
                        <select class="form-control">
                            <option value="" selected="selected">0$ - 50$</option>
                            <option value="">51$ - 90$</option>
                            <option value="">91$ - 120$</option>
                            <option value="">121$ - 200$</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        <!--Product list-->
        <div class="shop">

            <div class="grid-layout grid-3-columns" data-item="grid-item">
                <?php
                if (!empty($data['content'])) {

                    foreach ($data['content'] as $cont) {
                ?>
                        <div class="grid-item">
                            <div class="product">
                                <div class="product-image">
                                    <img src="<?php echo $cont->dp_image; ?>"> <span>
                                        <!-- `<class="product-new">NEW
                                    </span>` -->
                                        <span class="product-wishlist">

                                        </span>
                                        <div class="product-overlay">

                                            <!-- modal change start -->
                                            <div class="container">
                                                <button type="button" class="btn btn-info btn-lg videoModalTrgr" data-yt-url="<?php echo $cont->yt_url; ?>" data-title="<?php echo $cont->title; ?>">Quick View</button>
                                            </div>
                                            <!-- modal change end -->
                                        </div>
                                </div>
                                <div class="product-description">
                                    <div class="product-category"><?= $cont->title ?></div>
                                    <div class="product-title">
                                        <h3><a href="#"><?= $cont->title ?></a></h3>
                                    </div>
                                    <div class="product-price"><ins></ins>
                                    </div>
                                    <div class="product-rate">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <div class="product-reviews"><a href="#">6 customer reviews</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>
            </div>

            <hr>
            <!-- Pagination -->
            <ul class="pagination">
                <!-- <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li> -->
                <?php if ($data['page'] < 2) {
                    $prev_url = '#';
                } else {
                    $prev_url = SITE_URL . 'page/course/' . ($data['page'] - 1);
                }
                ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $prev_url ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>


                <!--  -->

                <?php
                for ($i = 1; $i <= $data['total_page']; $i++) {
                ?>
                    <li class="<?= ($i == $data['page']) ? 'active' : '';  ?>">
                        <a class="page-link" href="<?php echo SITE_URL . 'page/course/' . $i ?>"><?= $i ?></a>
                    </li>
                <?php
                }
                ?>


                <?php if ($data['page'] >= 3) {
                    $next_url = '#';
                } else {
                    $next_url = SITE_URL . 'page/course/' . ($data['page'] + 1);
                }
                ?>

                <li>
                    <a class="page-link" href="<?php echo $next_url ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
        </ul> -->
        <!-- end: Pagination -->


    </div>
    <!--End: Product list-->

    </div>
</section>
<!-- end: Shop products -->
<!-- Modal -->
<div class="modal fade" id="videoPlayerModalDiv" role="dialog">
    <div class="modal-dialog">
        <br><br>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="videoPlayerTitle"></h4>
            </div>
            <div class="modal-body">
                <p><iframe id="videoPlayerIframe" width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Footer -->