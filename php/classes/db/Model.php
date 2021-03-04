<?php

namespace db;

class Model {

	private $values = [];

	public function __call($name, $args)
	{

		$method = substr($name, 0, 3);
		$fieldName = substr($name, 3, strlen($name));

		switch ($method)
		{

			case "get":
				return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;
			break;

			case "set":
				$this->values[$fieldName] = $args[0];
			break;

		}

	}

	public function setData($data = array())
	{
		$dd = $data[0];

		foreach ($dd as $key => $value) {

			$this->{"set".$key}($value);

		}

	}

	public function getValues()
	{

		return $this->values;

	}

	public function queryBuilder($campos=array()){
		$args			=	false;

		if(count($campos)>0){
			$columns	=	'';
			$values		=	'';
			$update		=	'';
			$bindArr	=	array();
			//
			// var_dump($campos);
	    // exit;

			foreach ($campos as $key => $value) {

				if($key!='' && $value!=''){
				$columns 					.= "$key,";
				$values 					.= " :$key,";
				$update						.= " $key = :$key,";
				$bindArr[":$key"]  = $value;
				}

			}

			if($columns !='' && $values !=''){
				$args['columns'] 		= substr($columns, 0, -1);
				$args['values'] 		= substr($values, 0, -1);
				$args['update']			= substr($update, 0, -1);
				$args['bindArray'] 	= $bindArr;
				return $args;
			}else{
				return false;
			}

		}else{//caso nenhum dado informado retorna falso
			return false;
		}
	}
	
}

 ?>
