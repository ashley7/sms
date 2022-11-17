@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                <form method="POST" action="{{route('members.store')}}" class="col-md-6">
                    @csrf 

                    <label>Name</label>
                    <input type="text" class="form-control" name="name">

                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone_number">

                    <label>Group</label>
                    <select name="group" class="form-control">
                        @foreach($groups as $group)
                        <option value="{{$group}}">{{$group}}</option>
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
