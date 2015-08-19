<?php
namespace AppZap\PHPFrameworkComposerInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface {
    public function activate(Composer $composer, IOInterface $io) {
        
    }
}
