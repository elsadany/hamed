<div class="g-padding order-summary">
    <div class="container">
        <h1 class="text-center text-capitalize mb-lg-4">
            order summary
        </h1>
        <!-- table in medium and large screen -->
        <div class="d-none d-md-block">
            <div class="shoping-table pt-2 mb-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">image</th>
                            <th scope="col">product</th>
                            <th scope="col">price</th>
                            <th scope="col">quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                            <tr>
                                <th class="w-25">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="././images/devices/top/<?= $i + 1 ?>.png" alt="" class="product">
                                    </div>
                                </th>
                                <td class="w-25">
                                    <p class="description text-capitalize">
                                        LG Top Loading Digital Wash
                                        Ing Machine, 13.2KG, Silver -
                                    </p>
                                </td>
                                <td>
                                    <p class="price text-uppercase">
                                        300 le
                                    </p>
                                </td>
                                <td>
                                    <p class="p-2 fi-quntity">
                                        55</p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- table in small screen -->
        <div class="d-block d-md-none">
            <div class="shoping-table pt-2 mb-4">
                <?php for ($i = 0; $i < 2; $i++) { ?>
                    <table class="table table-striped border">
                        <thead>
                            <tr>
                                <th scope="col">image</th>
                                <th class="w-75">
                                    <div class="d-flex justify-content-around align-items-center">
                                        <img src="././images/devices/top/<?= $i + 1 ?>.png" alt="" class="product">
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="col">product</td>
                                <td class="w-75">
                                    <p class="description text-capitalize">
                                        LG Top Loading Digital Wash
                                        Ing Machine, 13.2KG, Silver -
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td scope="col">price</td>
                                <td class="w-75">
                                    <p class="price text-uppercase">
                                        300 le
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td scope="col">quantity</td>
                                <td class="w-75">
                                    <div class="">
                                        <p class="p-2 fi-quntity">
                                            55</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
        <div class="address">
            <h4 class="y-color text-capitalize">
                address
            </h4>
            <p class="location">
                home
                <span class="d-block">
                    Cairo,Nasr city, 12 makram ebied,alamal tours...
                </span>
            </p>
            <hr>
            <p>Select payment method</p>
            <form action="" class="pay-method-wraper">
                <label for="pay-method-01" class="d-block text-capitalize mb-3 pay-method">
                    <input type="radio" id="pay-method-01" name="pay-method" class="mr-3" checked>
                    <img src="././images/icons/cash.png" alt="">
                    cash
                </label>
                <label for="pay-method-02" class="d-block text-capitalize pay-method">
                    <input type="radio" id="pay-method-02" name="pay-method" class="mr-3">
                    <img src="././images/icons/visa.png" alt="">
                    visa
                </label>
            </form>
            <hr>
            <div class="row">
                <div class="col-6 col-md-3 text-capitalize mb-3">
                    subtotal :
                </div>
                <div class="col-6 col-md-9 text-uppercase mb-3">3000 le</div>
                <div class="col-6 col-md-3 text-capitalize mb-3">
                    delivery coast :
                </div>
                <div class="col-6 col-md-9 text-uppercase mb-3">3000 le</div>
            </div>
            <div class="total">
                <p class="text-uppercase">
                    total:
                    <span class="y-color ">600 le</span>
                </p>
                <a href="" class="y-btn w-25 text-capitalize text-center">
                    pay
                </a>
            </div>
        </div>
    </div>
</div>