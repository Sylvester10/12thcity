<!--==============================
Breadcrumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url(); ?>assets/website/img/bg/breadcumb-bg.jpg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title">Gallery</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!--==============================
Gallery Area
==============================-->
<section class="space-top space-extra-bottom">
    <div class="container">

        <div class="tab-content">
            <div class="tab-pane fade active show" id="tablist" role="tabpanel" aria-labelledby="tab-shop-list">
                <div class="row gy-40">

                    <?php
                    $count = 1;
                    foreach ($images as $y) { ?>

                        <div class="col-md-6 col-xl-3">
                            <div class="property-card2" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="<?php echo base_url('assets/uploads/gallery/' . $y->image); ?>">
                                <div class="property-card-thumb img-shine">
                                    <img src="<?php echo base_url('assets/uploads/gallery/' . $y->image); ?>" alt="12thcity" />
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>

        </div>

        <div class="mt-60 text-center">
            <div class="th-pagination">
                <?php echo $links; ?>
            </div>
        </div>
    </div>
</section>

<!--==============================
    Popup Modal v1
============================== -->
<div class="th-modal modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="container">
                <button type="button" class="icon-btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-xmark"></i></button>
                <div class="page-single bg-theme">
                    <div class="page-img mb-30">
                        <img class="w-100 rounded-20" src="" alt="12thcity" id="modalImage">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>