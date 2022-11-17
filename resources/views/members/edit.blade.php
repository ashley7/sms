@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <hr>

                <div class="card-body">

                                    <form method="POST" action="{{route('members.update',$member->id)}}" class="col-md-6">
                        @csrf 
                        {{method_field('PATCH')}}

                        <label>Name</label>
                        <input type="text" class="form-control" value="{{$member->name}}" name="name">

                        <label>Phone</label>
                        <input type="text" class="form-control" value="{{$member->phone_number}}" name="phone_number">

                        <label>Group</label>
                        <select name="group" class="form-control">
                            @foreach($groups as $group)
                            @if($member->group == $group)
                            <option selected value="{{$group}}">{{$group}}</option>
                            @else 
                            <option value="{{$group}}">{{$group}}</option>

                            @endif
                            @endforeach
                        </select>
                        <hr>
                        <button type="submit">Save</button>

                    </form>                 

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


