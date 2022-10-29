<?php

declare(strict_types=1);

namespace xerenahmed\ServerDump\world;

use pocketmine\entity\Entity;
use function get_class;

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
