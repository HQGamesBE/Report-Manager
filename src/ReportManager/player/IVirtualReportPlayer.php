<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */

declare(strict_types=1);
namespace HQGames\ReportManager\player;


use HQGames\ReportManager\player\classes\ReportHistory;


/**
 * Interface IVirtualReportPlayer
 * @package HQGames\ReportManager\player
 * @author Jan Sohn / xxAROX
 * @date 23. July, 2022 - 23:30
 * @ide PhpStorm
 * @project Report-Manager
 */
interface IVirtualReportPlayer{
	public function getReportHistory(): ReportHistory;
}
