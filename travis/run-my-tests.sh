#!/bin/bash

set -e
set -x

DB=$1
TRAVIS_PHP_VERSION=$2

if [ "$TRAVIS_PHP_VERSION" == "5.6" -a "$DB" == "mysqli" ]
then
	mkdir -p build/logs
	chmod +wx build/logs
	sed -n '1h;1!H;${;g;s/<\/php>/<\/php>\n\t<filter>\n\t\t<whitelist>\n\t\t\t<directory>..\/<\/directory>\n\t\t\t<exclude>\n\t\t\t\t<directory>..\/tests\/<\/directory>\n\t\t\t\t<directory>..\/develop\/<\/directory>\n\t\t\t\t<directory>..\/migrations\/<\/directory>\n\t\t\t\t<directory>..\/language\/<\/directory>\n\t\t\t\t<directory>..\/vendor\/<\/directory>\n\t\t\t<\/exclude>\n\t\t<\/whitelist>\n\t<\/filter>/g;p;}' phpBB/ext/un1matr1x/ogame/travis/phpunit-mysqli-travis.xml &> phpBB/ext/un1matr1x/ogame/travis/phpunit-mysqli-travis.xml.bak
	cp phpBB/ext/un1matr1x/ogame/travis/phpunit-mysqli-travis.xml.bak phpBB/ext/un1matr1x/ogame/travis/phpunit-mysqli-travis.xml
	phpBB/vendor/bin/phpunit --configuration phpBB/ext/$EXTNAME/travis/phpunit-$DB-travis.xml --bootstrap ./tests/bootstrap.php --verbose --debug --coverage-clover build/logs/clover.xml
else
	phpBB/vendor/bin/phpunit --configuration phpBB/ext/$EXTNAME/travis/phpunit-$DB-travis.xml --bootstrap ./tests/bootstrap.php --verbose --debug
fi
