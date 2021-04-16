<x-master-layout>
    <div class="container">
        
        <div class="row">
            <div class="col-md-12  mt-4">
                <h1 class="text-center">Tous nos produits</h1>
                {{-- <hr/> --}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            {{-- {{ session("satut") }} --}}
            @if (session("statut"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session("statut") }}
                </div>
                
            @endif
            
            <div>
                <a class="btn btn-success btn-sm" href="{{ route('products.create') }}"><i class="fas fa-plus"></i> Ajouter</a>
                <a class="btn btn-info btn-sm" href="{{ route('export-products') }}"><i class="fas fa-file-excel"></i> Exporter</a>
            </div>
                {{-- Le nom de l'image sélectionnée est : {{ session('imageName') }} --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Designation</th>
                            <th>Categorie</th>
                            <th>Prix</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dump($products) --}}
                        @php
                            $compteur=1;
                        @endphp

                        @foreach ($products as $product)
                            <tr>
                                <td scope="row">{{ $compteur++ }}</td>
                                <td>{{ $product->designation }}</td>
                                <td>{{ $product->category ?  $product->category->libelle : "Non catégorisé"}}</td>
                                <td>{{ formatPrixBf($product->prix) }}</td>
                                <td>{{ $product->description }}</td>
                                <td><a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit    "></i></a></td>
                                <td><a href="#" class="btn btn-danger btn-sm mr-2" onClick="event.preventDefault(); deleteConfirm('{{ $product->id }}')"><i class="fas fa-trash"></i></a></td>
                            <form id="{{ $product->id }}" method="post" action="{{ route('products.destroy', $product) }}">
                            @csrf
                            @method("DELETE")

                            </form>
                            </tr> 

                            @php
                                $compteur=$compteur;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-master-layout>