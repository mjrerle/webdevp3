#!/bin/bash
chmod -R 755 *
find . -iname "*.php" | xargs chmod 644
echo "Permissions granted."
