<?php

namespace wulaphp\db\sql;

/**
 * delete SQL
 *
 * @author guangfeng.ning
 *
 */
class DeleteSQL extends QueryBuilder {
	use CudTrait;

	/**
	 * @param string $table
	 * @param string $alias
	 *
	 * @return \wulaphp\db\sql\DeleteSQL
	 */
	public function from($table, $alias = null) {
		$this->from [] = self::parseAs($table, $alias);

		return $this;
	}

	/**
	 * perform the delete sql, false for deleting failed.
	 * Just call count() function for short.
	 *
	 * @return int|bool
	 */
	public function count() {
		if (empty ($this->from)) {
			$this->error = 'no table specified!';

			return false;
		}
		try {
			$this->checkDialect();
		} catch (\Exception $e) {
			$this->error = $e->getMessage();

			return false;
		}
		$values    = new BindValues ();
		$from      = $this->prepareFrom($this->sanitize($this->from));
		$order     = $this->sanitize($this->order);
		$joins     = $this->prepareJoins($this->sanitize($this->joins));
		$sql       = $this->dialect->getDeleteSQL($from, $joins, $this->where, $values, $order, $this->limit);
		$this->sql = $sql;
		if ($sql) {
			try {
				$statement = $this->dialect->prepare($sql);
				foreach ($values as $value) {
					list ($name, $val, $type) = $value;
					if (!$statement->bindValue($name, $val, $type)) {
						$this->errorSQL    = $sql;
						$this->errorValues = $values->__toString();
						$this->error       = 'can not bind the value ' . $val . '[' . $type . '] to the argument:' . $name;

						return false;
					}
				}
				$rst = $statement->execute();
				$cnt = false;
				if ($rst) {
					$cnt = $statement->rowCount();
				} else {
					$this->dumpSQL($statement);
				}
				if ($statement) {
					$statement->closeCursor();
					$statement = null;
				}
				QueryBuilder::addSqlCount();

				return $cnt;
			} catch (\PDOException $e) {
				$this->exception   = $e;
				$this->error       = $e->getMessage();
				$this->errorSQL    = $sql;
				$this->errorValues = $values->__toString();

				return false;
			}
		} else {
			$this->error       = 'Can not generate the delete SQL';
			$this->errorSQL    = '';
			$this->errorValues = $values->__toString();
		}

		return false;
	}
}
