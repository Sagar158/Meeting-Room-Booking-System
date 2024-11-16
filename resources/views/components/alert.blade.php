@if (session('success'))
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif


@if (session('error'))
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif


