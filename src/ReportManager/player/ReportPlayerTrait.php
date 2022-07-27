<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */
declare(strict_types=1);
namespace HQGames\ReportManager\player;
use HQGames\Bridge\player\BridgePlayer;
use HQGames\Bridge\utils\BackendProperties;
use HQGames\Core\player\Player;
use HQGames\ReportManager\player\classes\Report;
use HQGames\ReportManager\player\classes\ReportHistory;
use HQGames\ReportManager\player\classes\ReportReason;
use HQGames\ReportManager\ReportManager;
use HQGames\utils\Snowflake;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;


/**
 * Trait ReportPlayerTrait
 * @package HQGames\player
 * @author Jan Sohn / xxAROX
 * @date 23. July, 2022 - 19:00
 * @ide PhpStorm
 * @project Report-Manager
 */
trait ReportPlayerTrait {
	protected ReportHistory $reportHistory;
	protected bool $report_notified = false;

	/**
	 * Function report_loadData
	 * @param array $data
	 * @return void
	 * @throws \Exception
	 */
	public function report_loadData(array $data): void{
		/** @var BridgePlayer $this */
		$this->reportHistory = ReportHistory::fromArray($data["report_history"] ?? []);
		$this->report_notified = boolval($data["report_notified"] ?? false);
	}

	#[Pure] #[ArrayShape([
		"report_history"  => "array",
		"report_notified" => "bool",
	])] public function report_saveData(): array{
		return [
			"report_history"  => $this->reportHistory->jsonSerialize(),
			"report_notified" => $this->report_notified,
		];
	}

	public function createReport(string $target_identifier, ReportReason $reason, ?string $replay_id = null, string $comment = ""): void{
		// TODO: check if player is registered
		/** @var Player $this */
		$report = new Report(
			Snowflake::generate(),
			BackendProperties::getInstance()->getIdentifier(),
			$target_identifier,
			$this->getIdentifier(),
			$reason->getReason(),
			$comment,
			time(),
			$replay_id
		);
		ReportManager::getInstance()->addReport($report);
	}
}
