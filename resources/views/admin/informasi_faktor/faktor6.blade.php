<form role="form" action="/informasi-faktor/{{$jabatan->id}}" method="POST" id="editForm">
  @csrf
  @method('PUT')
  <div class="my-3">
    <h4 class="heading-small text-muted mb-4">{{ __('6 Faktor Jabatan Struktural') }}</h4>
  </div>
  <input name="id" class="form-control" placeholder="Kode Organisasi Perangkat Daerah" type="number" maxlength="20"
    required value="{{$jabatan->id}}" hidden>
  <div class="form-group mt-3 faktor1{{ $errors->has('faktor1') ? ' has-danger' : '' }}">
    {{-- {{ dd($data_informasi_faktor) }} --}}
    <label class="form-control-label" for="faktor1">{{ __('Faktor 1') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor1') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor1" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 1</option>
      @php
      $faktor1 = faktor6('Tingkat Faktor 1');
      @endphp
      @foreach ($faktor1 as $index)
      <option value='{{ $index->id }}' @if(is_array(old('faktor', $data_informasi_faktor)) && in_array($index->id,
        old('faktor',$data_informasi_faktor)))
        selected @endif>
        {{ $index->nama_faktor }} | {{ $index->nilai}}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor2{{ $errors->has('faktor2') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor2">{{ __('Faktor 2') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor2') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor2" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 2</option>
      @php
      $faktor2 = faktor6('Tingkat Faktor 2');
      @endphp
      @foreach ($faktor2 as $index)
      <option @if(is_array(old('faktor', $data_informasi_faktor)) && in_array($index->id,
        old('faktor',$data_informasi_faktor)))
        selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }} | {{ $index->nilai}}
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
      name="faktor[]" id="faktor3" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 3</option>
      @php
      $faktor3 = faktor6('Tingkat Faktor 3');
      @endphp
      @foreach ($faktor3 as $index)
      <option @if(is_array(old('faktor', $data_informasi_faktor)) && in_array($index->id,
        old('faktor',$data_informasi_faktor)))
        selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }} | {{ $index->nilai}}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor4a{{ $errors->has('faktor4a') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor4">{{ __('Faktor 4A') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor4a') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor4a" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 4A</option>
      @php
      $faktor4a = faktor6('Tingkat Faktor 4A');
      @endphp
      @foreach ($faktor4a as $index)
      <option @if(is_array(old('faktor', $data_informasi_faktor)) && in_array($index->id,
        old('faktor',$data_informasi_faktor)))
        selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }} | {{ $index->nilai}}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor4b{{ $errors->has('faktor4b') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor4">{{ __('Faktor 4B') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor4b') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor4b" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 4B</option>
      @php
      $faktor4b = faktor6('Tingkat Faktor 4b');
      @endphp
      @foreach ($faktor4b as $index)
      <option @if(is_array(old('faktor', $data_informasi_faktor)) && in_array($index->id,
        old('faktor',$data_informasi_faktor)))
        selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }} | {{ $index->nilai}}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor5{{ $errors->has('faktor5') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor5">{{ __('Faktor 5') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor5') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor5" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 5</option>
      @php
      $faktor5 = faktor6('Tingkat Faktor 5');
      @endphp
      @foreach ($faktor5 as $index)
      <option @if(is_array(old('faktor', $data_informasi_faktor)) && in_array($index->id,
        old('faktor',$data_informasi_faktor)))
        selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }} | {{ $index->nilai}}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor6{{ $errors->has('faktor6') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor6">{{ __('Faktor 6') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor6') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor6" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 6</option>
      @php
      $faktor6 = faktor6('Tingkat Faktor 6');
      @endphp
      @foreach ($faktor6 as $index)
      <option @if(is_array(old('faktor', $data_informasi_faktor)) && in_array($index->id,
        old('faktor',$data_informasi_faktor)))
        selected @endif value='{{ $index->id }}'>
        {{ $index->nama_faktor }} | {{ $index->nilai}}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor') }}</strong>
    </span>
    @endif
  </div>
  <div class="modal-footer justify-content-center">
    {{-- <button type="button" class="btn btn-danger btn-delete" data-bs-dismiss="modal">Batal</button> --}}
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</form>