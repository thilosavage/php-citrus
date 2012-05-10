<?php
/**
 * Database methods are abstracted on the off-chance
 * that anyone would ever use something other than MySQL
 * The mysql driver is /seeds/php/mysql.php
 */
abstract class Model {

	protected $id;
	protected $table;
	protected $name_field;
	protected $id_field;
	protected $db;
	
	/////////// $values ///////////
	// an array of field specifiers for a query
	// it can either be associative or a numeric array
	// numeric arrays will assume the field is the $id_field
	
	// example -- will load rows 1, 3, and 7 of $id_field
		// $exampleObj = new Example;
		// $exampleObj->values = array(1, 3, 7);
		// $exampleObj->load();
	
	// or with associative array
	
		// example -- will load rows where name field is bob
		// $exampleObj = new Example;
		// $exampleObj->values = array('name'=>'bob');
		// $exampleObj->load();	
	var $values = '';
	
	/////////// $field  ///////////
	// a custom id field
	// example -- will load rows where name is bob, tim, and john
		// $exampleObj = new Example;
		// $exampleObj->field = 'name';
		// $exampleObj->values = array('bob', 'tim', john');
		// $exampleObj->load();
	
	// it will also work with saving
	// this would typically insert a new row
		// $exampleObj = new Example;
		// $exampleObj->set['name'] = 'bob';
		// $exampleObj->save();
	
	// but this will update where name field is 'bob'
		// $exampleObj = new Example;
		// $exampleObj->field = 'name';
		// $exampleObj->set['name'] = 'bob';
		// $exampleObj->save();
	var $field = '';
	
	/////////// $logic ///////////
	// specify AND or OR with multiple specifiers
		// $exampleObj = new Example;
		// $exampleObj->logic = 'AND';
		// $exampleObj->values = array('first_name'=>'bob','last_name'=>'smith');
		// $exampleobj->load();
	// loads all rows where first name is bob AND last name is smith
	var $logic = 'OR';
	
	///////// $limit /////////////
	// limit the number of rows loaded
	var $limit = '';
	
	///////// $order_by /////////////	
	// specify the field to be sorted by
		// $exampleObj = new Example;
		// $exampleObj->order_by = 'name DESC';
		// $exampleObj->values = array('name'=>'bob','name'=>'jim');
		// $exampleobj->load();
	var $order_by = '';
	
	///////// $use_id_values /////////////
	// the array of rows ($modelObj->rows) is a numeric array
	// the keys can either start at 0 and go up by 1
	// or the key can be the id value
	// both are handy in different situations
	
		// $exampleObj = new Example;
		// $exampleObj->use_id_values = true;
		// $exampleObj->values = array(1,3,7);
		// $exampleobj->load();	
			// will return:
			// array (
			//   [1] => array( data from row 1)
			//	[3] => array( data from row 3)
			//	[7] => array( data from row 7)
			//  )
	
	
		// $exampleObj = new Example;
		// $exampleObj->use_id_values = false;
		// $exampleObj->values = array(1,3,7);
		// $exampleobj->load();	
			// will return:
			// array (
			//   [0] => array( data from row 1)
			//	[1] => array( data from row 3)
			//	[2] => array( data from row 7)
			//  )	
	
	// it is default to true
	var $use_id_values = true;
	
	// set values to be saved/updated
	public $set = array();
	
	// an array of the loaded rows
	public $rows = array();
	
	// an array of a single row
	// if multiple rows have been loaded, $row will be the last
	public $row = array();
	
	// the last query ran by the object
	// this is most useful in debugging
	public $query = '';
	
	
	// for quickness, you can load data upon construction of the Model object
		// example -- load rows 5, 7, 8
		// $exampleObj = new Example(5, 7, 8);
	// you can also specify the id field 
		// example -- load rows where name is bob or jim
		// $exampleObj = new Example(array('bob,'jim'),'name');	
	function __construct($values='', $id_field = ''){
	
		eval("\$this->db = ".CR_DATABASE."::db();");
	
		if ($values!==''){

			if ($values == 'all') {
				$this->values = array($this->id_field.'>'=>'0');
			}
			else if (is_array($values)){
				$this->values = $values;
			}
			else {
				$args = func_get_args();
				foreach ($args as $arg){
					$vals[] = $arg;
				}
				$this->values = $vals;
			}
			if ($id_field) {
				$this->field = $id_field;
			}
			
			$this->load();
		}
	}
	
