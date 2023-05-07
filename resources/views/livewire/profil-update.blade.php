<div >
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <div class="card-body">
                        <h5 class="card-title">Foto Kepala</h5>
                        <p class="card-text"><input type="file" class="form-control input-sm @error ('foto_kepala') is-invalid @enderror " wire:model="foto_kepala"></p>
                        {{-- <img src="{{ url('storage/'.$oldfoto_kepala .'') }}" width="100%"> --}}
                      </div>
                  </div>
                  <div class="col-md-8" >
                    <div class="card-body">
                      <h5 class="card-title">Sambutan</h5>
                      <div wire:ignore><textarea wire:model="sambutan" class="sambutan"  name="sambutan"></textarea></div>

                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-12">
                    <div class="card-body">
                      <b>Nama Kepala:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('nama_kepala') is-invalid @enderror " placeholder="" wire:model="nama_kepala"></p>
                      <b>Nama Kantor:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('nama_kantor') is-invalid @enderror " placeholder="" wire:model="nama_kantor"></p>
                      <b>Alamat Kantor:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('alamat_kantor') is-invalid @enderror " placeholder="" wire:model="alamat_kantor"></p>
                      <b>Url Map:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('url_map') is-invalid @enderror " placeholder="" wire:model="url_map"></p>
                      <b>Telp Kantor:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('telp_kantor') is-invalid @enderror " placeholder="" wire:model="telp_kantor"></p>
                      <b>Hotline Whatsapp:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('hotline_wa') is-invalid @enderror " placeholder="" wire:model="hotline_wa"></p>
                      <b>Email Kantor:</b>
                      <p class="card-text"><input type="email" class="form-control input-sm @error ('email_kantor') is-invalid @enderror " placeholder="" wire:model="email_kantor"></p>
                      <b>Jam Layanan:</b>
                      <p class="card-text"><div wire:ignore><textarea wire:model="jam_layanan" class="jam_layanan"  name="jam_layanan"></textarea></div></p>
                      <b>Selayang Pandang:</b>
                      <p class="card-text"><div wire:ignore><textarea wire:model="selayang_pandang" class="selayang_pandang"  name="selayang_pandang"></textarea></div></p>
                      <b>Text Footer:</b>
                      <p class="card-text"><div wire:ignore><textarea wire:model="tupoksi" class="tupoksi"  name="tupoksi"></textarea></div></p>
                      <b>Video Profil:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('video_profil') is-invalid @enderror " placeholder="" wire:model="video_profil"></p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-12">
                    <div class="card-body">
                      <b>Seo Description:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('seo_desc') is-invalid @enderror " placeholder="" wire:model="seo_desc"></p>
                      <b>Seo Keywords:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('seo_keywords') is-invalid @enderror " placeholder="" wire:model="seo_keywords"></p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-12">
                    <div class="card-body">
                      <b>Facebook:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('fb') is-invalid @enderror " placeholder="" wire:model="fb"></p>
                      <b>Instagram:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('ig') is-invalid @enderror " placeholder="" wire:model="ig"></p>
                      <b>Twitter:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('tw') is-invalid @enderror " placeholder="" wire:model="tw"></p>
                      <b>ID Channel Youtube:</b>
                      <p class="card-text"><input type="text" class="form-control input-sm @error ('channel_yt') is-invalid @enderror " placeholder="" wire:model="channel_yt"></p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <div class="card-body">
                      <b>Logo  (Ukuran rekomendasi 324x52 pixels ):</b>
                      <p class="card-text"><input type="file" class="form-control input-sm @error ('logo') is-invalid @enderror " wire:model="logo"></p>
                      {{-- <img src="{{ url('storage/'.$oldlogo .'') }}" width="100%"> --}}

                      <b>Favicon:</b>
                      <p class="card-text"><input type="file" class="form-control input-sm @error ('favicon') is-invalid @enderror " wire:model="favicon"></p>
                      {{-- <img src="{{ url('storage/'.$oldfavicon .'') }}" width="100%">                  --}}
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <table width="100%">
        <tr><td align="right">

            <button wire:click="update()" class="btn btn-primary">Simpan</button>

        </td></tr>
    </table>

</div>
<script>
    tinymce.init({
      selector: 'textarea.sambutan',
      //plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link code table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      forced_root_block: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
            @this.set('sambutan', editor.getContent());
            });
        },
    });
    tinymce.init({
      selector: 'textarea.jam_layanan',
      //plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link code table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      forced_root_block: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
            @this.set('jam_layanan', editor.getContent());
            });
        },
    });
    tinymce.init({
      selector: 'textarea.selayang_pandang',
      //plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link code table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      forced_root_block: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
            @this.set('selayang_pandang', editor.getContent());
            });
        },
    });
    tinymce.init({
      selector: 'textarea.tupoksi',
      //plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link code table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      forced_root_block: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
            @this.set('tupoksi', editor.getContent());
            });
        },
    });
  </script>
