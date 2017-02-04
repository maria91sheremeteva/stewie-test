<?php
interface i_model
{
	public function __construct($id = null);
	public function set_field($field, $value);
	public function get_field($field);
	public function save();
	public function delete();
	public function id();
}

abstract class model implements i_model
{
	//	...
}

class blog_post extends model
{
	//	....
}


$post_1 = new blog_post(1);
$post_2 = new blog_post(2);

echo $post_1->get_field('date');
echo $post_1->get_field('text');

$post_1->delete();
$post_2->set_field('name', 'Some new name');
$post_2->save();


$post_3 = new blog_post();
$post_3->set_field('name', 'Test');
$post_3->set_field('text', 'Test text');
$post_3->save();
echo $post_3->id();



// blog_topic
/*
$topic = new blog_topic(1);
echo $post_3->set_field('name');
*/