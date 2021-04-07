<template>
  <div>
      <div class="form-group row">
        <label for="pais" class="col-md-4 col-form-label text-md-right">{{ __('Pais') }}</label>

        <div class="col-md-6">
            <select name="pais" id="pais" class="form-control @error('pais') is-invalid @enderror" :value="{{ old('pais') }}" autocomplete="pais" @change="onChange()" required></select>

            @error('pais')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>