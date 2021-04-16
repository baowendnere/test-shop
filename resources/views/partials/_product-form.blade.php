@csrf
    <div class="form-group">
        <label for="designation">Désignation</label>
        <input value= "{{ old('designation') ?? $product->designation }}" type="text" name="designation" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("designation")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="prix">Prix</label>
        <input value= "{{ old('prix') ?? $product->prix }}" type="number" name="prix" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("prix")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select class="form-control" name="category_id" id="category_id">
        @foreach ($categories as $categorie )
            <option {{ ($product->category_id == $categorie->id OR old('category_id')==$categorie->id) ? "selected" : ""}} value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
        @endforeach
        </select>
        @error("category_id")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') ?? $product->description }}
        </textarea>
        @error("decription")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
      <label for="image">Image</label>
      <input type="file" class="form-control-file" name="image" id="image" placeholder="" aria-describedby="fileHelpId">
    </div>
                    
    <button type="submit" class="btn btn-primary btn-block btn-lg">Valider</button>