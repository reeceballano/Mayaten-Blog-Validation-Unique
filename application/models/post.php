<?php

class Post Extends Eloquent {
	public static $table = 'posts';
	public static $rules = array(
		'title' => 'required',
		'body'=>'required|max:200',
		'author'=>'required|max:20',
		'category'=>'required'
		);

	public static function validate($inputs, $id = null) {
		$rules = array(
		'title' => "unique:posts,title,{$id}",
		'body'=>'required|max:200',
		'author'=>'required|max:20',
		'category'=>'required'
		);

		return Validator::make($inputs, $rules);
	}

	public function category() {
		return $this->belongs_to('Category');
	}

	public function comments() {
		return $this->has_many('Comment');
	}
}