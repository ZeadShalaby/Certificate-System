<label for="{{ $forId }}">@lang('certificate.' . $lang)</label>
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text {{ $errors->has($item) ? 'text-danger' : '' }}">
            <i class="fas fa-{{ $icon }} {{ $errors->has($item) ? 'text-danger' : '' }}"></i>
        </span>
    </div>
    <input type="{{ $type }}" class="form-control {{ $errors->has($item) ? 'is-invalid' : '' }}"
        id="{{ $forId }}" name="{{ $item }}" placeholder="@lang('certificate.' . $langplaceholder)" value="{{ old($item) }}">
</div>
@if ($errors->has($item))
    <div class="invalid-feedback d-block">{{ $errors->first($item) }}</div>
@endif
