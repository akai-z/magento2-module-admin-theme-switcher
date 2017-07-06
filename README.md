Admin Theme Switcher [![SensioLabsInsight](https://insight.sensiolabs.com/projects/33440099-8b6d-46ab-896a-70487a3e62e6/small.png)](https://insight.sensiolabs.com/projects/33440099-8b6d-46ab-896a-70487a3e62e6)
====================

[![Build Status](https://travis-ci.org/akai-z/magento2-module-admin-theme-switcher.svg?branch=master)](https://travis-ci.org/akai-z/magento2-module-admin-theme-switcher)
[![Dependency Status](https://www.versioneye.com/user/projects/595b9d5b368b080033562eef/badge.svg?style=flat)](https://www.versioneye.com/user/projects/595b9d5b368b080033562eef)
[![Coverage](https://codeclimate.com/github/akai-z/magento2-module-admin-theme-switcher.png)](https://codeclimate.com/github/akai-z/magento2-module-admin-theme-switcher)
[![Latest Stable Version](https://poser.pugx.org/akai/magento2-module-admin-theme-switcher/v/stable)](https://packagist.org/packages/akai/magento2-module-admin-theme-switcher)
[![License](https://poser.pugx.org/akai/magento2-module-admin-theme-switcher/license)](https://packagist.org/packages/akai/magento2-module-admin-theme-switcher)

#### Contents
* [Synopsis](#synopsis)
* [Overview](#overview)
* [Installation](#installation)
* [Tests](#tests)
* [Authors](#authors)
* [License](#license)


## Synopsis

A Magento 2 module that allows users to easily switch between admin themes.

## Overview

Admin Theme Switcher module adds an option to Magento 2 admin panel  
that allows users to switch between admin themes.

The option can be found in stores configuration design page.  
(`Stores > Configuration > General > Design`)  
Under `Design Theme` group.

## Installation

Below, you can find two ways to install the admin theme switcher module.

### 1. Install via Composer (Recommended)
First, make sure that Composer is installed: https://getcomposer.org/doc/00-intro.md

Make sure that Packagist repository is not disabled.

Run Composer require to install the module:

    php <your Composer install dir>/composer.phar require akai/module-admin-theme-switcher:^1.0

### 2. Clone the admin-theme-switcher repository
Clone the [admin-theme-switcher](https://github.com/akai-z/admin-theme-switcher) repository using either the HTTPS or SSH protocols.

### 2.1. Copy the code
Create a directory for the admin theme switcher module and copy the cloned repository contents to it:

    mkdir -p <your Magento install dir>/app/code/Akai/AdminThemeSwitcher
    cp -R <admin-theme-switcher clone dir>/* <your Magento install dir>/app/code/Akai/AdminThemeSwitcher

### Update the Magento database and schema
If you added the module to an existing Magento installation, run the following command:

    php <your Magento install dir>/bin/magento setup:upgrade

### Verify the module is installed and enabled
Enter the following command:

    php <your Magento install dir>/bin/magento module:status

The following confirms you installed the module correctly, and that it's enabled:

    example
        List of enabled modules:
        ...
        Akai_AdminThemeSwitcher
        ...

## Tests

Unit tests can be found in the [Test/Unit](Test/Unit) directory.

## Authors

* [Ammar K.](https://api.github.com/user/4558603/)

## License

[GNU General Public License version 2](LICENSE.txt)
