@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border border-gray-200 rounded p-2 focus:outline-none focus:ring-1 focus:ring-violet-300']) !!}>