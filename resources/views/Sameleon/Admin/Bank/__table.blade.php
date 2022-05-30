<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">

                            <a href="{{ route('admin:banks.create') }}" type="button" class="btn btn-info">
                                Ajouter une Banque
                            </a>
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
                        {{ session('error') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered border-danger table-hover align-middle table-nowrap table-check">
                        <thead class="table-light">
                            <tr>
                             
                                <th style="width: 20px;" class="align-middle">
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                </th>
 
                                <th class="align-middle">Logo</th>
                                <th class="align-middle">Nom</th>
                                <th class="align-middle">Code Banque</th>
                                <th class="align-middle">Swift Code</th>
                                <th class="align-middle">Code RIB</th>
                                <th class="align-middle">E-mail</th>
                                <th class="align-middle">Tél</th>
                                <th class="align-middle">Etat</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banks as $bank)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="bank-{{ $bank->id }}">
                                            <label class="form-check-label" for="bank-{{ $bank->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        @if(!is_null($bank->logo))
                                            <div>
                                                <img class="img-fluid rounded" alt=""
                                                    src="{{ asset('storage/' . $bank->logo) }}" width="50">
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{-- $client->url --}}" class="text-body fw-bold">
                                            {{ $bank->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $bank->code_bank }}
                                    </td>
                                    <td>
                                        {{ $bank->code_swift }}
                                    </td>
                                    <td>
                                        {{ $bank->code_rib }}
                                        
                                    </td>
                                    <td>
                                        {{ $bank->email }}
                                        
                                    </td>
                                    <td>
                                        {{ $bank->telephone }}
                                        
                                    </td>
                                    
                                    <td>

                                        <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                            <input data-bank="{{ $bank->uuid }}" class="form-check-input activeBank"
                                                type="checkbox" id="SwitchCheckSizelg"
                                                {{ $bank->active == true ? 'checked' : '' }}>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="{{ route('admin:banks.edit', $bank->uuid) }}"
                                                class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this bank ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-bank-{{ $bank->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-bank-{{ $bank->uuid }}" method="post"
                                        action="{{ route('admin:banks.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="bankId" value="{{ $bank->uuid }}">
                                    </form>

                                    <form id="activate-bank-{{ $bank->uuid }}" method="post"
                                        action="{{ route('admin:banks.activate') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="bankId" value="{{ $bank->uuid }}">
                                    </form>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
