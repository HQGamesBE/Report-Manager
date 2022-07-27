<?php
/*
 * Copyright (c) Jan Sohn / xxAROX
 * All rights reserved.
 * I don't want anyone to use my source code without permission.
 */
declare(strict_types=1);
namespace HQGames\ReportManager\player\classes;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;


/**
 * Class Report
 * @package HQGames\ReportManager\player\classes
 * @author Jan Sohn / xxAROX
 * @date 23. July, 2022 - 19:04
 * @ide PhpStorm
 * @project Report-Manager
 */
class Report implements JsonSerializable{
	protected string $identifier;
	protected string $server_identifier;
	protected string $player_identifier;
	protected string $creator_identifier;
	protected string $reason;
	protected string $comment;
	protected int $created_at;
	protected string $replay_id;
	protected bool $solved;

	/**
	 * Report constructor.
	 * @param string $identifier
	 * @param string $server_identifier
	 * @param string $player_identifier
	 * @param string $creator_identifier
	 * @param string $reason
	 * @param string $comment
	 * @param null|int $created_at
	 * @param null|string $replay_id
	 * @param bool $solved
	 */
	public function __construct(string $identifier, string $server_identifier, string $player_identifier, string $creator_identifier, string $reason, string $comment, ?int $created_at, ?string $replay_id = null, bool $solved = false){
		$this->identifier = $identifier;
		$this->server_identifier = $server_identifier;
		$this->creator_identifier = $creator_identifier;
		$this->player_identifier = $player_identifier;
		$this->replay_id = $replay_id;
		$this->reason = $reason;
		$this->comment = $comment;
		$this->created_at = $created_at ?? time();
		$this->solved = $solved;
	}

	/**
	 * Function getReason
	 * @return string
	 */
	public function getReason(): string{
		return $this->reason;
	}

	/**
	 * Function getIdentifier
	 * @return string
	 */
	public function getIdentifier(): string{
		return $this->identifier;
	}

	/**
	 * Function getReplayId
	 * @return ?string
	 */
	public function getReplayId(): ?string{
		return $this->replay_id;
	}

	/**
	 * Function getCreatorIdentifier
	 * @return string
	 */
	public function getCreatorIdentifier(): string{
		return $this->creator_identifier;
	}

	/**
	 * Function getPlayerIdentifier
	 * @return string
	 */
	public function getPlayerIdentifier(): string{
		return $this->player_identifier;
	}

	/**
	 * Function getServerIdentifier
	 * @return string
	 */
	public function getServerIdentifier(): string{
		return $this->server_identifier;
	}

	/**
	 * Function isSolved
	 * @return bool
	 */
	public function isSolved(): bool{
		return $this->solved;
	}

	/**
	 * Function setSolved
	 * @param bool $solved
	 * @return void
	 */
	public function setSolved(bool $solved): void{
		$this->solved = $solved;
	}

	/**
	 * Function jsonSerialize
	 * @return array
	 */
	#[ArrayShape([
		"identifier"         => "string",
		"server_identifier"  => "string",
		"creator_identifier" => "string",
		"player_identifier"  => "string",
		"reason"             => "string",
		"replay_id"          => "null|string",
		"solved"             => "bool",
	])] public function jsonSerialize(): array{
		return [
			"identifier"         => $this->identifier,
			"server_identifier"  => $this->server_identifier,
			"creator_identifier" => $this->creator_identifier,
			"player_identifier"  => $this->player_identifier,
			"reason"             => $this->reason,
			"replay_id"          => $this->replay_id,
			"solved"             => $this->solved,
		];
	}

	/**
	 * Function fromArray
	 * @param array $array
	 * @return Report
	 * @throws Exception if the array is not valid
	 */
	public static function fromArray(#[ArrayShape([
		"identifier"         => "string",
		"server_identifier"  => "string",
		"creator_identifier" => "string",
		"player_identifier"  => "string",
		"reason"             => "string",
		"replay_id"          => "null|string",
		"solved"             => "bool",
	])] array $array): Report{
		$notFound = new Exception("The array does not contain the required keys.");
		return new Report(strval($array["identifier"] ?? throw $notFound), strval($array["server_identifier"] ?? throw $notFound), strval($array["player_identifier"] ?? throw $notFound), strval($array["creator_identifier"] ?? throw $notFound), strval($array["reason"] ?? "%n/a"), $array["replay_id"] ?? null, boolval($array["solved"] ?? false));
	}
}
