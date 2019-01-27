<?php

class shopLocation{
	protected $_id;
	protected $_name;
	protected $_address;
	protected $_distance;
	protected $_longitude;
	protected $_latitude;

	public function __construct($name, $address, $distance, $longitude, $latitude){
		$this->_name = $name;
		$this->_address = $address;
		$this->_distance = $distance;
		$this->_longitude = $longitude;
		$this->_latitude = $latitude;
	}
	public function get_id(){
		return $this->_id;
	}
	public function set_id($id){
		$this->_id = $id;
	}
	public function get_name(){
		return $this->_name;
	}
	public function set_name($name){
		$this->_name = $name;
	}
	public function get_address(){
		return $this->_address;
	}
	public function set_address($address){
		$this->_address = $address;
	}
	public function get_distance(){
		return $this->_distance;
	}
	public function set_distance($distance){
		$this->_distance = $distance;
	}
	public function get_longitude(){
		return $this->_longitude;
	}
	public function set_longitude($longitude){
		$this->_longitude = $longitude;
	}
	public function get_latitude(){
		return $this->_latitude;
	}
	public function set_latitude($latitude){
		$this->_latitude = $latitude;
	}
}

?>
