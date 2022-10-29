<?php

declare(strict_types=1);

namespace xerenahmed\ServerDump;

use pocketmine\Server;
use pocketmine\utils\Process;

class MemoryDump implements \JsonSerializable{
	public function __construct(
		protected Server $server
	){}

	public function jsonSerialize(): mixed{
		$mUsage = Process::getAdvancedMemoryUsage();
		$format = function(int $bytes) : string{
			return number_format($bytes / 1024 / 1024, 2) . " MB";
		};

		return [
			"main-thread" => $format($mUsage[0]),
			"total" => $format($mUsage[1]),
			"total-virtual" => $format($mUsage[2]),
		];
	}
}