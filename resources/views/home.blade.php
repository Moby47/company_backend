@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>


                
               
                <div class="panel panel-default">
                        <div class="panel-heading">Add Project</div>
    
                        @if(session('added'))
                        <div class='alert alert-success text-center'>
                        {{session('added')}}
                        </div>
                            @endif
        
                        <div class="panel-body">
                            <form class="form-horizontal" enctype="multipart/form-data" method="POST"   action="{{ route('add-project') }}">
                                {{ csrf_field() }}
                                
        
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Project Name</label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                         class="form-control" name="name" value="{{ old('name') }}"  autofocus>
        
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                        <label for="url" class="col-md-4 control-label">Project Url</label>
            
                                        <div class="col-md-6">
                                            <input id="url" type="text"
                                             class="form-control" placeholder="add the protocol eg https://" 
                                             url="url" value="{{ old('url') }}"  autofocus name='url'>
            
                                            @if ($errors->has('url'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('url') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
        
                                <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                                    <label for="picture" class="col-md-4 control-label">Project picture</label>
        
                                    <div class="col-md-6">
                                        <input id="picture" type="file"
                                         class="form-control" name="picture" value="{{ old('picture') }}"  autofocus>
        
                                        @if ($errors->has('picture'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('picture') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Add
                                        </button>
        
                                      
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>





                <div class="panel panel-default">
                    <div class="panel-heading">Create Blog</div>

                    @if(session('posted'))
					<div class='alert alert-success text-center'>
					{{session('posted')}}
					</div>
						@endif
    
                    <div class="panel-body">
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('create-post') }}">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>
    
                                <div class="col-md-6">
                                    <input id="title" type="text"
                                     class="form-control" name="title" value="{{ old('title') }}"  autofocus>
    
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-md-4 control-label">Image</label>
    
                                <div class="col-md-6">
                                    <input id="image" type="file"
                                     class="form-control" name="image" value="{{ old('image') }}"  autofocus>
    
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">description</label>
    
                                <div class="col-md-6">
                                    <textarea id="description"
                             class="form-control" name="description" value="{{ old('description') }}"  autofocus>
                                    </textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                          
                           
    
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
    
                                  
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



                <div class="panel panel-default">
                    <div class="panel-heading">Blog Posts</div>

                    @if(session('deleted'))
					<div class='alert alert-success text-center'>
					{{session('deleted')}}
					</div>
						@endif
    
                    <div class="panel-body">
                       <table class='table'>
                            @if(count($result)>0)
                        <tr>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                      
                    
                    @foreach($result as $p)
                        <tr>
                            <td>{{$p->title}}</td>
                        <td> 
                           <a href='/delete/{{$p->id}}'>Delete</a> 
                        </td>
                        </tr>

                        @endforeach

                       </table>

                       {{$result->links()}}

                         @else
					  <div class='alert alert-info text-center'>
								No Post(s) Currently
						  </div>
									@endif
                    </div>
                </div>





                <div class="panel panel-default">
                      
    
                        @if(session('deleted2'))
                        <div class='alert alert-success text-center'>
                        {{session('deleted2')}}
                        </div>
                            @endif
        
                        <div class="panel-body">

                                <div class="">Project List</div>
                                
                           <table class='table'>
                                @if(count($res)>0)
                            <tr>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Action</th>
                            </tr>
                          
                        
                        @foreach($res as $p)
                            <tr>
                                <td>{{$p->name}}</td>
                                <td>{{$p->url}}</td>
                            <td> 
                               <a href='/delete-project/{{$p->id}}'>Delete</a> 
                            </td>
                            </tr>
    
                            @endforeach
    
                           </table>
    
    
                             @else
                          <div class='alert alert-info text-center'>
                                    No project(s) Currently
                              </div>
                                        @endif
                        </div>
                    </div>




                    
    

            </div>
        </div>
    </div>
</div>
@endsection
