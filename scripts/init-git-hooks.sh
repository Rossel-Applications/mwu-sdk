#!/usr/bin/env bash

ask_yes_no() {
    local prompt="$1"
    local response

    while true; do
        read -p "$prompt (Y/n): " response
        case "$response" in
            [Yy]* ) return 0;;  # Yes
            [Nn]* ) return 1;;  # No
            * ) echo "Please respond with yes (Y/y) or no (N/n).";;
        esac
    done
}

echo "Checking Git hooks..."

if [ ! -e .git/hooks/pre-commit ]; then
    if [ -e scripts/hooks/pre-commit ]; then
        cp scripts/hooks/pre-commit .git/hooks/
        echo "Git pre-commit hook successfully added."
    else
        echo "Error: pre-commit hook script not found in scripts/hooks/."
    fi
    exit 0
fi

# Compare file contents and check if the one in ./scripts/hooks is newer
if ! cmp -s scripts/hooks/pre-commit .git/hooks/pre-commit && \
   [[ scripts/hooks/pre-commit -nt .git/hooks/pre-commit ]]; then
    if ask_yes_no "A new version of the pre-commit hook is available. Your local file will be replaced. Update?"; then
        cp -f scripts/hooks/pre-commit .git/hooks/
        echo "Git pre-commit hook updated."
    fi
else
    echo "Pre-commit hook is already initialized and up to date. Nothing to do."
fi
