<?php
/**
 * See COPYING.txt for license details.
 */
namespace Akai\AdminThemeSwitcher\Model\Plugin\View;

use Akai\AdminThemeSwitcher\Model\Config;
use Magento\Framework\App\Area as AppArea;
use Magento\Theme\Model\View\Design as ViewDesign;

class Design
{
    /**
     * @var ViewDesign
     */
    private $viewDesign;

    /**
     * @var Config
     */
    private $config;

    public function __construct(ViewDesign $viewDesign, Config $config)
    {
        $this->viewDesign = $viewDesign;
        $this->config = $config;
    }

    /**
     * Get admin theme which is declared in configuration.
     *
     * @param string|int $result
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return string|int
     *
     * @codingStandardsIgnoreStart
     */
    public function afterGetConfigurationDesignTheme(ViewDesign $subject, $result)
    {
        // @codingStandardsIgnoreEnd
        if ($this->viewDesign->getArea() == AppArea::AREA_ADMINHTML) {
            $result = $this->config->getAdminThemeId();
        }

        return $result;
    }
}
