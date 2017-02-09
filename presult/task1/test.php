<?php

require_once "DbSimple/Generic.php";

interface i_model {

    public function __construct($id = null);

    public function set_field($field, $value);

    public function get_field($field);

    public function save();

    public function delete();

    public function id();
}

abstract class model implements i_model {
    
    private $id;
    private $date;
    private $name = '';
    private $text = '';
    private $db;

    public function __construct($id = null) {
        $this->db = DbSimple_Generic::connect("mysql://root:password@localhost/task1");
    }

    public function set_field($field, $value) {
        switch ($field) {
            case 'name':
                $this->name = $value;
                break;
            case 'date':
                $this->date = $value;
                break;
            case 'text':
                $this->text = $value;
                break;
            case 'id':
                $this->id = $value;
                break;
        }
    }

    public function get_field($field) {
        $get_query = '';
        switch ($field) {
            case 'name':
                $get_query = 'SELECT name FROM ' . get_class($this);
                break;
            case 'date':
                $get_query = 'SELECT date FROM ' . get_class($this);
                break;
            case 'text':
                $get_query = 'SELECT text FROM ' . get_class($this);
                break;
            case 'id':
                $get_query = 'SELECT id FROM ' . get_class($this);
                break;
        }

        $result = $this->db->select($get_query);
        $response = '';

        foreach ($result as $res) {
            $response .= $res[$field] . '//';
        }
        return $response;
    }

    public function save() {
        $date = new DateTime();
        $this->date = $date->format('Y-m-d');

        $save_query = 'INSERT INTO ' . get_class($this) . ' (date, name, text) VALUES ('
                . "'" . $this->date . "'" . ',' . "'" . $this->name . "'" . ',' . "'" . $this->text . "'" . ')';
        $res = $this->db->query($save_query);
    }

    public function delete() {
        $del_query = 'DELETE FROM ' . get_class($this) . ' ORDER BY id DESC limit 1';
        $this->db->query($del_query);
    }

    public function id() {
        $this->get_field('id');
    }
}

class blog_post extends model {


}

$post_1 = new blog_post();
$post_2 = new blog_post();

echo $post_1->get_field('date');
echo '<br>';
echo $post_1->get_field('text');
echo '<br>';

$post_1->delete();

$post_2->set_field('name', 'Name 2');
$post_2->set_field('text', 'Text 2');
$post_2->save();

$post_3 = new blog_post();
$post_3->set_field('name', 'Name 3');
$post_3->set_field('text', 'Text 3');

$post_3->save();

$post_3->delete();

echo '<br>';
echo $post_3->id();
echo '<br>';


// blog_topic
class blog_topic extends model{
    
}

$topic = new blog_topic();
$topic->set_field('name', 'topic name');
$topic->save();
