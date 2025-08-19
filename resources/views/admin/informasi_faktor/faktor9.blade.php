<form role="form" action="/informasi-faktor/{{$jabatan->id}}" method="POST" id="editForm">
  @csrf
  @method('PUT')
  <div class="my-3">
    <h4 class="heading-small text-muted mb-4">{{ __('9 Faktor Jabatan Fungsional & Pelaksana') }}</h4>
  </div>
  <input name="id" class="form-control" placeholder="Kode Organisasi Perangkat Daerah" type="number" maxlength="20"
    required value="{{ $jabatan->id }}" hidden>
  <div class="form-group mt-3 faktor1{{ $errors->has('faktor') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor1">{{ __('Faktor 1') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor1') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor1" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 1</option>
      @php
      $faktor1 = faktor9('Tingkat Faktor 1');
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
  <div class="form-group faktor2{{ $errors->has('faktor') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor2">{{ __('Faktor 2') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor2') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor2" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 2</option>
      @php
      $faktor2 = faktor9('Tingkat Faktor 2');
      @endphp
      @foreach ($faktor2 as $index)
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
  <div class="form-group faktor3{{ $errors->has('faktor') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor3">{{ __('Faktor 3') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor3') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor3" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 3</option>
      @php
      $faktor3 = faktor9('Tingkat Faktor 3');
      @endphp
      @foreach ($faktor3 as $index)
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
  <div class="form-group faktor4{{ $errors->has('faktor') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor4">{{ __('Faktor 4') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor4') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor4" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 4</option>
      @php
      $faktor4 = faktor9('Tingkat Faktor 4');
      @endphp
      @foreach ($faktor4 as $index)
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
  <div class="form-group faktor5{{ $errors->has('faktor') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor5">{{ __('Faktor 5') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor5') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor5" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 5</option>
      @php
      $faktor5 = faktor9('Tingkat Faktor 5');
      @endphp
      @foreach ($faktor5 as $index)
      <option value='{{ $index->id }}' @if(is_array(old('faktor', $data_informasi_faktor)) && in_array($index->id,
        old('faktor',$data_informasi_faktor)))
        selected @endif>
        {{ $index->nama_faktor }} | {{ $index->nilai}}
      </option>
      @endforeach
    </select>
    @if ($errors->has('faktor5'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('faktor5') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group faktor6{{ $errors->has('faktor') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor6">{{ __('Faktor 6') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor6') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor6" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 6</option>
      @php
      $faktor6 = faktor9('Tingkat Faktor 6');
      @endphp
      @foreach ($faktor6 as $index)
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
  <div class="form-group faktor7{{ $errors->has('faktor') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor7">{{ __('Faktor 7') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor7') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor7" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 7</option>
      @php
      $faktor7 = faktor9('Tingkat Faktor 7');
      @endphp
      @foreach ($faktor7 as $index)
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
  <div class="form-group faktor8{{ $errors->has('faktor') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor8">{{ __('Faktor 8') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor8') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor8" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 8</option>
      @php
      $faktor8 = faktor9('Tingkat Faktor 8');
      @endphp
      @foreach ($faktor8 as $index)
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
  <div class="form-group faktor9{{ $errors->has('faktor') ? ' has-danger' : '' }}">

    <label class="form-control-label" for="faktor9">{{ __('Faktor 9') }}</label>
    <select class="form-select form-control- form-control{{ $errors->has('faktor9') ? ' is-invalid' : '' }}"
      name="faktor[]" id="faktor9" aria-label="Default select example" required>
      <option selected value='' disabled>Pilih Faktor 9</option>
      @php
      $faktor9 = faktor9('Tingkat Faktor 9');
      @endphp
      @foreach ($faktor9 as $index)
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
  <div class="modal-footer justify-content-center">
    {{-- <button type="button" class="btn btn-danger btn-delete" data-bs-dismiss="modal">Batal</button> --}}
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</form>