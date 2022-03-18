<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">
                            {{-- <a href="#" type="button" onclick="openFilters()" class="btn btn-primary" >
                                Filters
                            </a>
                            <a href="{{route('client:company.create')}}" type="button" class="btn btn-info">
                                 Ajouter votre société
                            </a> --}}
                            @if ($company)
                                <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                    data-bs-toggle="modal" data-bs-target=".editCompanyModal">
                                    Editer votre société
                                </button>
                            @else
                                <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                    data-bs-toggle="modal" data-bs-target=".addCompanyModal">
                                    Ajouter votre société
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('notice') }}
                    </div>
                @endif
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            {{-- <th style="width: 20px;" class="align-middle">
                                <div class="form-check font-size-16">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th> --}}
                            <th scope="col">Code</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>


                        @if ($company)
                            <tr>
                                {{-- <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox"
                                            id="company-{{ $company->id }}">
                                        <label class="form-check-label" for="company-{{ $company->id }}"></label>
                                    </div>
                                </td> --}}
                                <td>
                                    <a href="{{-- $company->url --}}" class="text-body fw-bold">
                                        {{ $company->code }}
                                    </a>
                                </td>
                                <td>
                                    {{ $company->name }}
                                    <p class="text-muted mb-0"></p>
                                </td>

                                <td>
                                    <div class="d-flex gap-3">

                                        <a href="{{ $company->edit_url }}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this company ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-company-{{ $company->uuid }}').submit();
                                                }">
                                            <i class="mdi mdi-delete font-size-18"></i>
                                        </a>
                                    </div>
                                </td>
                                <form id="delete-company-{{ $company->uuid }}" method="post"
                                    action="{{-- route('client:company.delete') --}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="companyId" value="{{ $company->uuid }}">
                                </form>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
