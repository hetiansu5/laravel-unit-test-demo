#!/bin/bash
# --coverage-html coverage
# --filter testFunc 匹配符合的方法名
# --group A 需要在方法名加注释 @group A
vendor/bin/phpunit --configuration phpunit.xml --colors  tests