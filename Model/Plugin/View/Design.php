<?php
/**
 * See COPYING.txt for license details.
 */
namespace Akai\AdminThemeSwitcher\Model\Plugin\View;

use Magento\Framework\App\Area as AppArea;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
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
     * @var ScopeConfig
     */
    private $scopeConfig;

    /**
     * @param ViewDesign  $viewDesign
     * @param ScopeConfig $scopeConfig
     */
    public function __construct(
        ViewDesign $viewDesign,
        ScopeConfig $scopeConfig
    ) {
        $this->viewDesign = $viewDesign;
        $this->scopeConfig = $scopeConfig;
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
            $result = $this->scopeConfig->getValue(
                self::XML_PATH_ADMIN_THEME_ID,
                ScopeConfig::SCOPE_TYPE_DEFAULT
            );

            if (!$result) {
                $result = self::DEFAULT_ADMIN_THEME;
            }
        }

        return $result;
    }
}
