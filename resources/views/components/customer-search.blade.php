<section class="mb-2">
    <div class="customer-search-form">
        <h1 class="text-center text-success fw-900 mb-3">Customer Search / <span class="text-urdu-kasheeda">خریدار تلاش کریں</span></h1>
        <form action="" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
                <div class="col-md-1 text-center pt-1 fw-700 mb-3" style="font-size: large;">
                    OR
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" name="phone_number" id="phone-number" class="form-control" data-mask="0000 0000000" placeholder="Phone Number">
                </div>
                <div class="col-md-1 text-center pt-1 fw-700 mb-3" style="font-size: large;">
                    OR
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" name="cnic" id="cnic" class="form-control" placeholder="CNIC" data-mask="00000-0000000-0">
                </div>
                <div class="col-md-1 mb-3">
                    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</section>
