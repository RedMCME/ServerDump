<?php

declare(strict_types=1);

namespace xerenahmed\ServerDump\world;

use pocketmine\entity\Entity;
use pocketmine\Server;
use pocketmine\utils\Process;
use pocketmine\world\World;

class WorldEntityDump implements \JsonSerializable{
	public function __construct(
		protected Entity $entity,
		protected int $count
	){}

	public function jsonSerialize(): mixed{
		return [
			"type" => $this->entity::getNetworkTypeId(),
			"class" => get_class($this->entity),
			"count" => $this->count,
		];
	}
}