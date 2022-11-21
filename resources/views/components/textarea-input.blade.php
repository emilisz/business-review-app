@props(['error'])

@php
    $classes = ($error ?? false)
                ? 'rounded-md shadow-sm border-red-600 bg-red-100 focus:ring focus:ring-gray-200 '
                : 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50';
@endphp

<textarea rows="4"  {{ $attributes->merge(['class' => $classes]) }} >{{ $slot }}</textarea>
