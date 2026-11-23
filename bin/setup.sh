#!/usr/bin/env bash
# One-shot local setup: start the stack, install WordPress, build the blocks,
# activate the theme and plugin, and create the block-built Home page.
# Safe to re-run: the install step and the Home page are skipped when they already exist.
set -euo pipefail

cd "$(dirname "$0")/.."

if [ ! -f .env ]; then
	echo "Missing .env. Copy .env.example to .env and fill in the passwords." >&2
	exit 1
fi

set -a
# shellcheck disable=SC1091
. ./.env
set +a

wp() {
	docker compose run --rm -T cli wp "$@" 2>&1 | grep -v -E '^ ?Container '
}

docker compose up -d

echo "Waiting for WordPress files..."
for _ in $(seq 1 30); do
	if docker compose exec -T wordpress test -f /var/www/html/wp-config.php; then
		break
	fi
	sleep 2
done

if ! docker compose run --rm -T cli wp core is-installed >/dev/null 2>&1; then
	wp core install \
		--url="$WP_URL" \
		--title="WP Demos" \
		--admin_user="$WP_ADMIN_USER" \
		--admin_password="$WP_ADMIN_PASSWORD" \
		--admin_email="$WP_ADMIN_EMAIL" \
		--skip-email
fi

echo "Building blocks..."
docker compose run --rm -T node sh -c 'npm ci --no-audit --no-fund && npm run build'

wp theme activate gutenberg-blocks-demo
wp plugin activate demo-blocks

home_id="$(docker compose run --rm -T cli wp post list --post_type=page --name=home --field=ID 2>/dev/null | tr -d '[:space:]')"

if [ -z "$home_id" ]; then
	home_id="$(docker compose run --rm -T cli wp post create /content/front-page.html \
		--post_type=page --post_status=publish --post_title=Home --post_name=home --porcelain 2>/dev/null | tr -d '[:space:]')"
	echo "Created Home page #$home_id"
fi

wp option update show_on_front page
wp option update page_on_front "$home_id"

echo "Done: $WP_URL"
