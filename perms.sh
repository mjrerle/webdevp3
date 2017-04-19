#!/bin/bash
clear
chmod -r 755 *
find . -iname "*.php" | xargs chmod 644
echo "Permissions granted."
