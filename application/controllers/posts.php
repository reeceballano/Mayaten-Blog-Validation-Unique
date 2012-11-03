<?php

class Posts_Controller Extends Base_Controller {
	public $restful = true;

	public function get_index() {
		return View::make('posts.index')
			->with('title', 'Blog Lists')
			->with('posts', Post::with(array('comments', 'category'))->order_by('created_at', 'desc')->get());
	}

	public function get_show($id) {
		$post = Post::find($id);
		return View::make('posts.show')
			->with('title', $post->title . ' - Mayaten Blog!')
			->with('post', $post)
			->with('recent_comments', Comment::order_by('created_at', 'desc')->get());
	}

	public function get_edit($id) {
		$post = Post::where('id', '=', $id)->first();
		return View::make('posts.edit')
			->with('title', $post->title)
			->with('category', Category::lists('name', 'id'))
			->with('post', $post);
	}

	public function put_update() {
		$id = Input::get('id');

		$validation = Post::validate(Input::all(), $id);

		if($validation->fails()) {
			return Redirect::to_route('post_edit', $id)
				->with_errors($validation);
		} else {
			Post::update($id, array(
					'title'=>Input::get('title'),
					'body'=>Input::get('body'),
					'author'=>Input::get('author'),
					'category_id'=>Input::get('category')
				));
			return Redirect::to_route('post_show', $id)
				->with('message', 'Post has been updated!');
		}
	}

	public function get_new() {
		return View::make('posts.new')
			->with('title', 'Add New Post!')
			->with('category', Category::lists('name', 'id'));
	}

	public function post_create() {
		$validation = Post::validate(Input::all());
		if($validation->fails()) {
			return Redirect::to_route('post_new')
				->with_errors($validation)
				->with_input();
		} else {
			Post::create(array(
				'title'=>Input::get('title'),
				'body'=>Input::get('body'),
				'author'=>Input::get('author'),
				'category_id'=>Input::get('category')
			));
			return Redirect::to_route('post_new')
				->with('message', 'New Post has been added!');
		}
	}

	public function delete_destroy() {
		Post::find(Input::get('id'))->delete();
		return Redirect::to_route('home')
			->with('message', 'Post has been deleted successfully!');
	}
}