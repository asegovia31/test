
@extends('layout')

@foreach($info as $infos) 
<li>           
{{ $infos->nombre }}
</li>
@endforeach
        
   


