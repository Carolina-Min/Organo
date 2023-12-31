<?php
/**
 * @package   awf
 * @copyright Copyright (c)2014-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU GPL version 3 or later
 */

namespace Awf\Database\Driver;

/**
 * This file is adapted from the Joomla! Framework
 */

use Awf\Database\Driver;
use Awf\Database\Query;

class Nosql extends Driver
{

	/**
	 * The name of the database driver.
	 *
	 * @var    string
	 * @since  1.0
	 */
	public $name = 'nosql';

	/**
	 * The character(s) used to quote SQL statement names such as table names or field names,
	 * etc. The child classes should define this as necessary.  If a single character string the
	 * same character is used for both sides of the quoted name, else the first character will be
	 * used for the opening quote and the second for the closing quote.
	 *
	 * @var    string
	 * @since  1.0
	 */
	protected $nameQuote = '[]';

	/**
	 * The null or zero representation of a timestamp for the database driver.  This should be
	 * defined in child classes to hold the appropriate value for the engine.
	 *
	 * @var    string
	 * @since  1.0
	 */
	protected $nullDate = '1BC';

	/**
	 * @var    string  The minimum supported database version.
	 * @since  1.0
	 */
	protected static $dbMinimum = '12.1';

	/**
	 * Connects to the database if needed.
	 *
	 * @return  void  Returns void if the database connected successfully.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function connect()
	{
		return true;
	}

	/**
	 * Determines if the connection to the server is active.
	 *
	 * @return  boolean  True if connected to the database engine.
	 *
	 * @since   1.0
	 */
	public function connected()
	{
		return true;
	}

	/**
	 * Disconnects the database.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function disconnect()
	{
		return;
	}

	/**
	 * Drops a table from the database.
	 *
	 * @param   string  $table    The name of the database table to drop.
	 * @param   boolean $ifExists Optionally specify that the table must exist before it is dropped.
	 *
	 * @return  Driver  Returns this object to support chaining.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function dropTable($table, $ifExists = true)
	{
		return $this;
	}

	/**
	 * Method to escape a string for usage in an SQL statement.
	 *
	 * @param   string  $text  The string to be escaped.
	 * @param   boolean $extra Optional parameter to provide extra escaping.
	 *
	 * @return  string   The escaped string.
	 *
	 * @since   1.0
	 */
	public function escape($text, $extra = false)
	{
		return $extra ? "/$text//" : "-$text-";
	}

	/**
	 * Method to fetch a row from the result set cursor as an array.
	 *
	 * @param   mixed $cursor The optional result set cursor from which to fetch the row.
	 *
	 * @return  mixed  Either the next row from the result set or false if there are no more rows.
	 *
	 * @since   1.0
	 */
	protected function fetchArray($cursor = null)
	{
		return array();
	}

	/**
	 * Method to fetch a row from the result set cursor as an associative array.
	 *
	 * @param   mixed $cursor The optional result set cursor from which to fetch the row.
	 *
	 * @return  mixed  Either the next row from the result set or false if there are no more rows.
	 *
	 * @since   1.0
	 */
	protected function fetchAssoc($cursor = null)
	{
		return array();
	}

	/**
	 * Method to fetch a row from the result set cursor as an object.
	 *
	 * @param   mixed  $cursor The optional result set cursor from which to fetch the row.
	 * @param   string $class  The class name to use for the returned row object.
	 *
	 * @return  mixed   Either the next row from the result set or false if there are no more rows.
	 *
	 * @since   1.0
	 */
	protected function fetchObject($cursor = null, $class = 'stdClass')
	{
		return new $class;
	}

	/**
	 * Method to free up the memory used for the result set.
	 *
	 * @param   mixed $cursor The optional result set cursor from which to fetch the row.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	protected function freeResult($cursor = null)
	{
		return null;
	}

	/**
	 * Get the number of affected rows for the previous executed SQL statement.
	 *
	 * @return  integer  The number of affected rows.
	 *
	 * @since   1.0
	 */
	public function getAffectedRows()
	{
		return 0;
	}

	/**
	 * Method to get the database collation in use by sampling a text field of a table in the database.
	 *
	 * @return  mixed  The collation in use by the database or boolean false if not supported.
	 *
	 * @since   1.0
	 */
	public function getCollation()
	{
		return false;
	}

