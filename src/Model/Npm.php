<?php

declare(strict_types=1);

namespace MageForge\Base\Model;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Npm
{
    public function needsCi(string $theme): bool
    {
        $packageJsonPath = $this->getPackageJsonPath($theme);
        return file_exists($packageJsonPath);
    }

    public function ci(string $theme): void
    {
        $packageJsonPath = $this->getPackageJsonPath($theme);
        $process = new Process(['npm', 'ci'], dirname($packageJsonPath));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    private function getPackageJsonPath(string $theme): string
    {
        return BP . "/app/design/frontend/{$theme}/package.json";
    }
}
