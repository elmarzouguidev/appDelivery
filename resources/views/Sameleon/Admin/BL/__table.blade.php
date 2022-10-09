<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">

                        </div>
                    </div>
                </div>

                @include('layouts._parts.__messages')

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

                                <th class="align-middle">CODE</th>
                                <th class="align-middle">Ville</th>
                                <th class="align-middle">N°Commands</th>
                                <th class="align-middle">Date</th>
                                <th class="align-middle">PDF</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bons as $bon)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="bon-{{ $bon->id }}">
                                            <label class="form-check-label" for="bon-{{ $bon->id }}"></label>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $bon->full_number }}
                                    </td>
                                    <td>
                                        {{ $bon->city->name }}
                                    </td>
                                    <td>
                                        {{ $bon->total_commands}}
                                    </td>
                                    <td>
                                        {{ $bon->bon_date->format('d-m-Y')}}
                                    </td>
                                    <td>
                                        <a href="#" class=" btn btn-info btn-sm" type="button">
                                            <i class="mdi mdi-file-pdf-box font-size-18"></i>
                                            {{ $bon->full_number }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this BL ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-bl-{{ $bon->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-bl-{{ $bon->uuid }}" method="post"
                                        action="{{ route('admin:b-livraison.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="bonId" value="{{ $bon->uuid }}">
                                    </form>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
