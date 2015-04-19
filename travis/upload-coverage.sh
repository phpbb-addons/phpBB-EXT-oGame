#!/bin/bash

set -e
set -x

DB=$1
TRAVIS_PHP_VERSION=$2

if [ "$TRAVIS_PHP_VERSION" = "5.6" -a "$DB" = "mysqli" ]
then
	#upload coverage to codacy
	php ../$BASEDIR/vendor/bin/codacycoverage clover
	#upload Coverage to coveralls.io
	php ../$BASEDIR/vendor/bin/coveralls -v
	#upload Coverage to CodeClimate
	CODECLIMATE_REPO_TOKEN=$CODECLIMATE_REPO_TOKEN /home/travis/build/$BASEDIR/vendor/bin/test-reporter  --stdout > codeclimate.json
	curl -X POST -d @codeclimate.json -H 'Content-Type: application/json' -H 'User-Agent: Code Climate (PHP Test Reporter v0.1.1)' https://codeclimate.com/test_reports
	#upload Coverage to Scrutinizer
	cd ../$BASEDIR
	wget https://scrutinizer-ci.com/ocular.phar
	php ocular.phar code-coverage:upload --format=php-clover ../../phpBB3/build/logs/clover.xml
fi
