.PHONY: deploy optimize clear-cache

# Git o'zgarishlarni yuborish (Interaktiv xabar so'rash bilan)
push:
	@echo "📝 Commit xabarini kiriting:"
	@read msg; \
	if [ -z "$$msg" ]; then \
		echo "❌ Xato: Xabar bo'sh bo'lishi mumkin emas!"; \
		exit 1; \
	fi; \
	git add .; \
	git commit -m "$$msg"; \
	git push origin main
	@echo "✅ O'zgarishlar Git-ga muvaffaqiyatli yuborildi!"

# Oxirgi versiyani olish
pull:
	git pull origin main
	@echo "📥 Oxirgi o'zgarishlar qabul qilindi!"

# Git holatini tekshirish
status:
	git status

# Default deployment command
deploy:
	@echo "🔄 Pulling latest changes..."
	git pull origin main

	@echo "🚀 Starting deployment..."
	
	# 1. Install dependencies
	composer install --optimize-autoloader --no-dev --no-interaction
	
	# 2. Database migrations (optional, uncomment if needed)
	# php artisan migrate --force
	
	# 3. Optimization
	php artisan config:cache
	php artisan route:cache
	php artisan view:cache
	php artisan event:cache
	php artisan optimize
	
	@echo "✅ Deployment finished successfully!"

# docker commands
up: ## Docker containerlarni ishga tushirish
	docker compose up -d

down: ## Docker containerlarni to'xtatish
    cd ../; docker compose down

restart: ## Docker containerlarni qayta ishga tushirish
    cd ../; docker compose restart

logs: ## Docker loglarni ko'rish
    cd ../; docker compose logs -f

ps: ## Docker containerlarni ko'rish
    cd ../; docker ps

bash: ## Docker containerga bash kirish
    cd ../; docker exec -it course-app bash

db: ## Docker databasega bash kirish
    cd ../; docker exec -it course-db bash

optimize: ## Laravel optimize qilish
    cd ../; docker exec course-app php artisan optimize

optimize-clear: ## Laravel optimize ni tozalash
    cd ../; docker exec course-app php artisan optimize:clear

migrate: ## Laravel migratsiyalarni ishga tushirish
    cd ../; docker exec course-app php artisan migrate

migrate-fresh: ## Laravel migratsiyalarni tozalash va qayta ishga tushirish
    cd ../; docker exec course-app php artisan migrate:fresh

# npm commands
npm-install: ## npm paketlarini o'rnatish
    npm install

npm-update: ## npm paketlarini yangilash
    npm update

npm-run-dev: ## npm dev rejimida ishga tushirish
    npm run dev

npm-run-prod: ## npm prod rejimida ishga tushirish
    npm run prod

npm-run-build: ## npm build rejimida ishga tushirish
    npm run build
	@echo "🗄️🌱 Fresh database with seeders..."
	php artisan migrate:fresh --seed
	@echo "✅ Database refreshed and seeded!"
