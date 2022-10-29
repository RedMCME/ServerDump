<?php

declare(strict_types=1);

namespace xerenahmed\ServerDump;

use pocketmine\Server;
use function floor;
use function microtime;

class UptimeDump implements \JsonSerializable{
	public function __construct(
		protected Server $server
	){}

	public function jsonSerialize(): mixed{
		$time = (int) (microtime(true) - $this->server->getStartTime());

		$seconds = $time % 60;
		$minutes = null;
		$hours = null;
		$days = null;

		if($time >= 60){
			$minutes = floor(($time % 3600) / 60);
			if($time >= 3600){
				$hours = floor(($time % (3600 * 24)) / 3600);
				if($time >= 3600 * 24){
					$days = floor($time / (3600 * 24));
				}
			}
		}

		$uptime = ($minutes !== null ?
				($hours !== null ?
					($days !== null ?
						"$days days "
						: "") . "$hours hours "
					: "") . "$minutes minutes "
				: "") . "$seconds seconds";
		return $uptime;
	}
}
