@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-0 border-black border-b-2 focus:border-indigo-500 focus:ring-indigo-500']) !!}>
