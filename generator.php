<!DOCTYPE html>
<title>Basic Plugin Generator by tpguy825</title>
<h2>Basic Plugin Generator</h2>
<p>Welcome! Please fill out some details for the generator.</p>
<form>
  <label for="author">Plugin Author:</label><br>
  <input type="text" id="author" name="author"><br>
  
  <label for="name">Plugin Name:</label><br>
  <input type="text" id="name" name="name">
  
  <label for="command">Command (that the user can run, no spaces): /</label><br>
  <input type="text" id="command" name="command"><br>
  
  <label for="response">Response to be sent to the user (use \n for new line): </label><br>
  <input type="text" id="response" name="response">
</form>

<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$name = var_export(test_input($_POST["name"]), true);
$author = var_export(test_input($_POST["author"]), true);
$command = var_export(test_input($_POST["command"]), true);
$response = var_export(test_input($_POST["response"]), true);
file_add_contents('plugin.yml', '# do not delete name, main, version or api or your plugin will crash\nname: ' . $name . '\nmain: ' . $name . '\Main\nversion: 1.0.0\napi: 3.0.0\n\ncommands:\n ' . $command . ':\n  description: ' . $command . ' command\n  usage: "/' . $command . '"\n  permission: ' . $name . '.command.' . $command . '\npermissions:\n ' . $name . '.command.' $command . ':\n  description: "Allows the user to run the ' . $command . ' command"\n  default: ' . $defaultPermissionLevel . "";);
$mainPHPcontent = '<?php\n\ndeclare(strict_types=1);\n\nnamespace ExamplePlugin;\nuse pocketmine\command\Command;\nuse pocketmine\command\CommandSender;\nuse pocketmine\plugin\PluginBase;\nuse pocketmine\utils\TextFormat;\n\nclass MainClass extends PluginBase{\n\n	public function onLoad() : void{\n		$this->getLogger()->info(TextFormat::WHITE . "Loaded");\n}\n\n	public function onEnable() : void{\n		$this->getLogger()->info(TextFormat::DARK_GREEN . "Enabled.");\n	}\n\n	public function onDisable() : void{\n		$this->getLogger()->info(TextFormat::AQUA . "Disabled.");\n	}\n\n public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{\n		switch($command->getName()){\n			case "' . $command . ':\n				$sender->sendMessage("' . $response . '");\n\n				return true;\n		}\n	}\n}';
file_add_contents('Main.php', $mainPHPcontent);
$zipFileName = $name . ".zip"
$zipFileMainPHPlocation = $name . '/' . 'src/' . $author . '/' . $name . '/Main.php';
$zipFilePluginYMLlocation = $name . '/plugin.yml';

$zip = new ZipArchive;
if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE)
{
    $zip->addFile('Main.php', $zipFileMainPHPlocation);
    $zip->addFile('plugin.yml', $zipFilePluginYMLlocation);
    $zip->close();
}
?>
<p>When you have filled out the form, click <a href=<?php echo '"' . $zipFileName . '"'; ?> download>here</a> to download your plugin's base files. Make sure you have <a href="https://poggit.pmmp.io/p/devtools" rel="_blank">DevTools</a> installed!</p>
