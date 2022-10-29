<?php

declare(strict_types=1);

namespace xerenahmed\ServerDump;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use Webmozart\PathUtil\Path;
use function array_shift;
use function date;
use function fclose;
use function fopen;
use function fwrite;
use function json_encode;
use function str_contains;
use function str_starts_with;

class Main extends PluginBase{

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
		$dump = new DumpData($this->getServer());
		try{
			$dump = json_encode($dump, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
		}catch(\JsonException $e){
			$sender->sendMessage("Failed to encode dump data to JSON: " . $e->getMessage());
			return true;
		}

		$arg1 = array_shift($args);
		if($arg1 === "-o"){
			$path = array_shift($args);
			if($path === null){
				$sender->sendMessage("Please specify a path to write the dump to.");
				return true;
			}

			$outputPath = $path;
			$this->writeToPath($sender, $outputPath, $dump);
			return true;
		}

		if($arg1 !== null && str_starts_with($arg1, "-so")){
			$addDate = str_contains($arg1, "d");

			$fileName = "server-dump";
			if($addDate){
				$fileName .= "-" . date("Y-m-d-H-i-s");
			}
			$outputPath = Path::join($this->getDataFolder(), $fileName . ".json");
			$this->writeToPath($sender, $outputPath, $dump);
			return true;
		}

		$sender->sendMessage($dump);
		return true;
	}

	public function writeToPath(CommandSender $sender, string $outputPath, string $dump): void{
		$file = fopen($outputPath, "wb");
		if($file === false){
			$sender->sendMessage("Failed to open file $outputPath for writing.");
			return;
		}

		if(fwrite($file, $dump) === false){
			$sender->sendMessage("Failed to write dump data to $outputPath.");
			return;
		}

		fclose($file);
		$sender->sendMessage("Dump data written to $outputPath");
	}
}
