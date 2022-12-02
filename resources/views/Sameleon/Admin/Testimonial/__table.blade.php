<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">
                            <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                data-bs-toggle="modal" data-bs-target=".addTestimonialModal">
                                Ajouter une témoignage
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

                                <th class="align-middle">Contenu</th>
                        
                                <th class="align-middle">Etat</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="testimonial-{{ $testimonial->id }}">
                                            <label class="form-check-label" for="condition-{{ $testimonial->id }}"></label>
                                        </div>
                                    </td>

                                    <td>
                                        {!! $testimonial->content !!}
                                    </td>
                    
                                    <td>

                                        <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                            <input data-testimonial="{{ $testimonial->uuid }}" class="form-check-input activeTestimonial"
                                                type="checkbox" id="SwitchCheckSizelg"
                                                {{ $testimonial->approved == true ? 'checked' : '' }}>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this teqtimonial ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-testimonial-{{ $testimonial->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-testimonial-{{ $testimonial->uuid }}" method="post"
                                        action="{{ route('admin:testimonials.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="testimonialId" value="{{ $testimonial->uuid }}">
                                    </form>

                                    <form id="activate-testimonial-{{ $testimonial->uuid }}" method="post"
                                        action="{{ route('admin:testimonials.activate') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="testimonialId" value="{{ $testimonial->uuid }}">
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
