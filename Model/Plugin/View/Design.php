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
     * Admin theme design configuration XML path.
     */
    const XML_PATH_ADMIN_THEME_ID = 'design/theme/admin_theme_id';

    /**
     * Default admin theme path/code.
     */
    const DEFAULT_ADMIN_THEME = 'Magento/backend';

    /**
     * @var ViewDesign
     */
    private $viewDesign;

    /**
     * @var Config
     */
    private $config;

    /**
     * @param ViewDesign  $viewDesign
     * @param Config $config
     */
    public function __construct(
        ViewDesign $viewDesign,
        Config $config
    ) {
        $this->viewDesign = $viewDesign;
        $this->config = $config;
    }

    /**
     * Get admin theme which is declared in configuration.
     *
     * @param ViewDesign $subject
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
            if (!$result) {
                $result = self::DEFAULT_ADMIN_THEME;
            }
        }

        return $result;
    }
}