	// load data from table into the object
	// example
		// $exampleObj = new Example;
		// $exampleObj->values = array(1,3,7);
		// $exampleobj->load();
	// or you can pass the values into the method
	// example
		// $exampleObj = new Example;
		// $exampleobj->load(array(1,3,7));		
	function load($values = ''){
	
		if ($values)
		{
			if ($values == 'all') 
			{
				$this->values = array($this->id_field.'>'=>'0');		
			}
			else if (is_array($values))
			{
				$this->values = $values;
			}
			else
			{
				$args = func_get_args();
				foreach ($args as $arg)
				{
					$args[] = $arg;
				}
				$this->values = $args;			
			}
			$query = $this->_build();
			$this->query = $query;
		}
		else if ($this->values)
		{
			$query = $this->_build();
			$this->query = $query;
		}
		else
		{
			$query = $this->query;
		}
		
		
		if ($query)
		{	
			$q = $this->db->query($query);
			
			while ($row = mysql_fetch_assoc($q))
			{	
				$row_id = $row[$this->id_field];

				if ($this->use_id_values)
					$this->rows[$row_id] = $this->rowHandler($row);
				else 
					$this->rows[] = $this->rowHandler($row);
				
				$this->row = $this->rowHandler($row);
			}
		}
	}

	// custom query
	// example
		// $name = 'bob';
		// $exampleObj = new Example;
		// $example->custom('SELECT * FROM `people` WHERE `name` = %s', $bob);
	function custom($query)
	{	
		$args = func_get_args();
		if (count($args) > 1)
		{
			unset($args[0]);
			$sprintfStr = '$escapedQuery = sprintf("'.$query.'", ';
			$i = 1;
			foreach ($args as $arg)
			{		
				if (count($args) !== $i)
					$sprintfStr .= $arg.', ';
				else
					$sprintfStr .= $arg.');';
					
				$i++;
			}
			eval($sprintfStr);
			$this->query = $escapedQuery;
		}
		else
		{
			//$q = $this->db->query($query);
			$this->query = $query;
		}
		
		$this->load();
	}
	
	
	/**
	 *	Save data to the table
	 *	For both inserting and updating
	 *	if the id field is set, it will update. if not, it will insert
	 *
	 *	@arg		array		Data to populate
	 *	@return	int		Insert ID	 
	 *
	 *	example -- this will update
			$exampleObj = new Example;
			$exampleObj->set['id'] = 3;
			$exampleObj->set['name'] = 'bob';
			$exampleObj->save();
		
	 *	example -- this will insert
			$exampleObj = new Example;
			$exampleObj->set['id'] = 3;
			$exampleObj->save();		
		
	 *	example -- this will also update
			$exampleObj = new Example;
			$exampleObj->field = 'name';
			$exampleObj->set['name'] = 'tom';
			$exampleObj->set['something'] = 'blah';
			$exampleObj->save();
	
	 *	you can save quick by passing the data array as an argument
	 *	example -- inserts a new row with name as bob	
			$exampleObj = new Example;
			$exampleObj->save('name'=>'bob');
	*/
	function save($set=null)
	{

		if ($set)
		{
			if (is_array($set))
				$this->set = $set;
			else 
				$this->set[$this->id_field] = $set;
		}
		
		$id_field = $this->field?$this->field:$this->id_field;
		
		if (!empty($this->set[$id_field]))
		{
			$this->_update();
			return $this->set[$this->id_field];
		}
		else
		{
			$this->_insert();
			return $this->db->insert_id();
		}
	}
	

