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
use HQGames\ReportManager\ReportManager;


/**
 * Class ReportManagerForm
 * @package HQGames\ReportManager\forms
 * @author Jan Sohn / xxAROX
 * @date 24. July, 2022 - 00:20
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportManagerForm extends MenuForm{
	public function __construct(){
		parent::__construct(
			"%forms.report.title.reportmanager",
			"%report.forms.text.reportmanager",
			[
				new FunctionalButton("%forms.report.button.list.open", function(Player $player): void{
					$player->sendForm(new ReportListForm(ReportManager::getInstance()->getOpenReports()));
				}),
				new FunctionalButton("%forms.report.button.list.search.player", function(Player $player): void{
					$player->sendForm(new ReportListSearchForm($reports, "player"));
				}),
			]
		);
	}
}
