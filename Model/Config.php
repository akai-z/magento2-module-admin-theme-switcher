<?php
/**
 * See COPYING.txt for license details.
 */
namespace Akai\AdminThemeSwitcher\Model;

use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Store\Model\ScopeInterface as Scope;
use Magento\Theme\Model\Design\Backend\Theme as BackendTheme;

class Config
{
    /**
     * System config XML paths.
     */
    const XML_PATH_ADMIN_THEME_ID = 'design/theme/admin_theme_id';

    /**
     * @var ScopeConfig
     */
    private $scopeConfig;

    public function __construct(ScopeConfig $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string|null
     */
    public function getAdminThemeId()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ADMIN_THEME_ID);
    }

    /**
     * @return array
     */
    public function getDesignInvalidCaches()
    {
        return array_keys(
            $this->scopeConfig->getValue(
                BackendTheme::XML_PATH_INVALID_CACHES,
                Scope::SCOPE_STORE
            )
        );
    }
}
