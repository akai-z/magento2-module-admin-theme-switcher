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
     * Default admin theme path/code.
     */
    const DEFAULT_ADMIN_THEME = 'Magento/backend';

    /**
     * @var ScopeConfig
     */
    private $scopeConfig;

    public function __construct(ScopeConfig $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string
     */
    public function getAdminThemeId()
    {
        $adminThemeId = $this->scopeConfig->getValue(self::XML_PATH_ADMIN_THEME_ID);
        return $adminThemeId ?: self::DEFAULT_ADMIN_THEME;
    }

    /**
     * @return array
     */
    public function getDesignInvalidCaches()
    {
        $config = $this->scopeConfig->getValue(
            BackendTheme::XML_PATH_INVALID_CACHES,
            Scope::SCOPE_STORE
        );

        return $config ? array_keys($config) : [];
    }
}
