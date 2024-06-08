@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Karya Disetujui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['approvedWork'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-laptop fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Karya Belum Disetujui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['notApprovedWork'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-laptop fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Tim</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['teams'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-laptop fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Mahasiswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['students'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-laptop fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
