@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Bank.__title')

        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('admin:banks.update',$bank->uuid) }}" method="post" enctype="multipart/form-data">>
                    @csrf
                    <div class="card">
                        <div class="card-body">

                                <p class="card-title-desc">Entrer les information du banque</p>
                                <div class="col-lg-12">

                                    @include('Sameleon.Admin.Bank.edit.__edit_info')

                                </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 justify-content-end mb-4">
                        <div class="">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" {{-- onclick='document.getElementById("overlayy").style.display = "block"' --}}>
                                {{ __('buttons.store') }}

                            </button>

                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection

@section('css')
@endsection

@push('scripts')
@endpush
