# Comandos Git
- para comenzar con git 
## Instalar Git
- Descargar e Instalar GIT: https://git-scm.com/
## Configurar Git
- nos presentamos con git
``` bash
 git config --global user.email cchura.cpc@gmail.com
 git config --global user.name "Cristian"
```
## Crear una cuenta en (Github), GitLab o BitBucket

-------------------------------
## Crear un repositorio Remoto (GitHub)
- identificar la direccion del repositorio remoto (github)
- https://github.com/cchura94/backend_laravel_api_angular.git

- ?? clonar el repositorio si ya existe el repositorio
```
git clone direccion_del_repositorio
```
- inicializar si es un nuevo repositorio de GIT (local)
```
git init
```
## relacionar el repositorio local con el repositorio remoto
```
git remote add origin https://github.com/cchura94/backend_laravel_api_angular.git
```
--------
--------
```
git add .
git commit -m "Laravel Base + Api Auth"
git push origin master
```