<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\ReportManager\player\classes;
/**
 * Class ReportReason
 * @package HQGames\ReportManager\player\classes
 * @author Jan Sohn / xxAROX
 * @date 23. July, 2022 - 19:04
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportReason{
	const PRIORITY_LOW = "%report.priority.low";
	const PRIORITY_MEDIUM = "%report.priority.medium";
	const PRIORITY_HIGH = "%report.priority.high";
	const PRIORITY_CRITICAL = "%report.priority.critical";

	/**
	 * ReportReason constructor.
	 * @param int $id
	 * @param string $reason
	 * @param ReportPriority $priority
	 */
	public function __construct(protected int $id, protected string $reason, protected ReportPriority $priority){
	}

	/**
	 * Function getId
	 * @return int
	 */
	public function getId(): int{
		return $this->id;
	}

	/**
	 * Function getReason
	 * @return string
	 */
	public function getReason(): string{
		return $this->reason;
	}

	/**
	 * Function getPriority
	 * @return ReportPriority
	 */
	public function getPriority(): ReportPriority{
		return $this->priority;
	}

	public function __toString(): string{
		// TODO: Implement __toString() method.
	}
}
