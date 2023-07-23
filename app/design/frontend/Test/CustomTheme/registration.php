<?php

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::THEME,
    "frontend/Test/CustomTheme",
    __DIR__,
);
