@extends("layout.masterAdminKeuangan")

@section("content")
    
    @if(\Session::has("alert-success"))
          <div class="alert alert-success">
              <div>{{Session::get("alert-success")}}</div>
          </div>
      @endif
    <div class="income-order-visit-user-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="income-dashone-total income-monthly shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Admin Keuangan</h2>
                                <div class="main-income-phara">
                                </div>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3><span class="counter">{{$count}}</span></h3>
                                </div>
                                <div class="price-graph">
                                    <span id="sparkline1"></span>
                                </div>
                            </div>
                            <div class="income-range">
                                
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="income-dashone-total orders-monthly shadow-reset nt-mg-b-30">
                        <div class="income-title">
                            <div class="main-income-head">
                                <h2>Pengeluaran</h2>
                                <div class="main-income-phara order-cl">

                                </div>
                            </div>
                        </div>
                        <div class="income-dashone-pro">
                            <div class="income-rate-total">
                                <div class="price-adminpro-rate">
                                    <h3>Rp <span class="counter">{{$count1}}</span></h3>
                                </div>
                                <div class="price-graph">
                                    <span id="sparkline6"></span>
                                </div>
                            </div>
                            <div class="income-range order-cl">                                
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div id="panel-body">
                <img src="{{url("/asset/img/logo/logo4.jpg")}}" width="100%">
            </div>
        </div>
    </div>
@endsection