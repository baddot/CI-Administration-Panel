<?phpif (!defined('BASEPATH'))	exit('No direct script access allowed');class admin_model extends CI_Model {	function __construct() {		parent::__construct();	}	function getFolder($id) {		$this -> db -> select('folder');		$this -> db -> where('id', $id);		$this -> db -> from('subcategorias');		$this -> db -> limit('1');		$query = $this -> db -> get();		return $query -> row();	}	function get($table = null) {		$query = $this -> db -> get($table);		return $query -> result();	}	function get_one($table = null, $where = null) {		if ($where) { $this -> db -> where($where);		}		$query = $this -> db -> get($table);		return $query -> row();	}	function get_orderby($table = NULL, $orderby = NULL, $where = NULL) {		if ($where) { $this -> db -> where($where);		}		$this -> db -> order_by($orderby);		$query = $this -> db -> get($table);		return $query -> result();	}	function get_content() {		$query = $this -> db -> get_where('content', array('id' => "1"), 1);		return $query -> row();	}	function get_video($id) {		$query = $this -> db -> get_where('videos', array('id' => $id), 1);		return $query -> row();	}	function update_section($id) {		$data = array('name' => $this -> input -> post('title'), 'link' => $this -> input -> post('link'), 'date' => $this -> input -> post('date'), 'description' => $this -> input -> post('description'), 'doc' => $this -> input -> post('doc'), 'img' => $this -> input -> post('img'));		$this -> db -> where('id', $id);		$query = $this -> db -> update('press', $data);		return $query;	}	function update_order($id, $weight) {				$data = array('weight' => $weight);		$this -> db -> where('id', $id);		$query = $this -> db -> update('gallery_photos', $data);				return $query;	}	function update_slider_order($id, $weight) {		$data = array('weight' => $weight);		$this -> db -> where('id', $id);		$query = $this -> db -> update('images', $data);		return $query;	}	function update_status($id, $weight) {		$data = array('weight' => $weight, 'active' => '1');		$this -> db -> where('id', $id);		$query = $this -> db -> update('logos', $data);		return $query;	}	function update_content($id) {		$data = array('content' => $this -> input -> post('content'), 'photo' => $this -> input -> post('photo'));		$this -> db -> where('version', "1");		$query = $this -> db -> update('profile', $data);		return $query;	}	function update_names($id) {		$data = array('name' => $this -> input -> post('name'));		$this -> db -> where('id', $id);		$query = $this -> db -> update('gallery_cat_secondary', $data);		return $query;	}		function update_namea($id) {		$data = array('name' => $this -> input -> post('name'));		$this -> db -> where('id', $id);		$query = $this -> db -> update('gallery_cat_primary', $data);		return $query;	}	function update_pid_front() {		$data = array('front' => $this -> input -> post('photo_id'));		$this -> db -> where('id', $this -> input -> post('pid'));		$query = $this -> db -> update('gallery_cat_primary', $data);		return $query;	}	function create_profile() {		$data = array('firstName' => $this -> input -> post('name'), 'lastName' => $this -> input -> post('lastname'), 'password' => md5($this -> input -> post('password')), 'email' => $this -> input -> post('email'));		$this -> db -> insert('admin_users', $data);	}	function create_section() {		$data = array('date' => $this -> input -> post('date'), 'name' => $this -> input -> post('name'), 'description' => $this -> input -> post('description'), 'article' => $this -> input -> post('article'), 'doc' => $this -> input -> post('doc'), 'img' => $this -> input -> post('img'));		$this -> db -> insert('press', $data);	}	function add_new() {				$data = array(					'pid' => $this -> input -> post('addpid'),					'name' => $this -> input -> post('addname')				);						$result = $this -> db -> insert('gallery_cat_secondary', $data);		return $result;	}		function find_tag($vid, $tid) {		$this -> db -> where('tid', $tid);		$this -> db -> where('vid', $vid);		$this -> db -> from('tags_rel');		return $this -> db -> count_all_results();	}	function delete($table, $record) {		$query = $this -> db -> delete($table, array('id' => $record));		return $query;	}	function delete_filter($id) {		$query = $this -> db -> delete('tags', array('id' => $id));		return $query;	}	function delete_admin_users($id) {		$query = $this -> db -> delete('profiles', array('id' => $id));		return $query;	}	function insert_logo($fpath, $fname) {		$data = array('path' => $fpath, 'name' => $fname);		$this -> db -> insert('logos', $data);	}	function insert_image($a, $b) {		$data = array('name' => $a, 'sid' => $b);		$this -> db -> insert('gallery_photos', $data);	}	function get_email($email = "") {		$this -> db -> select('*');		$this -> db -> where('email', $email);		$this -> db -> limit(1);		$query = $this -> db -> get('admin_users');		//return $query->row();		if ($query -> num_rows() == 1)			return $query -> row();		return NULL;	}}