	/**
	 *	Delete a row from table
	 *
	 *	@arg 	int	Row ID to delete
	 *
	 *
	 * example -- delete row where id field is 7
			$exampleObj = new Example;
			$exampelObj->delete(7);
	 *	example -- delete row where name is bob
			$exampleObj = new Example;
			$exampleObj->field = 'name';
			$exampleObj->delete('bob');
	 */
	function delete($value='')
	{	
		$id_field = $this->field?$this->field:$this->id_field;
		$value = $value?$value:$this->set[$id_field];
		$q = sprintf('DELETE FROM '.$this->_esc($this->table).' WHERE `'.$this->_esc($id_field).'`=%s',$this->_esc($value));
		$this->db->query($q);
	}
		
	/**
	 * Get table fields
	 *	@return	array		Table fields
	 */
	function getFields()
	{
		return $this->db->get_fields();
	}

	/**
 	 *	Load the entire table
 	 *	@return	array		Table data
	 */
	function getAll()
	{
		$this->values = array($this->id_field.'>'=>'0');
		$this->load();
		return $this->row;
	}
		
	/**
	 * Load a row
	 *
	 *	@arg		int		Row ID
	 *	@return	array		Row data
	 */
	function scaffoldInfo($id)
	{
		$this->load($id);
		return $this->row;
	}

	// truncate a table
	function truncate()
	{
		$this->db->truncate();
	}
	
	// to be extended as a pre-processor for row handling
	// all rows loaded from table will be ran through this
	function rowHandler($row)
	{
		return $row;
	}
	
	// clear the object
	function clear()
	{
		$this->row = null;
		$this->rows = array();
		$this->query = '';
		$this->values = null;
		$this->set = null;
	}
	
	
/**
 * Build query
 *
 *	@return resource	SQL query
 */
	function _build()
	{
		$qe = '';
		if (!$this->logic && is_array($this->values))
		{
			$this->logic = 'OR';
			while (list($fieldName,$fieldValue) = each($this->values))
			{
				if (!is_numeric($fieldName))
					$this->logic = 'AND';

				$oldField = $fieldName;
			}
		}
		$defaultField = $this->field ? $this->field : $this->id_field;
		if (is_array($this->values))
		{
			$coun = count($this->values) - 1;
			foreach ($this->values as $key => $value)
			{
				$field = $this->_esc(!is_numeric($key)?$key:$defaultField);
				$qe .= $this->_esc($field)."='".$this->_esc($value)."'";
				
				if ($coun>0) 
					$qe .= ' '.$this->_esc($this->logic).' ';

				$coun = $coun - 1;
			}
			$q = "SELECT * FROM `".$this->_esc($this->table)."` WHERE ".$qe;
		}
		else
		{
			$value = $this->_esc($this->values);
			$field = $this->_esc($defaultField);
			$q = "SELECT * FROM `".$this->table."` WHERE ".$defaultField." = ".$value;
		}
		if ($this->order_by)
			$q .= ' ORDER BY '.$this->_esc($this->order_by);
		
		if ($this->limit)
			$q .= ' LIMIT '.$this->limit;
		
		$this->query = $q;

		return $q;
	}		
	
	// inserts row into database
	function _insert()
	{	
		$insert = 'INSERT INTO `'.$this->_esc($this->table).'` SET '.$this->_fields();
		$this->db->query($insert);
		$this->query = $insert;
	}
	
	// updates row in database
	function _update()
	{	
		$update = 'UPDATE `'.$this->table.'` SET '.$this->_fields();
		$update .= sprintf(' WHERE '.$this->_esc($this->id_field).'=%s', $this->_esc($this->set[$this->id_field]));
		$this->db->query($update);
		$this->query = $update;
	}
	
	/**
	 * Generate field string
	 *
	 *	@return string	SQL fields and values
	 */
	function _fields()
	{
		$fields = '';
		while (list ($fieldName, $fieldValue) = each($this->set))
		{
			if (!is_numeric($fieldName))
			{
				if (!strcmp($fieldName, $this->id_field))
					continue;
				if (!empty($fields)) 
					$fields .= ', ';
				
				$fields .= sprintf('`'.$this->_esc($fieldName).'`=\'%s\'', $this->_esc($fieldValue));
			}
		}
		return $fields;
	}
	
	// escape strings
	function _esc($val)
	{
		return $this->db->escape($val);
	}	
}

// End of File
// core/Model.php