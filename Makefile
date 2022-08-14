# default files to keep in dist folders after clean
exclude-dist-clean = config.php
src-files = $(wildcard ./src/*)

.PHONY: build-prod build-dev build clean-dist-prod clean-dist-dev clean-dist clean

.IGNORE: build-prod build-dev

build-prod: dist-prod
	-cp -rn $(src-files) ./dist-prod/

build-dev: dist-dev
	-cp -rn $(src-files) ./dist-dev/

build: build-prod build-dev

clean-dist-prod: dist-prod
	find ./dist-prod -mindepth 1 ! -name $(exclude-dist-clean) -exec rm -rf {} +

clean-dist-dev: dist-dev
	find ./dist-dev -mindepth 1 ! -name $(exclude-dist-clean) -exec rm -rf {} +

clean-dist: clean-dist-dev clean-dist-prod

clean: clean-dist