
<form wire:submit.prevent="searchDestination">
  <div class="mb-3">
    <label for="destination" class="form-label">Cari Tujuan</label>
    <input wire:model.defer="destination" type="text" class="form-control" id="destination" placeholder="Masukkan kota tujuan kamu, bisa pakai postcode">
  </div>
  <div class="d-grid grid-cols-1 gap-2">
    <div>
        <button type="submit" class="btn btn-primary">Cari</button>
    </div>
    
  </div>
  
</form>