	/**
	 * Get the number of returned rows for the previous executed SQL statement.
	 *
	 * @param   resource $cursor An optional database cursor resource to extract the row count from.
	 *
	 * @return  integer   The number of returned rows.
	 *
	 * @since   1.0
	 */
	public function getNumRows($cursor = null)
	{
		return 0;
	}

	/**
	 * Get the current query object or a new JDatabaseQuery object.
	 *
	 * @param   boolean $new False to return the current query object, True to return a new JDatabaseQuery object.
	 *
	 * @return  Query  The current query object or a new object extending the JDatabaseQuery class.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function getQuery($new = false)
	{
		return null;
	}

	/**
	 * Retrieves field information about the given tables.
	 *
	 * @param   string  $table    The name of the database table.
	 * @param   boolean $typeOnly True (default) to only return field types.
	 *
	 * @return  array  An array of fields by table.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function getTableColumns($table, $typeOnly = true)
	{
		return array();
	}

	/**
	 * Shows the table CREATE statement that creates the given tables.
	 *
	 * @param   mixed $tables A table name or a list of table names.
	 *
	 * @return  array  A list of the create SQL for the tables.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function getTableCreate($tables)
	{
		return '';
	}

	/**
	 * Retrieves field information about the given tables.
	 *
	 * @param   mixed $tables A table name or a list of table names.
	 *
	 * @return  array  An array of keys for the table(s).
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function getTableKeys($tables)
	{
		return array();
	}

	/**
	 * Method to get an array of all tables in the database.
	 *
	 * @return  array  An array of all the tables in the database.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function getTableList()
	{
		return array();
	}

	/**
	 * Get the version of the database connector
	 *
	 * @return  string  The database connector version.
	 *
	 * @since   1.0
	 */
	public function getVersion()
	{
		return '12.1';
	}

	/**
	 * Method to get the auto-incremented value from the last INSERT statement.
	 *
	 * @return  integer  The value of the auto-increment field from the last inserted row.
	 *
	 * @since   1.0
	 */
	public function insertid()
	{
		return 0;
	}

	/**
	 * Locks a table in the database.
	 *
	 * @param   string $tableName The name of the table to unlock.
	 *
	 * @return  Driver  Returns this object to support chaining.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function lockTable($tableName)
	{
		return $this;
	}

	/**
	 * Execute the SQL statement.
	 *
	 * @return  mixed  A database cursor resource on success, boolean false on failure.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function execute()
	{
		return false;
	}

	/**
	 * Renames a table in the database.
	 *
	 * @param   string $oldTable The name of the table to be renamed
	 * @param   string $newTable The new name for the table.
	 * @param   string $backup   Table prefix
	 * @param   string $prefix   For the table - used to rename constraints in non-mysql databases
	 *
	 * @return  Driver  Returns this object to support chaining.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function renameTable($oldTable, $newTable, $backup = null, $prefix = null)
	{
		return $this;
	}

	/**
	 * Select a database for use.
	 *
	 * @param   string $database The name of the database to select for use.
	 *
	 * @return  boolean  True if the database was successfully selected.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function select($database)
	{
		return false;
	}

	/**
	 * Set the connection to use UTF-8 character encoding.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   1.0
	 */
	public function setUTF()
	{
		return false;
	}

	/**
	 * Test to see if the connector is available.
	 *
	 * @return  boolean  True on success, false otherwise.
	 *
	 * @since   1.0
	 */
	public static function isSupported()
	{
		return true;
	}

	/**
	 * Method to commit a transaction.
	 *
	 * @param   boolean $toSavepoint If true roll back to savepoint
	 *
	 * @return  void
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function transactionCommit($toSavepoint = false)
	{
	}

	/**
	 * Method to roll back a transaction.
	 *
	 * @param   boolean $toSavepoint If true roll back to savepoint
	 *
	 * @return  void
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function transactionRollback($toSavepoint = false)
	{
	}

	/**
	 * Method to initialize a transaction.
	 *
	 * @param   boolean $asSavepoint If true start as savepoint
	 *
	 * @return  void
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function transactionStart($asSavepoint = false)
	{
	}

	/**
	 * Unlocks tables in the database.
	 *
	 * @return  Driver Returns this object to support chaining.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function unlockTables()
	{
		return $this;
	}
}
