<?php

declare(strict_types=1);

namespace MageForge\Base\Service;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\View\Design\Theme\ThemeList as MagentoThemeList;

class ThemeListService
{
    private MagentoThemeList $themeList;

    public function __construct()
    {
        $this->themeList = ObjectManager::getInstance()->get(MagentoThemeList::class);
    }

    public function getFrontendThemes(): array
    {
        $themes = [];
        foreach ($this->themeList->getThemes() as $theme) {
            if ($theme->getArea() === 'frontend') {
                $themes[] = $theme->getCode();
            }
        }
        return $themes;
    }
}
