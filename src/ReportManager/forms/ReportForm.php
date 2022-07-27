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
use HQGames\ReportManager\ReportManager;


/**
 * Class ReportForm
 * @package HQGames\ReportManager\forms
 * @author Jan Sohn / xxAROX
 * @date 23. July, 2022 - 19:27
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportForm extends MenuForm{
	public function __construct(protected Report $report, protected Player $player){
		$buttons = [
			new FunctionalButton("%forms.report.button.report.close", function(Player $player): void{
				ReportManager::getInstance()->solveReport($this->report);
				$player->sendForm(new ReportManagerForm());
			}),
		];
		if ($this->player->hasPermission("hqgames.report.delete")) {
			$buttons[] = new FunctionalButton("%forms.report.button.report.delete", function(Player $player): void{
				ReportManager::getInstance()->deleteReport($this->report);
				$player->sendForm(new ReportManagerForm());
			});
		}
		parent::__construct(
			"%forms.report.title.report",
			"%forms.report.text.report",
			$buttons
		);
	}
}
