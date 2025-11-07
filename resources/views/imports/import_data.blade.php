@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Import users ') }}</div>

                <div class="card-body">

                <form method="POST" action="{{route('import_data.store')}}" class="col-md-6" enctype="multipart/form-data">
                    @csrf 

                    <label for="">Select Excel file</label>
                    <input type="file" name="excel_file">
                    <hr>
                    <button type="submit">Import</button> 

                </form>
                   

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
