<section class="fullscreen" style="background-image: url(images/pages/1.jpg)">
    <div class="container container-fullscreen">
        <div class="text-middle">
            <div class="text-center m-b-30">
                <a href="index.html" class="logo">
                    <img src="<?= $site['site_logo'] ?>" alt="Polo Logo">
                </a>
            </div>
            <div class="row">
                <div class="col-lg-6 center p-40 background-white b-r-6">
                    <form class="form-transparent-grey">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Register New Account</h3>
                                <p>Create an account by entering the information below. If you are a returning customer please login
                                    at the top of the page.</p>
                            </div>
                            <form action="" method="post">
                                <div class="col-lg-6 form-group">
                                    <label class="sr-only">First Name</label>
                                    <input type="text" value="" placeholder="First Name" class="form-control" name="firstname">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="sr-only">Last Name</label>
                                    <input type="text" value="" placeholder="Last Name" class="form-control" name="lastname">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="sr-only">Username</label>
                                    <input type="text" value="" placeholder="Username" class="form-control" name="username">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="sr-only">Password</label>
                                    <input type="password" value="" placeholder="password" class="form-control" name="password">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="sr-only">Address</label>
                                    <input type="text" value="" placeholder="Address" class="form-control" name="address">
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label class="sr-only">Email</label>
                                    <input type="email" value="" placeholder="Email" class="form-control" name="email">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="sr-only">Phone</label>
                                    <input type="tel" value="" placeholder="Phone" class="form-control" name="phone">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <button name="submit" value="submit" class="btn">Create account</button>
                                    <button type="button" class="btn btn-danger m-l-10">Cancel</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>