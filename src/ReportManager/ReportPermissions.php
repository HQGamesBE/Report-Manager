<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\ReportManager;
use HQGames\Permissions;


/**
 * Class ReportPermissions
 * @package HQGames\ReportManager
 * @author Jan Sohn / xxAROX
 * @date 27. July, 2022 - 17:24
 * @ide PhpStorm
 * @project Report-Manager
 */
class ReportPermissions extends Permissions{
	const REPORT_CREATE = ["hqgames.report.create", "Allows to create reports"];
	const REPORT_CREATE_LIMITLESS = ["hqgames.report.create.limitless", "Allows to create reports without time limit"];
	const REPORT_SOLVE = ["hqgames.report.solve", "Allows to solve reports of other players"];
	const REPORT_DELETE = ["hqgames.report.delete", "Allows to delete reports"];
	const REPORT_HISTORY_VIEW = ["hqgames.report.history.view", "Allows to view the report history of a player"];
	const REPORT_HISTORY_MODIFY = ["hqgames.report.history.modify", "Allows to modify the report history of a player"];
}
