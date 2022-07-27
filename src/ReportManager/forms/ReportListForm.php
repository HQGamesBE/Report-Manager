<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\ReportManager\forms;
use HQGames\Core\forms\elements\FunctionalButton;
use HQGames\Core\forms\MenuForm;
use HQGames\Core\player\Player;
use HQGames\ReportManager\Report;


/**
 * Class ReportListForm
 * @package HQGames\ReportManager\forms
 * @author Jan Sohn / xxAROX
 * @date 24. July, 2022 - 00:24
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportListForm extends MenuForm{
	/**
	 * ReportListForm constructor.
	 * @param Report[] $reports
	 */
	public function __construct(array $reports){
		parent::__construct(
			"%forms.report.title.report.list",
			"%forms.report.text.report.list",
			array_map(function(Report $report): FunctionalButton{
				// TODO: Implement function to get IVirtualPlayer by identifier
				// TODO: Implement function to get ServerInformation by identifier
				return new FunctionalButton("{$report->getPlayerIdentifier()} on {$report->getServerIdentifier()}" . PHP_EOL . $report->getIdentifier(), function(Player $player) use ($report): void{
					$player->sendForm(new ReportForm($report, $player));
				});
			}, $reports)
		);
	}
}
