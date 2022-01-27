<div class="mb-3">
    <label class="form-label" for="{{$name}}" >{{$title}}</label>
    <input type="text" class="form-control @error($name) is-invalid @enderror" @if($formId) form="{{$formId}}" @endif value="{{old($name,$default)}}"  name="{{$name}}" >
    @error($name)
    <p class="text-danger small">{{ $message }}</p>
    @enderror
</div>
