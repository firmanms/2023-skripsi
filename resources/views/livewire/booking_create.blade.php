<div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div>
                <label for="first_name">Date</label>
                <input type="date" class="form-control input-sm @error ('date_booking') is-invalid @enderror " placeholder="" wire:model="date_booking">
                {{-- <input type="date" class="form-control"  placeholder="2023-02-31" id="datepicker" name="dateofbirth" required> --}}
            </div>
        </div>
        <div class="col-md-8 mb-3 ">
            <div>
                <label for="last_name">Service</label>
                <select class="form-select @error ('date_booking') is-invalid @enderror " wire:model="jenis">
                    <option value="">-Pilih-</option>
                    <option value="Swab">Swab</option>
                    <option value="Konsultasi">Konsultasi</option>
                </select>
                {{-- <input class="form-control" id="last_name" type="text" placeholder="Also your last name" required> --}}
            </div>
        </div>
    </div>
    @if (Auth::user()->statusnya=='success')
    Are you sure? After ordering the service, you cannot change the return date
    <div class="mt-1">
        <button class="btn btn-gray-800 mt-2 animate-up-2" wire:click="store()">Booking</button>
    </div>

    @else
        Belum bisa Booking, Tunggu sampai admin melakukan approve
    @endif

</div>
