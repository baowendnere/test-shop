<table class="table">
                    <thead>
                        <tr>
            
                            <th>Designation</th>
                            <th>Categorie</th>
                            <th>Prix</th>
                            <th>Description</th>
            
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($products as $product)
                            <tr>
                        
                                <td>{{ $product->designation }}</td>
                                <td>{{ $product->category ?  $product->category->libelle : "Non catégorisé"}}</td>
                                <td>{{ formatPrixBf($product->prix) }}</td>
                                <td>{{ $product->description }}</td>
    
                            </tr> 

                        @endforeach
                    </tbody>
                </table>