@extends('master')

@section('content')
    <div class="card">
        <h5 class="card-header text-center bg-primary">Update Shoe</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <img src="{{Storage::url('/uploads/'.$shoe->photo)}}" alt="" class="img-thumbnail">
                </div>
                <div class="col-6">
                    <h4>{{$shoe->name}}</h4>
                    <p>Price: {{$shoe->price}}</p>
                    <p>Description:{{$shoe->description}}</p>
                </div>
                <div class="col-6">
                    <form action="{{route('shoe.update')}}" method="post" enctype="multipart/form-data">
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
                            <input type="hidden" name="id" value="{{$shoe->id}}"/>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Shoe Name:</label>
                            <input type="text" name="name" class="form-control" value="{{$shoe->name}}"/><br>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Price:</label>
                            <input type="number" name="price"class="form-control" value="{{$shoe->price}}"/><br>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Description:</label>
                            <input type="text" name="description"class="form-control" value="{{$shoe->description}}"/>

                        </div>
                        <div class="form-group row">
                            <label>Select Picture:</label>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="chooseFile" onchange="getFileName()">
                                <label class="custom-file-label" for="chooseFile" id="fileLabel">Select Photo</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="row ml-3">

            </div>

        </div>


    </div>

    <script>
        function getFileName(){
            var fileName = document.getElementById('chooseFile').files[0].name;
            var label = document.getElementById('fileLabel').innerHTML = fileName;
        }
    </script>
@endsection
