<div class="">
    <div class="container">
        <div class="g-crumb ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item pr-2"><a href="#">Home</a></li>
                    <li class="breadcrumb-item  pr-2" aria-current="page">Library</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="intro bg-white pt-4">
        <div class="container">
            <div class="row ">
                <div class="col-lg-7" style=" margin-bottom: 30">
                    <div class="product-details-tab">
                        <div class="product-dec-right pro-dec-big-img-slider">
                            <div class="easyzoom-style easyzoom-img easyzoom-img">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="images/home/categ-intro.png">
                                        <img class="master-product-img" src="images/home/categ-intro.png" alt="" />
                                    </a>
                                </div>
                                <a class="easyzoom-pop-up img-popup" href="images/home/categ-intro.png">
                                    <i class="fas fa-search-plus"></i>
                                </a>
                            </div>
                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                <div class="easyzoom-style easyzoom-img">
                                    <div class="easyzoom easyzoom--overlay">
                                        <a href="images/home/categ-intro.png">
                                            <img class="master-product-img" src="images/home/categ-intro.png" alt="" />
                                        </a>
                                    </div>
                                    <a class="easyzoom-pop-up img-popup" href="images/home/categ-intro.png">
                                        <i class="fas fa-search-plus"></i>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="product-dec-slider product-dec-left">
                            <?php for ($i = 0; $i < 6; $i++) { ?>
                                <div class="product-dec-small">
                                    <img src="images/home/categ-intro.png" alt="" />
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h3 class="prd-name ">
                        LG Top Loading Digital WashIng Machine, 13.2KG, Silver
                        T1388NEHTE With A Gift LG Case
                    </h3>
                    <p class="price text-uppercase">
                        3000 le
                    </p>
                    <table class="table">
                        <thead>
                            <tr>
                                <td colspan="2">
                                    <h4 class="table-heading">
                                        Description
                                    </h4>
                                    <p>Inspired by the continuous length of the lunghi or sarong seen in hot climates everywhere from South Asia to the Horn of Africa and southern Arabian pen… </p>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h4 class="table-heading">
                                        year
                                    </h4>
                                </td>
                                <td>
                                    <p>
                                        2020
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="table-heading">
                                        country
                                    </h4>
                                </td>
                                <td>
                                    <p>
                                        china
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="table-heading">
                                        memory (Ram)
                                    </h4>
                                </td>
                                <td>
                                    <p>
                                        16
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="">
                        <small class="text-capitalize d-block">Quantity</small>

                        <div class="g-pgination px-0 pt-2  d-inline-block mr-3">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item arrow mx-0">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">+</span>
                                        </a>
                                    </li>
                                    <li class="page-item mx-0">
                                        <a class="page-link text-small " href="#">1</a>
                                    </li>
                                    <li class="page-item arrow mx-0">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">-</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <a href="" class="y-btn rounded-0">add to card</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="related-product">
        <div class="container">
            <h2 class="text-capitalize mb-4">
                Related Products
            </h2>
            <div class="re-product">
                <?php for ($i = 0; $i < 9; $i++) { ?>
                    <div class="content p-1">
                        <?php include 'views/partial/product-card.php'; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>