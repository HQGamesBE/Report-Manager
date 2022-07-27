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
use JetBrains\PhpStorm\Pure;


/**
 * Class ReportListSearchForm
 * @package HQGames\ReportManager\forms
 * @author Jan Sohn / xxAROX
 * @date 24. July, 2022 - 00:37
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportListSearchForm extends CustomForm{
	#[Pure]
	public function __construct(protected array $reports, string $searchType){
		parent::__construct(
			"%forms.report.title.report.list.search",
			[
				new Label("%forms.report.text.report.list.search"),
				new Input("%forms.report.input.report.list.search.search", "", ""),
				new Toggle("%forms.report.toggle.only.open", true),
			],
			function (Player $player, CustomFormResponse $response): void{

			}
		);
	}
}
