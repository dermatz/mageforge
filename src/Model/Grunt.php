<?php

declare(strict_types=1);

namespace MageForge\Base\Model;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Grunt
{
    public function isAvailable(): bool
    {
        $process = new Process(['grunt', '--version']);
        $process->run();

        return $process->isSuccessful();
    }

    public function install(): void
    {
        $process = new Process(['npm', 'install', '-g', 'grunt-cli']);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    public function isNeeded(string $theme): bool
    {
        $gruntfilePath = $this->getGruntfilePath($theme);
        return file_exists($gruntfilePath);
    }

    public function runTasks(string $theme): void
    {
        $gruntfilePath = $this->getGruntfilePath($theme);
        $process = new Process(['grunt', 'exec', 'clean', 'less', 'watch'], dirname($gruntfilePath));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    private function getGruntfilePath(string $theme): string
    {
        return BP . "/app/design/frontend/{$theme}/Gruntfile.js";
    }
}
