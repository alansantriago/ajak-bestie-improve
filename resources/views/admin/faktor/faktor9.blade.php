<form role="form" action="" method="POST" id="editForm">
  @csrf
  @method('PUT')
  <input name="id" class="form-control" placeholder="Kode Organisasi Perangkat Daerah" type="number" maxlength="20"
    required hidden>
  <div class="form-group faktor1{{ $errors->has('faktor1') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor1">{{ __('Faktor 1') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor1') ? ' is-invalid' : '' }}"
      name="faktor1" id="faktor1" aria-label="Default select example" required>
      <option @if(old("faktor1")=='' ) selected @endif value='' disabled>Pilih Faktor 1</option>
      @php
      $faktor1 = faktor9('Tingkat Faktor 1');
      @endphp
      @foreach ($faktor1 as $index)
      <option @if(old("faktor1")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor1'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor1') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor2{{ $errors->has('faktor2') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor2">{{ __('Faktor 2') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor2') ? ' is-invalid' : '' }}"
      name="faktor2" id="faktor2" aria-label="Default select example" required>
      <option @if(old("faktor2")=='' ) selected @endif value='' disabled>Pilih Faktor 2</option>
      @php
      $faktor2 = faktor9('Tingkat Faktor 2');
      @endphp
      @foreach ($faktor2 as $index)
      <option @if(old("faktor2")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor2'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor2') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor3{{ $errors->has('faktor3') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor3">{{ __('Faktor 3') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor3') ? ' is-invalid' : '' }}"
      name="faktor3" id="faktor3" aria-label="Default select example" required>
      <option @if(old("faktor3")=='' ) selected @endif value='' disabled>Pilih Faktor 3</option>
      @php
      $faktor3 = faktor9('Tingkat Faktor 3');
      @endphp
      @foreach ($faktor3 as $index)
      <option @if(old("faktor3")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor3'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor3') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor4{{ $errors->has('faktor4') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor4">{{ __('Faktor 4') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor4') ? ' is-invalid' : '' }}"
      name="faktor4" id="faktor4" aria-label="Default select example" required>
      <option @if(old("faktor4")=='' ) selected @endif value='' disabled>Pilih Faktor 4</option>
      @php
      $faktor4 = faktor9('Tingkat Faktor 4');
      @endphp
      @foreach ($faktor4 as $index)
      <option @if(old("faktor4")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor4'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor4') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor5{{ $errors->has('faktor5') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor5">{{ __('Faktor 5') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor5') ? ' is-invalid' : '' }}"
      name="faktor5" id="faktor5" aria-label="Default select example" required>
      <option @if(old("faktor5")=='' ) selected @endif value='' disabled>Pilih Faktor 5</option>
      @php
      $faktor5 = faktor9('Tingkat Faktor 5');
      @endphp
      @foreach ($faktor5 as $index)
      <option @if(old("faktor5")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor5'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor5') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor6{{ $errors->has('faktor6') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor6">{{ __('Faktor 6') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor6') ? ' is-invalid' : '' }}"
      name="faktor6" id="faktor6" aria-label="Default select example" required>
      <option @if(old("faktor6")=='' ) selected @endif value='' disabled>Pilih Faktor 6</option>
      @php
      $faktor6 = faktor9('Tingkat Faktor 6');
      @endphp
      @foreach ($faktor6 as $index)
      <option @if(old("faktor6")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor6'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor6') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor7{{ $errors->has('faktor7') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor7">{{ __('Faktor 7') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor7') ? ' is-invalid' : '' }}"
      name="faktor7" id="faktor7" aria-label="Default select example" required>
      <option @if(old("faktor7")=='' ) selected @endif value='' disabled>Pilih Faktor 7</option>
      @php
      $faktor7 = faktor9('Tingkat Faktor 7');
      @endphp
      @foreach ($faktor7 as $index)
      <option @if(old("faktor7")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor7'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor7') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor8{{ $errors->has('faktor8') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor8">{{ __('Faktor 8') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor8') ? ' is-invalid' : '' }}"
      name="faktor8" id="faktor8" aria-label="Default select example" required>
      <option @if(old("faktor8")=='' ) selected @endif value='' disabled>Pilih Faktor 8</option>
      @php
      $faktor8 = faktor9('Tingkat Faktor 8');
      @endphp
      @foreach ($faktor8 as $index)
      <option @if(old("faktor8")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor8'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor8') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor9{{ $errors->has('faktor9') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor9">{{ __('Faktor 9') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor9') ? ' is-invalid' : '' }}"
      name="faktor9" id="faktor9" aria-label="Default select example" required>
      <option @if(old("faktor9")=='' ) selected @endif value='' disabled>Pilih Faktor 9</option>
      @php
      $faktor9 = faktor9('Tingkat Faktor 9');
      @endphp
      @foreach ($faktor9 as $index)
      <option @if(old("faktor9")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor9'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor9') }}</strong>
    </span>
    @endif
  </div>
  <div class="modal-footer justify-content-center">
    <button type="button" class="btn btn-danger btn-delete" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</form>