all: install run

install:
	php composer.phar update

run:
	vagrant up

clean:
	rm -rf vendor/