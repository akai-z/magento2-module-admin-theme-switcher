#!/usr/bin/env bash

set -e
trap '>&2 echo Error: Command \`$BASH_COMMAND\` on line $LINENO failed with exit code $?' ERR

cd $MAGENTO_DIR

./vendor/phpunit/phpunit/phpunit --config="dev/tests/unit/phpunit.xml.dist" ${MODULE_DEPLOY_PATH}/Test/Unit/Model/Design/Backend/ThemeTest.php
