@props(['name'])
@error($name)
<p {{$attributes->merge(['class' => " mt-100 text-red-500 italic"])}}>{{$message}}</p>
@enderror
