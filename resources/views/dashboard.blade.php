<title>Dashboard</title>
<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow" style="background-color: #fac0b9">
            <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                <div class="d-block mb-3 mb-sm-0">
                    <div class="fs-5 fw-normal mb-2">Total Earning</div>
                    <h2 class="fs-3 fw-extrabold">${{ $total_earning }}</h2>
                </div>
                <div class="d-flex ms-auto">
                    <a href="javascript: initChart('monthly');" class="btn btn-sm me-2 monthly-chart">Month</a>
                    <a href="javascript: initChart('weekly');" class="btn btn-secondary weekly-chart">Week</a>
                </div>
            </div>
            <div class="card-body p-2">
                <div class="ct-chart-sales-value ct-double-octave ct-series-g"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="h5">Driver</h2>
                            <h3 class="fw-extrabold mb-1">{{ $total_drivers }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Driver</h2>
                            <h3 class="fw-extrabold mb-2">{{ $total_drivers }}</h3>
                        </div>
                        <div class="small d-flex mt-1">
                            @if($diff_drivers > 0)
                                <div>Since last month <svg class="icon icon-xs text-success" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg><span class="text-success fw-bolder">{{ $diff_drivers }}</span></div>
                            @else
                                <div>Since last month <svg class="icon icon-xs text-danger" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg><span class="text-danger fw-bolder">{{ abs($diff_drivers) }}</span></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5">Rider</h2>
                            <h3 class="mb-1">{{ $total_riders }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Rider</h2>
                            <h3 class="fw-extrabold mb-2">{{ $total_riders }}</h3>
                        </div>
                        <div class="small d-flex mt-1">                               
                            @if($diff_riders > 0)
                                <div>Since last month <svg class="icon icon-xs text-success" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg><span class="text-success fw-bolder">{{ $diff_riders }}</span></div>
                            @else
                                <div>Since last month <svg class="icon icon-xs text-danger" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg><span class="text-danger fw-bolder">{{ abs($diff_riders) }}</span></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5"> Monthly Earning</h2>
                            <h3 class="mb-1">$ {{ $monthly_earning }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0"> Monthly Earning</h2>
                            <h3 class="fw-extrabold mb-2">${{ $monthly_earning }}</h3>
                        </div>
                        <div class="small d-flex mt-1">                               
                            @if($diff_monthly_earning > 0)
                                <div>Since last month <svg class="icon icon-xs text-success" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg><span class="text-success fw-bolder">${{ $diff_monthly_earning }}</span></div>
                            @else
                                <div>Since last month <svg class="icon icon-xs text-danger" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg><span class="text-danger fw-bolder">${{ abs($diff_monthly_earning) }}</span></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow mb-4">
            <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                <h2 class="fs-5 fw-bold mb-0">Progress track</h2>
                 <a href="/riderequest" class="btn btn-sm btn-primary">See All Ride Reqeust</a>
             </div>
            <div class="card-body">
                <!-- Project 1 -->
                <div class="row mb-4">
                    <div class="col-auto">
                        <svg class="icon icon-sm text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="col">
                        <div class="progress-wrapper">
                            <div class="progress-info">
                                <div class="h6 mb-0">Ride request progress</div>
                                <div class="small fw-bold text-gray-500"><span>{{ $request_progress }} %</span></div>
                            </div>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="{{ $request_progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $request_progress }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Project 2 -->
                <div class="row align-items-center mb-4">
                    <div class="col-auto">
                        <svg class="icon icon-sm text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="col">
                        <div class="progress-wrapper">
                            <div class="progress-info">
                                <div class="h6 mb-0">Ride request completion</div>
                                <div class="small fw-bold text-gray-500"><span>{{ $request_completion }} %</span></div>
                            </div>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $request_completion }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $request_completion }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Project 3 -->
                <div class="row align-items-center mb-4">
                    <div class="col-auto">
                        <svg class="icon icon-sm text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="col">
                        <div class="progress-wrapper">
                            <div class="progress-info">
                                <div class="h6 mb-0">Ride request cancellation</div>
                                <div class="small fw-bold text-gray-500"><span>{{ $request_cancellation }} %</span></div>
                            </div>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{ $request_cancellation }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $request_cancellation }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card border-0 shadow">
            <div class="card-header border-bottom d-flex align-items-center justify-content-between">
               <h2 class="fs-5 fw-bold mb-0">New Feedback</h2>
                <a href="/feedback" class="btn btn-sm btn-primary">See all</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush list my--3">
                    <li class="list-group-item px-0">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#" class="avatar">
                                    <img class="rounded" alt="Image placeholder" src="/assets/img/team/profile-picture-1.jpg">
                                </a>
                            </div>
                            <div class="col-auto ms--2">
                                <h4 class="h6 mb-0">
                                    <a href="#">Chris Wood</a>
                                </h4>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted">This is new feedback ...</small>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#" class="avatar">
                                    <img class="rounded" alt="Image placeholder" src="/assets/img/team/profile-picture-3.jpg">
                                </a>
                            </div>
                            <div class="col-auto ms--2">
                                <h4 class="h6 mb-0">
                                    <a href="#">Bonnie Green</a>
                                </h4>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted">This is new feedback ...</small>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#" class="avatar">
                                    <img class="rounded" alt="Image placeholder" src="/assets/img/team/profile-picture-4.jpg">
                                </a>
                            </div>
                            <div class="col-auto ms--2">
                                <h4 class="h6 mb-0">
                                    <a href="#">Neil Sims</a>
                                </h4>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted">This is new feedback ...</small>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div> --}}
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header border-bottom d-flex align-items-center justify-content-between">
               <h2 class="fs-5 fw-bold mb-0">Driver Income Ranking</h2>
                <a href="/earning" class="btn btn-sm btn-primary">See all</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush list my--3">
                    @foreach($driver_incomme_rankings as $item)
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <a href="/driver/details/{{ $item->id }}" class="avatar-md">
                                        @if($item->driver_photo)
                                            <img src="{{ asset('storage/' . $item->driver_photo) }}" class="rounded" alt="Driver Photo">
                                        @else
                                            <img class="rounded" src="{{ asset('assets/img/profile_default.jpg') }}" alt="Driver Photo">
                                        @endif
                                    </a>
                                </div>
                                <div class="col-10 d-flex justify-content-between">
                                    <h5 class="mb-0">
                                        <a href="/driver/details/{{ $item->id }}">{{ $item->first_name }} {{ $item->last_name }}</a>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <span>${{ number_format($item->total_earning) }}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    {{-- <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="col-12 px-0 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header d-flex flex-row align-items-center flex-0 border-bottom">
                    <div class="d-block">
                        <div class="h6 fw-normal text-gray mb-2">Total orders</div>
                        <h2 class="h3 fw-extrabold">{{ $total_request }}</h2>
                    </div>
                    <div class="d-block ms-auto">
                        <div class="d-flex align-items-center text-end mb-2">
                            <span class="dot rounded-circle bg-gray-800 me-2"></span>
                            <span class="fw-normal small">July</span>
                        </div>
                        <div class="d-flex align-items-center text-end">
                            <span class="dot rounded-circle bg-secondary me-2"></span>
                            <span class="fw-normal small">August</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="ct-chart-ranking ct-golden-section ct-series-a"></div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<script>
    let week_label = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    let month_label = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    let week_data = {!! json_encode($weekly_earning_data) !!};
    let month_data = {!! json_encode($monthly_earning_data) !!};

    $(function () {
        initChart('weekly');
    });

    function initChart(type) {
        if (type == 'monthly') {
            $('.monthly-chart').removeClass('btn-sm');
            $('.monthly-chart').addClass('btn-secondary');
            $('.weekly-chart').removeClass('btn-secondary');
            $('.weekly-chart').addClass('btn-sm');
        } else {
            $('.weekly-chart').removeClass('btn-sm');
            $('.weekly-chart').addClass('btn-secondary');
            $('.monthly-chart').removeClass('btn-secondary');
            $('.monthly-chart').addClass('btn-sm');
        }

        new Chartist.Line('.ct-chart-sales-value', {
            labels: type == 'monthly' ? month_label : week_label,
            series: [
                type == 'monthly' ? month_data : week_data
            ]
        }, {
            low: 0,
            showArea: true,
            fullWidth: true,
            plugins: [
            Chartist.plugins.tooltip()
            ],
            axisX: {
                // On the x-axis start means top and end means bottom
                position: 'end',
                showGrid: true
            },
            axisY: {
                // On the y-axis start means left and end means right
                showGrid: false,
                showLabel: false,
                labelInterpolationFnc: function(value) {
                    return '$' + (value / 1) + 'k';
                }
            }
        });
    }
</script>