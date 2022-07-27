<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\ReportManager\player\classes;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;


/**
 * Class ReportHistory
 * @package HQGames\ReportManager\player\classes
 * @author Jan Sohn / xxAROX
 * @date 23. July, 2022 - 19:31
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportHistory implements JsonSerializable{
	/** @var Report[] */
	protected array $reports = [];

	/**
	 * Function add
	 * @param Report $report
	 * @return void
	 */
	public function add(Report $report): void{
		$this->reports[$report->getIdentifier()] = $report;
	}

	/**
	 * Function remove
	 * @param Report $report
	 * @return void
	 */
	public function remove(Report $report): void{
		unset($this->reports[$report->getIdentifier()]);
	}

	/**
	 * Function clear
	 * @return void
	 */
	public function clear(): void{
		unset($this->reports);
		$this->reports = [];
	}

	/**
	 * Function get
	 * @param int $identifier
	 * @return null|Report
	 */
	public function get(int $identifier): ?Report{
		return $this->reports[$identifier] ?? null;
	}

	/**
	 * Function getReports
	 * @return array
	 */
	public function getReports(): array{
		return $this->reports;
	}

	/**
	 * Function jsonSerialize
	 * @return array
	 */
	#[Pure] public function jsonSerialize(): array{
		$array = [];
		foreach ($this->reports as $report) $array[$report->getIdentifier()] = $report->jsonSerialize();
		return $array;
	}

	/**
	 * Function fromArray
	 * @param array $array
	 * @return ReportHistory
	 * @throws \Exception
	 */
	public static function fromArray(array $array): ReportHistory{
		$history = new ReportHistory();
		foreach ($array as $identifier => $data) $history->add(Report::fromArray($data));
		return $history;
	}
}
