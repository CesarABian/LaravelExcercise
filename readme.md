# PHP Laravel Exercise


### Requerimientos
1. PHP
2. MySQL database
3. Composer


### Installation guide

1. Clonar el repositorio:
`git clone https://github.com/CesarABian/LaravelExcercise.git`
2. Crear la base de datos MySQL con nombre laravel
4. Executar el comando: `sh scripts/install.sh`
5. Listo para probar.

### Endpoints

1. **Importacion de datos:**
Existe un endpoint para la carga del fichero csv, con el metodo `POST` en la URI `api/upload-content` con formato de body `form-data` y la key `uploaded_file`.

2. **Mostrar todo el contenido:**
Existe un endpoint para mostrar todo el contenido de la tabla superheroes, con el metodo `GET` en la URI `api/superhero`.

3. **Filtrar por propiedad:**
Existe un endpoint para solo la propiedad especifica de los superheroes, con el metodo `GET` en la URI `api/superhero/nombre-propiedad` , donde `nombre-propiedad` debe ser reemplazado por la propiedad a mostrar.

4. **Paginacion:**
Para realizar la paginacion, se le debe agregar a cualquiera de los dos endpoints mostrados arriba la porcion de URI `/paginate/elementos-por-pagina` , donde `elementos-por-pagina` debe ser un numero que indica la cantidad de elementos mostrados en cada pagina.

5. **Orden:**
Para ordenar los elementos, se le debe agregar a cualquiera de los tres endpoints mostrados arriba la porcion de URI `/sort-order/nb` , donde si `nb` es `0` los elemetos se ordenaran de forma ascendente y si `nb` es `1` los elemetos se ordenaran de forma descendente.