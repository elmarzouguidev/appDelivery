<div class="modal fade importCommandModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Importer la list des commands</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin:commands.import') }}" enctype="multipart/form-data">
                    @csrf
                    @if(isAdmin())
                        <div class="row mb-4">

                            <label class="form-label col-lg-2">Client *</label>
                            <div class="col-lg-10">
                                <select name="client" class="form-control @error('client') is-invalid @enderror"
                                    required>
                                    <option value="">Choisir le client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->uuid }}">{{ $client->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>
                    @endif
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">List *</label>
                        <div class="col-lg-10">
                            <input class="form-control @error('file') is-invalid @enderror" name="file" type="file"
                             accept=".xlsx, .xls, .csv"
                             required />
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="badge bg-danger">Le champ doit être au format (csv,xlsx,xls)</span>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2"></label>
                        <div class="col-lg-5">
                            <button type="submit" class="btn btn-primary">Importer</button>
                        </div>
    
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">

 
                            <tbody>
                                
                                    <tr>
                                        <td>destinataire</td>
                                       
                                        <th><span class="badge bg-success">Champ requis</span></th>
                                    </tr>
                                    <tr>
                                        <td>telephone </td>
                                        <th>
                                            <span class="badge bg-success">Champ requis</span>
                                            le téléphone doit être correspond a la format maroccain (+212 ou 06)
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>ville</td>
                                        <th>
                                            <span class="badge bg-success">Champ requis</span>
                                            la ville doit déjà être créée Veuillez utiliser le nom complet de la ville
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>region</td>
                                       
                                        <th><span class="badge bg-primary">Champ facultatif</span></th>
                                    </tr>
                                    <tr>
                                        <td>adresse </td>
                                        <th><span class="badge bg-success">Champ requis</span></th>
                                    </tr>
                                    <tr>
                                        <td>produit </td>
                                        <th>
                                            <span class="badge bg-success">Champ requis</span>
                                            le produit doit déjà être créée Veuillez utiliser le nom complet de produit
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>qte </td>
                                        <th><span class="badge bg-success">Champ requis</span></th>
                                    </tr>
                                    <tr>
                                        <td>prix </td>
                                        <th><span class="badge bg-success">Champ requis</span></th>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-5 mt-5">
                        <a  target="__blank"
                            href="https://sameleon-express.ma/sameleon-express-excel-commands.xlsx" 
                            class="btn btn-primary"
                            >
                         Télécharger l'exemple
                       </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
