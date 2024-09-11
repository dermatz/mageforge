<?php

declare(strict_types=1);

namespace MageForge\Base\Console\Command;

use Magento\Framework\Console\Cli;
use Magento\Framework\Console\CommandList;
use Magento\Framework\App\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MageForge\Base\Service\ThemeListService;
use MageForge\Base\Service\NpmService;
use MageForge\Base\Service\GruntService;

class BuildThemeCommand extends Command
{
    public function __construct(
        private ThemeListService $themeListService,
        private NpmService $npmService,
        private GruntService $gruntService
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('mageforge:build-theme');
        $this->setDescription('Builds a Magento 2 theme');
        $this->addArgument('theme', InputArgument::OPTIONAL, 'Theme name');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $themeName = $input->getArgument('theme');

        if ($themeName) {
            $themes = [$themeName];
        } else {
            $themes = $this->themeListService->getFrontendThemes();
        }

        foreach ($themes as $theme) {
            $output->writeln("Building theme: $theme");

            if ($this->npmService->needsCi($theme)) {
                $output->writeln("Running npm ci for theme: $theme");
                $this->npmService->ci($theme);
            }

            if ($this->gruntService->isNeeded($theme)) {
                if (!$this->gruntService->isAvailable()) {
                    $output->writeln("Installing grunt globally");
                    $this->gruntService->install();
                }

                $output->writeln("Running grunt tasks for theme: $theme");
                $this->gruntService->runTasks($theme);
            }
        }

        return Cli::RETURN_SUCCESS;
    }
}
