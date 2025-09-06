
        <!-- Pencarian -->
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
            <input  wire:model.live="search" type="text" class="form-control" placeholder="Cari {{ strtolower($table )}}...">
        </div>
