<?php
	namespace alesinicio;
	
	/**
	 * PHP Array to HTML table.
	 * Provides a simple but powerful way to create and format HTML tables based on native PHP arrays.
	 * 
	 * @author alesinicio
	 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License, version 3
	 * @package alesinicio\
	 * @version 1.0
	 * @link https://www.facebook.com/alesinicio
	 */
	class HTMLTable {
		private $createTableTag		= true;
		private $headers			= array();
		private $data				= array();
		private $tblID				= '';
		private $tblClass			= '';
		private $hidecolumns		= array();
		private $tdClasses			= array();
		private $trClassFunction	= null;
		private $trIDFunction		= null;
		private $tdClassFunction	= null;
		private $customArgs			= array();

		/**
		 * Whether the getHTML() method should create <table></table> or not.
		 * @param boolean $bool
		 */
		public function createTableTag($bool=true) {
			$this->createTableTag = $bool;
		}
		/**
		 * Sets the table ID.
		 * @param string $strTableID
		 */
		public function setTableID($strTableID=null) {
			$this->tblID=$strTableID;
		}
		/**
		 * Mixed input with all the classes to be applied to the <table> tag.
		 * @param string $mixed
		 */
		public function setTableClasses($mixed=null) {
			if ($mixed === null) return;
			$strClasses	= '';
				
			foreach(func_get_args() as $class) {
				$strClasses .= $class.' ';
			}

			$strClasses		= rtrim($strClasses);
			$this->tblClass = $strClasses;
		}
		/**
		 * Defines the headers (<thead>) of the table.
		 * @param arr $arrHeaders
		 */
		public function setHeaders($arrHeaders=array()) {
			$this->headers = $arrHeaders;
		}
		/**
		 * Sets the data to be populated. Use an aligned array of arrays (eg. [[1,2,3][4,5,6][7,8,9]]).
		 * @param array $arrData
		 */
		public function setData($arrData=array(array())) {
			$this->data = $arrData;
		}
		/**
		 * Defines the classes each column/td/th should have. For multiple classes, just separate with spaces.
		 * This method will be overriden if the setTdClassFunction() method is used.
		 * @param array $arrTDClasses
		 */
		public function setTdClasses($arrTDClasses) {
			$this->tdClasses = $arrTDClasses;
		}
		/**
		 * Defines a function that will determine the class of each <td> tag.
		 * The function must return a string with the class names. It receives a single parameter, which is the value of that cell.
		 * Overrides the classes defined by the setTdClasses() method.
		 * @param function $function
		 */
		public function setTdClassFunction($function) {
			$this->tdClassFunction = $function;
		}
		/**
		 * Defines a function that will determine classes to be applied on each <tr> tag.
		 * The function must return a string with the class names. It receives a single parameter, which is the data of that row.
		 * The row itself is a single array, and each position of the array represents a column of the table.
		 * @param function $function
		 */
		public function setTrClassFunction($function) {
			$this->trClassFunction = $function;
		}
		/**
		 * Defines a function that will determine the ID of each <tr> tag.
		 * The function must return a string with the class names. It receives a single parameter, which is the data of that row.
		 * The row itself is a single array, and each position of the array represents a column of the table.
		 * @param function $function
		 */
		public function setTrIDFunction($function) {
			$this->trIDFunction = $function;
		}
		/**
		 * Do not output a specific column. Uses a zero-based index.
		 * Can be called multiple times to hide multiple columns.
		 * @param int $columnIndex
		 */
		public function hideColumn($columnIndex) {
			$this->hidecolumns[] = $columnIndex;
		}
		/**
		 * Gets string with the whole table, as configured.
		 * @return string
		 */
		public function getHTML() {
			$this->checkForEnoughTDClasses();
				
			$tblHeaders = $this->getHeadersHTML();
			$tblData	= $this->getDataHTML();
			$customArgs = $this->getCustomArgs();
			$tableClass	= ($this->tblClass == null 	? '' : " class='".$this->tblClass."'");
			$tableID	= ($this->tblID == null 	? '' : " id='".$this->tblID."'");
				
			$output =
				($this->createTableTag 		? '<table'.$tableClass.$tableID.$customArgs.'>'	: '').
											  '<thead>'.
				($this->headers != array()	? '<tr>'.$tblHeaders.'</tr>'					: '').
											  '</thead>'.
											  '<tbody>'.$tblData.'</tbody>'.
				($this->createTableTag		? '</table>' 									: '');
				
			return $output;
		}

		/**
		 * Determines the class to be applied to the <tr> tag based on a function configured by the setTrClassFunction() method.
		 * If no functions are configured, returns `null`.
		 * @param array $row
		 * @return NULL|string
		 */
		private function getTrClassFunction($row) {
			if ($this->trClassFunction === null) return null;
		
			$function = $this->trClassFunction;
			return $function($row);
		}
		/**
		 * Determines the class to be applied to the <td> tag based on a function configured by the setTdClassFunction() method.
		 * If no functions are configured, returns `null`.
		 * @param array $row
		 * @return NULL|string
		 */
		private function getTdClassFunction($data) {
			if ($this->tdClassFunction === null) return null;
		
			$function = $this->tdClassFunction;
			return $function($data);
		}
		/**
		 * Determines the ID to be applied to the <tr> tag based on a function configured by the setTrIDFunction() method.
		 * If no functions are configured, returns `null`.
		 * @param array $row
		 * @return NULL|string
		 */
		private function getTrID($row) {
			if ($this->trIDFunction == null) return null;
			$condition = $this->trIDFunction;
			return " id='".$condition($row)."'";
		}
		/**
		 * If TD classes are to be used, there should be enough classes to match the amount of columns.
		 * It is OK to have more classes defined, but to be on the safe side, an Exception is thrown if there are fewer classes than headers/data.
		 * @throws \Exception
		 */
		private function checkForEnoughTDClasses() {
			$tdCount		= count($this->tdClasses);
			$headerCount 	= count($this->headers);
			$dataCount		= (isset($this->data[0]) ? count($this->data[0]) : false);
		
			if (($tdCount > 0) && ($tdCount < max($headerCount, $dataCount))) {
				throw new \Exception('Not enough td classes defined');
			}
		}
		/**
		 * Gets string with the table headers. Returns `null` if headers are undefined.
		 * @return NULL|string
		 */
		private function getHeadersHTML() {
			if ($this->headers == array()) return null;
				
			$tblHeaders		= '';
			$hasTdClasses	= ($this->tdClasses != array());
				
			for($i=0; $i<count($this->headers); $i++) {
				if (in_array($i, $this->hidecolumns)) continue;
		
				$class		 = ($hasTdClasses ? " class='".$this->tdClasses[$i]."'" : '');
				$tblHeaders .= '<th'.$class.'>'.$this->headers[$i];'</th>';
			}
			return $tblHeaders;
		}
		/**
		 * Gets string with custom args/parameters defined for insertion on the <table> tag.
		 * @return string
		 */
		private function getCustomArgs() {
			$args = '';
			foreach($this->customArgs as $key=>$arg) {
				$args .= $key.'='.$arg.' ';
			}
			$args = rtrim($args);
			return $args;
		}
		/**
		 * Gets the defined data array.
		 * @return array
		 */
		private function getData() {
			return $this->data;
		}
		/**
		 * Gets string with classes of that specific <tr> tag.
		 * @param array $row
		 * @param integer $index
		 * @return string
		 */
		private function getRowClass($row, $index) {
			$trClass = " class='";
			if ($this->trClassFunction !== array()) {
				$trClass .= $this->getTrClassFunction($row). ' ';
			}
			$trClass = rtrim($trClass)."'";
			$trClass = str_replace(" class=''", '', $trClass);
			return $trClass;
		}
		/**
		 * Gets string with the whole <tbody> data.
		 * @return string
		 */
		private function getDataHTML() {
			$data		= $this->getData();
		
			$tblData 	= '';
			foreach($data as $index=>$row) {
				$keys		= array_keys($row);
				$trClass	= $this->getRowClass($row, $index);
				$rowData	= $this->getRowData($row, $keys);
				$trID		= $this->getTrID($row);
		
				$tblData	.= '<tr'.$trClass.$trID.'>'.$rowData.'</tr>';
			}
		
			return $tblData;
		}
		/**
		 * Gets string with the classes for that specific column.
		 * @param integer $index
		 * @return NULL|string
		 */
		private function getColumnClass($index, $data) {
			if ($this->tdClasses === array() && $this->tdClassFunction === null) return null;
				
			$class = ($this->tdClassFunction === null ? $this->tdClasses[$index] : $this->getTdClassFunction($data));
			$class = " class='$class'";
			return $class;
		}
		/**
		 * Gets string with the data for that specific <tr> tag.
		 * @param array $row
		 * @param array $keys
		 * @return string
		 */
		private function getRowData($row, $keys) {
			$rowData = '';
			for($i=0; $i<count($row); $i++) {
				if (in_array($i, $this->hidecolumns)) continue;
				$rowData .= $this->getTdData($row, $i, $keys);
			}
		
			return $rowData;
		}
		/**
		 * Gets string with the data for that specific <td> tag.
		 * @param array $row
		 * @param integer $index
		 * @param array $keys
		 * @return string
		 */
		private function getTdData($row, $index, $keys) {
			$dataTD		= $keys[$index];
			$val		= $row[$dataTD];
			$class 		= $this->getColumnClass($index, $val);
			$rowData 	= '<td'.$class.'>'.$val.'</td>';
		
			return $rowData;
		}
	}