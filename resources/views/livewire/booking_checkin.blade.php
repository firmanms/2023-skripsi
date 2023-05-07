<div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div>
                <label for="first_name">Date</label>
                <input type="date" readonly class="form-control input-sm @error ('date_booking') is-invalid @enderror " placeholder="" wire:model="date_booking">
                {{-- <input type="date" class="form-control"  placeholder="2023-02-31" id="datepicker" name="dateofbirth" required> --}}
            </div>
        </div>
        <div class="col-md-8 mb-3 ">
            <div>
                <label for="last_name">Service</label>
                {{-- <select class="form-select @error ('date_booking') is-invalid @enderror " wire:model="jenis">
                    <option value="">-Pilih-</option>
                    <option value="Swab">Swab</option>
                    <option value="Konsultasi">Konsultasi</option>
                </select> --}}
                <input type="text" readonly class="form-control input-sm @error ('jenis') is-invalid @enderror " placeholder="" wire:model="jenis">
            </div>
        </div>
    </div>
    Checkin?
    <div class="mt-1">
        <button class="btn btn-success mt-2 animate-up-2" wire:click="checkin()">Yes</button>
    </div>
</div>
