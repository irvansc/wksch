<div>
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Users</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $users }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                        <i class='bx bxs-user bx-tada bx-rotate-90'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Guru</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $guru }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                                        <i class='bx bxs-user bx-tada bx-rotate-90'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Siswa</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $siswa }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-dark text-white rounded-circle shadow">
                                        <i class='bx bxs-user bx-tada bx-rotate-90'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Alumni</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $alumni }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class='bx bxs-user bx-tada bx-rotate-90'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mb-2 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jumlah Alumni Berdasarkan Jenis Kelamin</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart1"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jumlah Siswa Berdasarkan Jenis Kelamin</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Most Visited Post</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Post title</th>
                                        <th>Author</th>
                                        <th>Views Today</th>
                                        <th>View last 30 days</th>
                                        <th>View last 90 days</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $e=> $item)
                                    <tr>
                                        <td>
                                            {{ $e+1 }}
                                        </td>
                                        <td >
                                            <a href="{{ route('read_post',['any'=> $item->slug]) }}" style="font-size: 12px">{{ Str::limit($item->post_title, 20, '...') }}</a>
                                        </td>
                                        <td style="font-size: 12px">
                                            {{ $item->author->name }}
                                        </td>
                                        <td class="text-muted">{{ views($item)->period(\CyrildeWit\EloquentViewable\Support\Period::since(today()))->count()}}</td>
                                        <td class="text-muted">{{ views($item)->period(\CyrildeWit\EloquentViewable\Support\Period::pastDays(30))->count()}}</td>
                                            <td class="text-muted">{{ views($item)->period(\CyrildeWit\EloquentViewable\Support\Period::pastDays(90))->count()}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('back/vendor/chart/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('back/vendor/chart/Chart.min.js') }}"></script>
@endpush
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('back/vendor/chart/Chart.min.css') }}">
@endpush
@push('scripts')
<script>
    $(document).ready(function(){
        var ctx = document.getElementById("myChart1").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                data: [{!! json_encode($jenisG->Laki) !!},{!! json_encode($jenisG->Perempuan) !!}],
                backgroundColor: [
                    '#ffa426',
                    '#6777ef',
                ]
                }],
                labels: [
                'Perempuan',
                'Laki Laki'
                ],
            },
            options: {
                responsive: true,
                legend: {
                position: 'bottom',
                },
            }
        });
        var ctx = document.getElementById("myChart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                data: [{!! json_encode($jenisI->Laki) !!},{!! json_encode($jenisI->Perempuan) !!}],
                backgroundColor: [
                    '#ffa426',
                    '#6777ef',
                ]
                }],
                labels: [
                'Perempuan',
                'Laki Laki'
                ],
            },
            options: {
                responsive: true,
                legend: {
                position: 'bottom',
                },
            }
        });
    })
</script>
@endpush
