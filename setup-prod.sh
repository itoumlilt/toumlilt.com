#!/bin/bash
# Setup production env when the repo is copied to the server
# I don't need a better way for now... 

mv htaccess.example .htaccess
mv config.php.example config.php
rm README.md LICENSE CHANGELOG.md

# autodestroy
rm $0