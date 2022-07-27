<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\ReportManager\forms;
use HQGames\Core\forms\CustomForm;
use HQGames\Core\forms\CustomFormResponse;
use HQGames\Core\forms\elements\Input;
use HQGames\Core\forms\elements\Label;
use HQGames\Core\forms\elements\Toggle;
use HQGames\Core\player\Player;
use HQGames\ReportManager\Report;
use JetBrains\PhpStorm\Pure;


/**
 * Class ReportListSearchAnswerForm
 * @package HQGames\ReportManager\forms
 * @author Jan Sohn / xxAROX
 * @date 24. July, 2022 - 00:42
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportListSearchAnswerForm extends CustomForm{
	#[Pure]
	public function __construct(protected array $reports){
		parent::__construct(
			"%forms.report.title.report.list.search",
			[
				new Label("%forms.report.text.report.list.search"),
				new Input("%forms.report.input.report.list.search.search", "", ""),
				new Toggle("%forms.report.toggle.only.open", true),
			],
			function (Player $player, CustomFormResponse $response): void{
				$query = $response->getInput()->getValue();
				$onlyOpen = $response->getToggle()->getValue();
				$reports = $this->reports;
				if ($onlyOpen) $reports = array_filter($reports, fn (Report $report) => $report->isSolved());
				$reports = array_filter($reports, fn (Report $report) =>
					stripos($report->getServerIdentifier(), $query) !== false
					|| stripos($report->getIdentifier(), $query) !== false
					|| stripos($report->getReason(), $query) !== false
					|| stripos($report->getReplayId(), $query) !== false
					|| stripos($report->getCreatorIdentifier(), $query) !== false
				);
				$player->sendForm(new ReportListForm($reports));
			}
		);
	}
}
