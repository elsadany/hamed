<div class=''>
    <img class="master-img" src="././images/home/master.png" alt="">

    <div class="container pt-4 ">
        <div class="home-product">
            <?php for ($i = 0; $i < 6; $i++) { ?>
                <div class="item p-2">
                    <div class="card-sales">
                        <div class="img-container">
                            <img src="././images/devices/<?= $i + 1 ?>.png" class="card-img-top" alt="">
                        </div>
                        <p class="caption">الاحدث</p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="owl-carousel owl-theme home-slider">
        <?php for ($i = 0; $i < 3; $i++) { ?>
            <div class="item">
                <div class="img-container">
                    <img src="././images/devices/<?= $i + 1 ?>.png" alt="">
                </div>
                <div class="">
                    <p class="text-center  mt-4">
                        Air Conditioners
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>

    <img class="master-img" src="././images/home/master2.png" alt="">

    <div class="slide">
        <div class="container">
            <div class="top-section d-flex justify-content-between align-items-center">
                <h2 class="m-0 text-capitalize">
                    new arrival
                </h2>
                <a href="" class="y-color text-capitalize"> view all
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
            <?php include_once 'views/partial/new-slider.php'; ?>
        </div>
    </div>

    <div class="slide">
        <div class="container">
            <div class="top-section d-flex justify-content-between align-items-center">
                <h2 class="m-0 text-capitalize">
                    top products
                </h2>
                <a href="" class="y-color text-capitalize"> view all
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
            <?php include_once 'views/partial/top-slider.php'; ?>
        </div>
    </div>

    <div class="slide">
        <div class="container">
            <div class="top-section d-flex justify-content-between align-items-center">
                <h2 class="m-0 text-capitalize">
                    mobile offers
                </h2>
                <a href="" class="y-color text-capitalize"> view all
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
            <?php include_once 'views/partial/mob-slider.php'; ?>

        </div>
    </div>
</div>