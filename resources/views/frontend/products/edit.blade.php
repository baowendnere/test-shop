<x-master-layout>
    <div class="container">
        
        <div class="row">
            <div class="col-md-12  mt-4">
                <h1 class="text-center">Modifier un nouveau produit</h1>
                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="post" action="{{ route('products.update', $product) }}">
                  @method("PUT") <!---insister sur l'envoi -->

                  @include("partials._product-form")
                  
                </form>
            </div>
        </div>
    </div>
</x-master-layout>