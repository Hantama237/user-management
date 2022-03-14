
@extends('master')
@section('content')

<main class="px-3">
    <div class="mb-3 mt-3">
        <h5 class="mt-3">Profile Details</h5>
        <span  id="p-picture">
            <img src="{{asset("/assets/images/profile/".$profile->picture)}}" class="rounded-circle" height="50" width="50" src="" alt=""><br>
            <span id="p-name">{{$profile->name}}</span><br>
            <span id="p-gender">{{$profile->gender}}</span><br>
            <span id="p-nationality">{{$profile->nationality}}</span><br>
            <span id="p-dateofbirth">{{$profile->date_of_birth->format("Y-m-d")}}</span><br>
        </span>
    </div>
    
</main>

@endsection