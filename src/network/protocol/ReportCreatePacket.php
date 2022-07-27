<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */
declare(strict_types=1);
namespace HQGames\network\protocol;
use HQGames\network\CloudPacket;
use HQGames\network\IPacketHandler;
use HQGames\network\IReportPacketHandler;
use HQGames\ReportManager\player\classes\Report;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;


/**
 * Class ReportCreatePacket
 * @package HQGames\network\protocol
 * @author Jan Sohn / xxAROX
 * @date 23. July, 2022 - 20:20
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportCreatePacket extends CloudPacket{
	public Report $report;

	/**
	 * Function build
	 * @param Report $report
	 * @return static
	 * @generate-build-method
	 */
	#[Pure] static function build(Report $report): self{
		$self = new self;
		$self->report = $report;
		return $self;
	}

	public static function getPacketType(): string{
		return "ReportCreate";
	}

	#[Pure]
	#[ArrayShape([ "report" => "array" ])]
	public function encode(): array{
		return [
			"report" => $this->report->jsonSerialize(),
		];
	}

	public function decode(array $data): void{
		parent::decode($data);
		$this->report = Report::fromArray($data["report"]);
	}

	/**
	 * Function handle
	 * @param IReportPacketHandler $handler
	 * @return void
	 */
	public function handle(IPacketHandler $handler): void{
		if ($handler instanceof IReportPacketHandler) $handler->handleReportCreatePacket($this);
	}
}
