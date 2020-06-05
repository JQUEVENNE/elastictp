path = docker

clean:
	docker system prune -a -f

build:
	cd $(path) && docker build -t symfony .

rebuild: clean build

run:
	cd $(path) && docker run --rm -p 80:82 symfony

rerun: rebuild run

compose:
	docker-compose up --build -d