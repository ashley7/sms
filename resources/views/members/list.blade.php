@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">{{ __('Dashboard') }}</div>
            <a href="{{route('members.create')}}" class="btn btn-success">Create member</a>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Compose message
            </button>
            <hr>
            <div class="card">              
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Group</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                @foreach($members as $member)
                                    <tr>
                                        <td>{{$member->name}}</td>
                                        <td>{{$member->phone_number}}</td>
                                        <td>{{$member->group}}</td>
                                        <td>
                                            <form method="POST" action="{{route('members.destroy',$member->id)}}">
                                                @csrf 
                                                {{method_field('DELETE')}}
                                                <a href="{{route('members.edit',$member->id)}}" class="badge badge-primary p-1">Edit</a>
                                                <button type="submit" class="badge badge-danger p-1">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Compose Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{url('send_message')}}">
                                @csrf                           

                                <label>Compose message</label>
                                <textarea name="compose_message" class="form-control"></textarea>

                                <label>Select Group</label>
                                <select name="group" id="group" class="form-control">
                                    <option></option>
                                    @foreach($groups as $group)
                                    <option value="{{$group}}">{{$group}}</option>
                                    @endforeach
                                </select>

                                <label>Select members</label>
                                <select name="members[]" multiple id="members" class="form-control"></select>

                                <hr>
                                <button type="submit">Send Message</button>
                            </form>

                        </div>
                        
                        </div>
                    </div>
                </div>                  
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
  <script>
     $("#group").chosen({width: "100%"}); 
  </script>

<script type="text/javascript">
    

    $('#group').on('change',function(e){
       var group = e.target.value;

       $.get('/members/'+group,function(data){

         $('#members').chosen('destroy'); 

         $('#members').empty();

         $('#members').append("<option></option>");

         $.each(data,function(index,subObject){
         $('#members').append("<option selected value="+subObject.id+">"+subObject.name+"- "+subObject.phone_number+"</option>");
         });

         $('#members').chosen({
           width:"100%"
         })
       });

   });
</script> 
@endpush



