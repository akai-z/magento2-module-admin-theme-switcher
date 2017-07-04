<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License version 2 (GPLv2).
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 *
 * @package   Akai\AdminThemeSwitcher
 * @author    Ammar K.
 * @copyright 2017 Akai-Z.
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License version 2 (GPLv2)
 * @see       https://api.github.com/user/4558603/
 */
namespace Akai\AdminThemeSwitcher\Model\Plugin\View;

use Magento\Theme\Model\View\Design as ViewDesign;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Framework\App\Area as AppArea;

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
