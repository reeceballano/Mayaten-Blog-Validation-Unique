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

	<h2>Edit Post!</h2>

	{{ Form::open('post/update', 'PUT') }}
		{{ Form::label('title', 'Title:') }} <br />
		{{ Form::text('title', $post->title) }} <br />

		{{ Form::label('body', 'Body:') }} <br />
		{{ Form::textarea('body', $post->body) }} <br />

		{{ Form::label('author', 'Author:') }} <br />
		{{ Form::text('author', $post->author) }} <br />

		{{ Form::hidden('id', $post->id) }}

		{{ Form::select('category', $category, Input::old('category')) }} <br />

		{{ Form::submit('Update Post') }}
	{{ Form::close() }}

@endsection