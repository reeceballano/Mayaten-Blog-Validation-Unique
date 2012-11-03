@layout('layouts.default')

@section('content')
	<h2>Blog Lists</h2>

	<ul>
	@foreach($posts as $post)
		<li>
			{{ $post->title }} <br />
			<small>Under: {{ $post->category->name }}</small> <br />
			
			<small>Comments: {{ count($post->comments) }}</small>			
			<ul>
			@foreach($post->comments as $comment)
				<li>{{ $comment->comment_msg }}</li>
			@endforeach
			</ul>
		</li>
	@endforeach	
	</ul>	
@endsection