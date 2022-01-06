<div class=''>
    <div class="intro">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="categ-head text-center">
                        mobiles
                    </h1>
                </div>
                <div class="col-lg-6">
                    <img class="categ-img" src="././images/home/categ-intro.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="main-category">
        <div class="container">
            <div class="row mb-2">
                <div class="col-lg-3 mb-3 mb-lg-0 px-0">
                    <?php include_once 'views/partial/range.php'; ?>
                    <hr>
                    <div class="prd-accordion" id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0  text-capitalize">
                                    <button class="btn btn-link text-capitalize" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        mobiles
                                    </button>
                                </h5>
                            </div>
                            <?php include_once 'views/partial/sub-accordion.php'; ?>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0 text-capitalize">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Tablets
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    test
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Headphones
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    test
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="color-selector">
                        <h4 class="y-color">
                            deveice color
                        </h4>
                        <label for="red-device" class="color-label ">
                            <input type="radio" id="red-device" checked name="select-color">
                        </label>
                        <label for="red-device" class="color-label ">
                            <input type="radio" id="orange-device" name="select-color">
                        </label>
                        <label for="black-device" class="color-label ">
                            <input type="radio" id="black-device" name="select-color">
                        </label>
                        <label for="blue-device" class="color-label ">
                            <input type="radio" id="blue-device" name="select-color">
                        </label>

                    </div>
                </div>
                <div class="col-lg-9 ">
                    <div class="categ-product">
                        <?php for ($i = 0; $i < 9; $i++) { ?>
                            <div class="item p-2">
                                <?php include 'views/partial/product-card.php'; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="g-pgination co-xl-5 col-lg-6 col-md-7 ml-auto px-0 px-md-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item arrow">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&lt;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item arrow">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&gt;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>