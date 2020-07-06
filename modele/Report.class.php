<?php

class Report extends AbstractEntity {
	public $reporter;
	public $reported;
	public $reportMessage;



	public function __construct($reporter,$reported,$reportMessage) {
		$this->reporter = $reporter;
		$this->reported = $reported;
		$this->reportMessage = $reportMessage;
	}



	public function getReporter()
	{
		return $this->reporter;
	}

	
	public function setReporter($reporter)
	{
		$this->reporter = $reporter;

		return $this;
	}

	 
	public function getReported()
	{
		return $this->reported;
	}


	public function setReported($reported)
	{
		$this->reported = $reported;

		return $this;
	}

	public function getReportMessage()
	{
		return $this->reportMessage;
	}

	public function setReportMessage($reportMessage)
	{
		$this->reportMessage = $reportMessage;

		return $this;
	}
}

?>