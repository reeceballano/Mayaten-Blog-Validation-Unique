@layout('layouts.default')

@section('content')
	<div style="float:left; width: 400px;">
		@if(Session::has('message'))
			<p style="color:green;">{{ Session::get('message') }}</p>
		@endif
		
		<h2>{{ $post->title }}</h2>

		<span>Posted by: {{ $post->author }} / Created at: {{ $post->created_at }}</span><br />
		<span>{{ HTML::link_to_route('post_edit', 'Edit', array($post->id)) }}</span>

		{{ Form::open('post/delete', 'DELETE') }}
			{{ Form::hidden('id', $post->id) }}
			{{ Form::submit('Delete') }}
		{{ Form::close() }}

		<p>
			{{ $post->body }}
		</p>

		<hr>

		<h2>Comments: {{ count($post->comments) }}</h2>
		<ul>
		@foreach($post->comments as $comment)
			<li>{{ $comment->comment_msg }}</li>
		@endforeach
		</ul>
	</div>
	

	<div style="float:right; width: 200px;">
		<h2>Recent Comments:</h2>
		<ul>
		@foreach($recent_comments as $comment)
			<li>{{ $comment->comment_msg }}</li>
		@endforeach
		</ul>
	</div>

	
@endsection