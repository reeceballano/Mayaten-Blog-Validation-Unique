@layout('layouts.default')

@section('content')
	@if(Session::has('message'))
		<p style="color:green;">{{ Session::get('message') }}</p>
	@endif

	<h2>Blog Lists</h2>

	<ul>
	@foreach($posts as $post)
		<li>
			{{ HTML::link_to_route('post_show', $post->title, array($post->id)) }} <br />
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

	<hr>

	{{ HTML::link_to_route('post_new', 'Add New Post') }}	
@endsection