<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">
                            <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                data-bs-toggle="modal" data-bs-target=".addConditionModal">
                                Ajouter une Condition
                            </button>
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

                                <th class="align-middle">Titre</th>
                                <th class="align-middle">Contenu</th>
                                <th class="align-middle">Etat</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conditions as $condition)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="condition-{{ $condition->id }}">
                                            <label class="form-check-label" for="condition-{{ $condition->id }}"></label>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $condition->title }}
                                    </td>
                                    <td>
                                        {!! $condition->description !!}
                                    </td>
                                
                                    <td>

                                        <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                            <input data-condition="{{ $condition->uuid }}" class="form-check-input activeCondition"
                                                type="checkbox" id="SwitchCheckSizelg"
                                                {{ $condition->active == true ? 'checked' : '' }}>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            {{--<a href="{{ route('admin:banks.edit', $condition->uuid) }}"
                                                class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>--}}
                                            <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this condition ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-condition-{{ $condition->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-condition-{{ $condition->uuid }}" method="post"
                                        action="{{ route('admin:conditions.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="conditionId" value="{{ $condition->uuid }}">
                                    </form>

                                    <form id="activate-condition-{{ $condition->uuid }}" method="post"
                                        action="{{ route('admin:conditions.activate') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="conditionId" value="{{ $condition->uuid }}">
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
