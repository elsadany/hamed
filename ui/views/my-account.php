<div class="g-padding my-account">
  <div class="container">
    <h1 class="text-center text-capitalize mb-4">
      my account
    </h1>
    <div class="g-padding grey-bg  pt-4 pb-0 rounded">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
            <i class="tab-fa far fa-user mr-3" style="color: #dc9d3c"></i>edit profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
            <i class="tab-fa fas fa-map-marker-alt mr-3" style="color: #dc9d3c"></i>
            saved address</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
            <i class="tab-fa far fa-file-alt mr-3" style="color: #dc9d3c"></i>
            my orders</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="row">
            <div class=" col-lg-10 col-xl-9 mx-auto">
              <form class="white-form text-right p-4 mb-4">
                <div class="form-group">
                  <input type="text" class="form-control text-dark" value="mohamed">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control text-dark" placeholder="first name" value="mohamed">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control text-dark" value="01201201201">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control text-dark" value="test@gmail.com">
                </div>
                <button type="submit" class=" btn y-btn  w-25">save</button>
              </form>
            </div>
          </div>
          <div class="text-center bg-white py-4">
            <a href="" class="btn reverse-y-btn text-decoration-none w-25">
              Log out
            </a>
          </div>
        </div>
        <div class="tab-pane fade p-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="row">
            <div class=" col-lg-10 col-xl-9 mx-auto">
              <form class="white-form text-right">
                <div class="form-group">
                  <select class="form-control" id="exampleFormControlSelect1">
                    <option selected>my home</option>
                    <option>2</option>
                    <option>3</option>
                  </select>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <select class="form-control" id="exampleFormControlSelect1">
                        <option selected>cairo</option>
                        <option>2</option>
                        <option>3</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select class="form-control" id="exampleFormControlSelect1">
                        <option selected disabled>nasr city</option>
                        <option>2</option>
                        <option>3</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group ">
                  <input type="text" class="form-control" value="Alusalam building">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" value="15">
                </div>
                <div class="form-group">
                  <textarea name=""></textarea>
                </div>
                <button type="submit" class="w-25 btn del-btn mr-4">
                  <i class="fas fa-times pr-3 "></i> delete
                </button>
                <button type="submit" class="w-25 btn y-btn ">save</button>
              </form>
            </div>
          </div>
        </div>
        <div class="tab-pane fade p-4" id="contact" role="tabpanel" aria-labelledby="contact-tab">
          <div class="">
            <!-- table in medium and large screen -->
            <div class="d-none d-md-block">
              <div class="shoping-table pt-2 mb-4">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">order</th>
                      <th scope="col">date</th>
                      <th scope="col">order total</th>
                      <th scope="col">status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <tr>
                        <td class="w-25">
                          <p class="  text-capitalize">
                            123
                          </p>
                        </td>
                        <td>
                          <p class="date text-uppercase">
                            13-01-2020
                          </p>
                        </td>
                        <td>
                          <p class="order-total text-uppercase">
                            30000 le
                          </p>
                        </td>
                        <td>
                          <!-- in case of Processing just add st-Processing class -->
                          <p class="st-complete text-uppercase">
                            300 le
                          </p>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- table in small screen -->
          <div class="d-block d-md-none">
            <div class="shoping-table pt-2 mb-4">
              <?php for ($i = 0; $i < 2; $i++) { ?>
                <table class="table table-striped border">
                  <thead>
                    <tr>
                      <th scope="col">order</th>
                      <th class="w-75">
                        <p class=" text-capitalize">
                          123
                        </p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td scope="col">date</td>
                      <td class="w-75">
                        <p class="date text-uppercase">
                          13-01-2020
                        </p>
                      </td>
                      </td>
                    </tr>
                    <tr>
                      <td scope="col">order total</td>
                      <td class="w-75">
                        <p class="order-total text-uppercase">
                          30000 le
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td scope="col">status</td>
                      <td class="w-75">
                        <!-- in case of Processing just add st-Processing class -->
                        <p class="st-complete text-uppercase">
                          300 le
                        </p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>