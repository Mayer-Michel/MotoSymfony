<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\NavExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class NavExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('number_format', [NavExtensionRuntime::class, 'numberFormat']),
            new TwigFilter('badge_user', [NavExtensionRuntime::class, 'badgeUser'], ['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('menu_items', [NavExtensionRuntime::class, 'menuItems']),
            new TwigFunction('menu_items_age', [NavExtensionRuntime::class, 'menuItemsAge']),
            new TwigFunction('filters_items', [NavExtensionRuntime::class, 'filtersItems']),
        ];
    }
}
