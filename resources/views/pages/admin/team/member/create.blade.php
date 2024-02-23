@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{ route('admin.master.team.show', $team) }}" class="btn btn-default">
                        <i class="fa fa-chevron-left"></i> {{ __('Kembali') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 mb-1">
                            <div class="form-group">
                                <input id="input__nrp" type="text" class="form-control" name="nrp"
                                    placeholder="Cari berdasarkan NRP">
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <button id="search-pengguna" class="btn btn-info btn-block">
                                <i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                    <div id="show-user"></div>
                    <form id="form-store" action="{{ route('admin.master.team.member.store', compact('team')) }}"
                        class="form" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="user_id" id="input__user_id">
                    </form>
                </div>
                <div class="card-footer">
                    <button id="btn-submit" class="btn btn-primary" disabled>
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const CariPenggunaBerdasarkanNRP = (nrp) => {
            $('#show-user').empty();
            $('#btn-submit').attr('disabled', true);

            const body = new FormData();

            body.append('username', nrp);
            const response = fetch('{{ route('admin.master.team.search') }}', {
                method: 'POST',
                body
            })

            response.then(result => result.json()).then(result => {
                if (!result.status) {
                    return alert(result.message);
                }

                $('#btn-submit').removeAttr('disabled');
                $('#input__user_id').val(result.data.id)
                $('#show-user').html(`
                <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                    Pengguna berhasil ditemukan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <table class='table'>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>${result.data.name}</td>
                    </tr>
                    <tr>
                        <td>NRP</td>
                        <td>:</td>
                        <td>${result.data.username}</td>
                    </tr>
                </table>`);
            });
        }

        $('#search-pengguna').on('click', function() {
            let nrp = $('#input__nrp').val();

            if (!nrp) return alert('NRP tidak boleh kosong');

            CariPenggunaBerdasarkanNRP(nrp);
        })

        $('#btn-submit').on('click', () => {
            if (!confirm('Apakah anda yakin ingin menjalankan aksi ini ?')) {
                return
            }

            $('#form-store').submit();
        })
    </script>
@endsection
