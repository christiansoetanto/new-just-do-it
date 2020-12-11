@extends('master')

@section('content')
    <div class="card">
        <h5 class="card-header text-center bg-primary">Add Shoe</h5>
        <div class="card-body">
            <form action="{{route('shoe.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{$message}}</strong>
                    </div>
                @endif

                @if(count($errors)>0)
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <label>Shoe Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Enter Shoe Name">
                </div>
                <div class="form-group row">
                    <label>Price</label>
                    <input type="number" class="form-control" name="price" placeholder="Enter Price">
                </div>
                <div class="form-group row">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter Description">
                </div>
                <div class="form-group row">
                    <label>Choose File</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="chooseFile" onchange="getFileName()">
                        <label class="custom-file-label" for="chooseFile" id="fileLabel">Select Photo</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Shoe</button>
            </form>
        </div>
    </div>

    <script>
        function getFileName(){
            var fileName = document.getElementById('chooseFile').files[0].name;
            var label = document.getElementById('fileLabel').innerHTML = fileName;
        }
    </script>
@endsection
