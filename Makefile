setup:
	docker-compose pull
	docker-compose build
	cp pre-commit-hook .git/hooks/pre-commit
	chmod +x .git/hooks/pre-commit
	docker-compose up -d