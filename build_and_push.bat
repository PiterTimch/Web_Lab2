@echo off

echo Docker login...
docker login

echo Building Docker image for PHP Lab...
docker build -t php-lab-1 . 

echo Tagging Docker image...
docker tag php-lab-1:latest pedro007salo/php-lab-1:latest

echo Pushing Docker image to Docker Hub...
docker push pedro007salo/php-lab-1:latest

echo Done!
pause