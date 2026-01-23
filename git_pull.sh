#!/bin/bash
if [ "$(id -u)" -ne 0 ]; then
    echo "This script must be run as root. Use sudo ./your_script.sh" >&2
    exit 1
fi
REPO_PATH="/docker/unified-registration-system"

chmod -R 777 $REPO_PATH
docker exec -it unified-registration-app bash -c 'git config --global --add safe.directory /var/www'

# Define the path to your repository
cd "$REPO_PATH" || exit
echo "Project name: Unified Registration System";
echo "Project path: $REPO_PATH";

echo "Branch name: $(docker exec -it unified-registration-app bash -c 'git branch --show-current')";
echo "Git pull: $(docker exec -it unified-registration-app bash -c 'git pull --no-rebase')"
echo "Composer install running...";
docker exec -it unified-registration-app composer install --ignore-platform-reqs -q --no-progress;
echo "Composer install end...";