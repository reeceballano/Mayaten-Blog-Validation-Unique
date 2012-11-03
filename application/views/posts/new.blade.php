@layout('layouts.default')

@section('content')

	@if(Session::has('message'))
		<p style="color:green;">{{ Session::get('message') }}</p>
	@endif

	@if($errors->has())
		{{ $errors->first('title', '<li>:message</li>') }}
		{{ $errors->first('body', '<li>:message</li>') }}
		{{ $errors->first('author', '<li>:message</li>') }}
		{{ $errors->first('category', '<li>:message</li>') }}
	@endif

	<h2>Add New Post!</h2>

	{{ Form::open('post/create', 'POST') }}
		{{ Form::label('title', 'Title:') }} <br />
		{{ Form::text('title', Input::old('title')) }} <br />

		{{ Form::label('body', 'Body:') }} <br />
		{{ Form::textarea('body', Input::old('body')) }} <br />

		{{ Form::label('author', 'Author:') }} <br />
		{{ Form::text('author', Input::old('author')) }} <br />

		{{ Form::select('category', $category, Input::old('category')) }} <br />

		{{ Form::submit('Create Post') }}
	{{ Form::close() }}

@endsection