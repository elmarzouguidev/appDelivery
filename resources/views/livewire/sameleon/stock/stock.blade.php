<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="col-lg-4 mb-4">
                                {{-- <a href="#" type="button" onclick="openFilters()" class="btn btn-primary" >
                                    Filters
                                </a> --}}
                                <a href="{{ route('admin:products.create') }}" type="button" class="btn btn-info">
                                    Ajouter un Produit
                                </a>
                            </div>
                        </div>
                    </div>

                    @include('layouts._parts.__messages')

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width: 20px;" class="align-middle">
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                @if(auth()->user()->hasAnyRole('Admin','SuperAdmin'))
                                <th scope="col">Client</th>
                                @endif
                                <th scope="col">Produit</th>
                                <th scope="col">Qté initial</th>
                                <th scope="col">Qté Livré</th>
                                <th scope="col">Qté Expédié</th>
                                <th scope="col">Qté Endommagé</th>
                                <th scope="col">Qté Restant</th>
                                <th scope="col">Détail</th>
                                <th scope="col">Date</th>
                                @if(auth()->user()->hasAnyRole('Admin','SuperAdmin'))
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($stocks as $stock)
                                @php
                                    $color ='';
                                    $stock->is_out ? $color='red' :$color='';
                                @endphp
                                @php
                                if(request()->has('isOut'))
                                {
                                    $selected = request()->isOut;

                                   // dd($selected);
                                }
                                else{
                                    $selected = '' ;
                                }
                                @endphp
                                <tr style="color :{{$color}} !important" {{ $selected == $stock->uuid ? 'bgcolor=#50a5f1' : ''}} >
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="client-{{ $stock->id }}">
                                            <label class="form-check-label" for="client-{{ $stock->id }}"></label>
                                        </div>
                                    </td>
                                    @if(auth()->user()->hasAnyRole('Admin','SuperAdmin'))
                                    <td>
                                       
                                            {{ optional($stock->client)->full_name }}
                                       
                                    </td>
                                    @endif
                                    <td>
                                      
                                            {{ $stock->name }}
                                        
                                    </td>

                                    <td>
                                        {{ $stock->qte_global }}
                                    </td>

                                    <td>
                                        {{ $stock->qte_livre }}
                                    </td>
                                    <td>
                                        {{ $stock->qte_expidite }}
                                    </td>
                                    <td>
                                        {{ $stock->qte_endomage }}
                                    </td>
                                    <td>
                                        {{ $stock->qte_rest }}
                                    </td>
                                    <td>
                                        {{ $stock->notes }}
                                    </td>
                                    <td>
                                        {{ $stock->created_at }}
                                    </td>
                                    @if(auth()->user()->hasAnyRole('Admin','SuperAdmin'))
                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="#" wire:click="editStock('{{ $stock->uuid }}')"
                                                class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            {{--<a href="#" class="text-danger" onclick="
                                                    var result = confirm('Are you sure you want to delete this stock ?');
    
                                                    if(result){
                                                        event.preventDefault();
                                                        document.getElementById('delete-stock-{{ $stock->uuid }}').submit();
                                                    }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>--}}
                                        </div>
                                    </td>
                                    {{--<form id="delete-stock-{{ $stock->uuid }}" method="post"
                                        action="{{ route('admin:stock.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="stockId" value="{{ $stock->uuid }}">
                                    </form>--}}
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if ($showEditStock)
        @include('livewire.sameleon.stock.edit-stock', [
            'stock' => $stockEdit,
        ])
    @endif
</div>