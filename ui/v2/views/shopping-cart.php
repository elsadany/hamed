<div class="g-padding shoping-cart">
    <div class="container">
        <h1 class="text-center text-capitalize mb-4">
            shoping cart
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
                        <th scope="col">total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=0; $i<5; $i++) {?>
                        <tr>
                        <th class="w-25">
                            <div class="d-flex justify-content-around align-items-center">
                                <span class="remove">
                                    <img src="././images/icons/remove.png" alt="">
                                </span>
                                <img src="././images/devices/top/<?=$i + 1?>.png" alt="" class="product">
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
                            <div class="">
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
                            </div>
                        </td>
                        <td>
                            <p class="total-price text-uppercase">
                                300 le
                            </p>
                        </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- table in small screen -->
        <div class="d-block d-md-none">
             <div class="shoping-table pt-2 mb-4">
             <?php for($i=0; $i<2; $i++) {?>
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th scope="col">image</th>
                            <th class="w-75">
                                <div class="d-flex justify-content-around align-items-center">
                                    <span class="remove">
                                        <img src="././images/icons/remove.png" alt="">
                                    </span>
                                    <img src="././images/devices/top/<?=$i+1?>.png" alt="" class="product">
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
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="col">total</td>
                            <td class="w-75">
                                <p class="total-price text-uppercase">
                                    300 le
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
             <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 ">
                <div class="rounded subtotal  p-4 mb-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class=" text-capitalize">
                                subtotal :
                            </p>
                            <p class=" text-uppercase">
                                3000 le
                            </p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class=" text-capitalize">
                                delivery charges : 
                            </p>
                            <p class=" text-uppercase">
                                300 le
                            </p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="total-price text-capitalize">
                                total price :
                            </p>
                            <p class="total-sum y-color  text-uppercase">
                                3300 le
                            </p>
                        </div>
                </div>
            </div>
            <div class="col-lg-8 col-lg-6">
                <div class="actio h-100 d-flex align-items-end justify-content-md-end">
                        <a class="y-btn text-capitalize text-white mx-2">checkout</a>
                        <a class="reverse-y-btn text-capitalize mx-2">continue shoping</a>
                </div>
            </div>
        </div>
    </div>
</div>
